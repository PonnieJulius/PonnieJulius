<?php
   require('security.php');
    
  // Checking if email and phone number are not already used
function userExists($conn, $email, $phone) {
    $email = mysqli_real_escape_string($conn, $email);
    $phone = mysqli_real_escape_string($conn, $phone);

    $query = "SELECT * FROM `tbl_users` WHERE `email` = '$email' OR `mobile` = '$phone'";
    $result = mysqli_query($conn, $query);

    return mysqli_num_rows($result) > 0;
}

// Registration process
if (isset($_POST['registerBtn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $role = mysqli_real_escape_string($conn, $_POST['user_role']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $c_password = $_POST['cnfm_password'];

    // Checking whether the user is registered or not
    if (userExists($conn, $email, $phone)) {
        $_SESSION['status'] = $name.' User is already registered!';
        header('Location: ../user_account.php');
        exit();
    }else {
            $sql = "INSERT INTO `tbl_users` (`user_id`, `username`, `email`, `password`, `mobile`, `user_role_id`)
                    VALUES (NULL, '$name', '$email', '$password', '$phone', '$role')";
            $query_run = mysqli_query($conn, $sql);

            if ($query_run) {
                $_SESSION['success'] = $name . ', your account is successfully registered. Please log in now to access your account.';
                header('Location: ../login.php');
                exit();
            } else {
                $_SESSION['status'] = 'Error in database operation. Please try again.';
                header('Location: ../user_account.php');
                exit();
            }
        }
}

// login process
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['emaill']);
    $enteredPassword = $_POST['passwordd'];

    $query = "SELECT * FROM `tbl_users` WHERE `email` = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $getUser = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($getUser)) {

        // Verify the entered password using password_verify
        if (password_verify($enteredPassword, $row['password'])) {

            switch ($row['user_role_id']) {
                case '1':
                    $_SESSION['admin_name'] = $row['username'];
                    $_SESSION['admin_email'] = $row['email'];
                    $_SESSION['admin_id'] = $row['user_id'];
                    $_SESSION['admin_phone'] = $row['mobile'];
                    $_SESSION['admin_role_id'] = $row['user_role_id'];
                    header('Location: ../admin/admin_dashboard.php');
                    break;
                case '2':
                    $_SESSION['student_name'] = $row['username'];
                    $_SESSION['student_email'] = $row['email'];
                    $_SESSION['student_id'] = $row['user_id'];
                    $_SESSION['phone'] = $row['mobile'];
                    $_SESSION['student_role_id'] = $row['user_role_id'];
                    header('Location: ../student/student_dashboard.php');
                    break;
                case '3':
                    $_SESSION['instructor_name'] = $row['username'];
                    $_SESSION['instructor_email'] = $row['email'];
                    $_SESSION['instructor_id'] = $row['user_id'];
                    $_SESSION['instructor_phone'] = $row['mobile'];
                    $_SESSION['instructor_role_id'] = $row['user_role_id'];
                    header('Location: ../instructor/instructor_dashboard.php');
                    break;
            }
        } else {
            $_SESSION['status'] = 'Incorrect Password';
            header('Location: ../login.php');
        }
    } else {
        $_SESSION['status'] = 'User Email not found';
        header('Location: ../login.php');
    }
}

// deleting a use by admin

if(isset($_POST['userDeleteBtn'])){

    $user_delete_id = $_POST['user_delete_id'];

    $query = "DELETE FROM `tbl_users` WHERE `user_id` = '$user_delete_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        $_SESSION['success'] =  $_SESSION['admin_name'].', You have deleted User details';
        header('Location: ../admin/users.php');
    }else{
        $_SESSION['status'] = 'User deteals are Not deleted';
        header('Location: ../admin/users.php');
    }

}
// inserting categories in database
function categoryExist($conn, $category, $category_tag){
    $category = mysqli_real_escape_string($conn, $_POST['category_name']);
    $category_tag = mysqli_real_escape_string($conn, $_POST['category_tag']);
    $query = "SELECT * FROM `tbl_categories` WHERE `category_name` = '$course' OR `category_tag` = '$category_tag'";
    $query_run = mysqli_query($conn, $query);
    return mysqli_num_rows($query_run) > 0;
}

if(isset($_POST['category'])){
    $category = mysqli_real_escape_string($conn, $_POST['category_name']);
    $category_tag = mysqli_real_escape_string($conn, $_POST['category_tag']);
    $image =  $_FILES['category_image']['name'];

    if (categoryExist($conn, $category, $category_tag)) {
        $_SESSION['status'] = $category.' is already registered!';
        header('Location: ../admin/category.php');
        exit();
    }else{
        if(file_exists("../admin/uploads/categories/".$_FILES['category_image']['name'])){
            $filename = $_FILES['category_image']['name'];
            $_SESSION['status'] =$filename.' image is already exists. Please try again.';
            header('Location:../admin/category.php');
            exit();
        }else{
            $query = "INSERT INTO `tbl_categories` (`category_id`, `category_name`, `category_image`, `category_tag`) 
            VALUES (NULL, '$category', '$image', '$category_tag')";
           $query_run = mysqli_query($conn, $query);
    
           if ($query_run) {
               move_uploaded_file($_FILES['category_image']['tmp_name'], "../admin/uploads/categories/". $_FILES['category_image']['name']);
               $_SESSION['success'] = $category. ' is added as a Category.';
               header('Location: ../admin/category.php');
               exit();
           } else {
               $_SESSION['status'] = 'Your Data is Not added';
               header('Location:../admin/category.php');
               exit();
           }
    
        }

    }  
}
// updating categories
if (isset($_POST['edit_category'])) {
    $edit_id = $_POST['edit_id'];
    $edit_category = mysqli_real_escape_string($conn, $_POST['editCategory_name']);
    $edit_tag = mysqli_real_escape_string($conn, $_POST['editCategory_tag']);
    $edit_image = $_FILES['editCategory_image']['name'];
    $old_image = $_POST['old_image'];

    if ($edit_image != '') {
        $update_filename = $edit_image;

        $upload_path = "../admin/uploads/categories/" . $edit_image;

        if (is_uploaded_file($_FILES['editCategory_image']['tmp_name'])) {
            move_uploaded_file($_FILES['editCategory_image']['tmp_name'], $upload_path);
            unlink("../admin/uploads/categories/" . $old_image);
        } else {
            $_SESSION['status'] = "Failed to upload the image. Please try again.";
            header('Location:../admin/category.php');
            exit();
        }
    } else {
        $update_filename = $old_image;
    }

    $query = "UPDATE `tbl_categories` SET `category_name` = '$edit_category', `category_image` = '$update_filename', `category_tag` = '$edit_tag' WHERE `category_id` = '$edit_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = $edit_category . ' profile updated successfully.';
        header('Location:../admin/category.php');
    } else {
        $_SESSION['status'] = 'Failed to update category data.';
        header('Location: ../admin/category_edit.php');
    }
}

// Deleting a category
if(isset($_POST['deleteEditBtn'])){
    $category_delete_id = $_POST['deleteCategory_id'];

    $query = "DELETE FROM `tbl_categories` WHERE `category_id` = '$category_delete_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        $_SESSION['success'] =  $_SESSION['admin_name'].', You have deleted category details';
        header('Location: ../admin/category.php');
    }else{
        $_SESSION['status'] = 'Category deteals are Not deleted';
        header('Location: ../admin/category.php');
    }

}

// Courses
function courseExist($conn, $course){
    $course = mysqli_real_escape_string($conn, $_POST['course_name']);
    $query = "SELECT * FROM `tbl_courses` WHERE `course_name` = '$course'";
    $query_run = mysqli_query($conn, $query);
    return mysqli_num_rows($query_run) > 0;
}

if(isset($_POST['courses'])){
    $course = mysqli_real_escape_string($conn, $_POST['course_name']);
    $instructor = mysqli_real_escape_string($conn, $_POST['instructor_name']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    $course_price = mysqli_real_escape_string($conn, $_POST['course_price']);
    $tag_name = mysqli_real_escape_string($conn, $_POST['tag_name']);
    $image =  $_FILES['course_image']['name'];

    if (courseExist($conn, $course)) {
        $_SESSION['status'] = $course.' is already registered!';
        header('Location: ../admin/courses.php');
        exit();
    }else{
        if(file_exists("../admin/uploads/courses/".$_FILES['course_image']['name'])){

            $filename = $_FILES['course_image']['name'];
            $_SESSION['status'] =$filename.' image is already exists. Please try again.';
            header('Location:../admin/courses.php');
            exit();
        }else{
            $query = "INSERT INTO `tbl_courses` (`course_id`, `course_name`, `instructor_name`, `category_id`, `price`,`course_image`,`tag_name`) 
            VALUES (NULL, '$course', '$instructor', '$category_id', '$course_price', '$image', '$tag_name')";
            $query_run = mysqli_query($conn, $query);
    
           if ($query_run) {
               move_uploaded_file($_FILES['course_image']['tmp_name'], "../admin/uploads/courses/". $_FILES['course_image']['name']);
               $_SESSION['success'] = $course. ' is added as a Course.';
               header('Location: ../admin/courses.php');
               exit();
           } else {
               $_SESSION['status'] = 'Your Data is Not added';
               header('Location:../admin/courses.php');
               exit();
           }
    
    
        }

    }
}
// updating courses
if (isset($_POST['edit_course'])) {
    $edit_id = $_POST['editCourse_id'];
    $edit_course = mysqli_real_escape_string($conn, $_POST['editCourse_name']);
    $inst_edit = mysqli_real_escape_string($conn, $_POST['inst_name']);
    $edit_category_id = mysqli_real_escape_string($conn, $_POST['editCategory_id']);
    $edit_price = mysqli_real_escape_string($conn, $_POST['editcourse_price']);
    $edit_course_tag = mysqli_real_escape_string($conn, $_POST['editcourse_tag']);
    $edit_image = $_FILES['editcourse_image']['name'];
    $old_image = $_POST['old_image'];

    if ($edit_image != '') {
        $update_filename = $edit_image;

        $upload_path = "../admin/uploads/courses/" . $edit_image;

        if (is_uploaded_file($_FILES['editcourse_image']['tmp_name'])) {
            move_uploaded_file($_FILES['editcourse_image']['tmp_name'], $upload_path);
            unlink("../admin/uploads/courses/" . $old_image);
        } else {
            $_SESSION['status'] = "Failed to upload the image. Please try again.";
            header('Location:../admin/course_edit.php');
            exit();
        }
    } else {
        $update_filename = $old_image;
    }

    $query = "UPDATE `tbl_courses` SET `course_name` = '$edit_course', `instructor_name` = '$inst_edit', `category_id` = '$edit_category_id', `price` = '$edit_price', `course_image` = '$update_filename',`tag_name` = '$edit_course_tag' 
    WHERE `course_id` = '$edit_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = $edit_course . ' profile updated successfully.';
        header('Location:../admin/courses.php');
    } else {
        $_SESSION['status'] = 'Failed to update category data.';
        header('Location: ../admin/course_edit.php');
    }
}

// Deleting a course
if(isset($_POST['courseDeleteBtn'])){
    $course_delete_id = $_POST['deleteCourse_id'];

    $query = "DELETE FROM `tbl_courses` WHERE `course_id` = '$course_delete_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        $_SESSION['success'] =  $_SESSION['admin_name'].', You have deleted course details';
        header('Location: ../admin/courses.php');
    }else{
        $_SESSION['status'] = 'Course deteals are Not deleted';
        header('Location: ../admin/courses.php');
    }

}

// instructor registration
function InstructorExist($conn, $instructor_name, $phone_number) {
    $instructor_name = mysqli_real_escape_string($conn, $instructor_name);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $query = "SELECT * FROM `tbl_instructors` WHERE `instructor_name` = '$instructor_name' OR `phone_number`= '$phone_number'";
    $result = mysqli_query($conn, $query);

    return mysqli_num_rows($result) > 0;
}
if(isset($_POST['instructor_profile'])){
    $instructor_user_id = $_SESSION['instructor_id'];
    $instructor_name = $_SESSION['instructor_name'];
    $instructor_email = $_SESSION['instructor_email'];
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $instructor_role_id = $_SESSION['instructor_role_id'];
    $experience = mysqli_real_escape_string($conn, $_POST['experience']);
    $district = mysqli_real_escape_string($conn, $_POST['district']);
    $image =  $_FILES['instructor_image']['name'];
    $date = mysqli_real_escape_string($conn, $_POST['date']);

    if (InstructorExist($conn, $instructor_name, $phone_number)) {
        $_SESSION['status'] = $instructor_name.'  is already registered!';
        header('Location: ../instructor/add_course.php');
        exit();
    }else{
        if(file_exists("../instructor/uploads/instructor/".$_FILES['instructor_image']['name'])){

            $filename = $_FILES['instructor_image']['name'];
    
            $_SESSION['status'] =$filename.' image is already exists. Please try again.';
            header('Location:../instructor/add_course.php');
            exit();
        }else{
            $query = "INSERT INTO `tbl_instructors` (`instructor_id`, `user_id`, `instructor_name`, `email`,`phone_number`,`gender`,`user_role_id`,`course`,`district`,`instructor_image`,`doj`) 
            VALUES (NULL, '$instructor_user_id', '$instructor_name', '$instructor_email', '$phone_number', '$gender', '$instructor_role_id', '$experience', '$district', '$image', '$date')";
            $query_run = mysqli_query($conn, $query);
    
           if ($query_run) {
               move_uploaded_file($_FILES['instructor_image']['tmp_name'], "../instructor/uploads/instructor/". $_FILES['instructor_image']['name']);
               $_SESSION['success'] = $instructor_name. ', you have completed your registration on this platform as an instructor.';
               header('Location: ../instructor/profile.php');
               exit();
           } else {
               $_SESSION['status'] = 'Your Data is Not added';
               header('Location:../instructor/add_course.php');
               exit();
           }
    
    
        }
    }
   
}

//instructor profile picture update
if(isset($_POST['intsructor_profile'])){
    $edit_instr_id = $_POST['edit_id'];
    $instructor_user_id = $_SESSION['instructor_id'];
    $edit_instr_name = mysqli_real_escape_string($conn, $_POST['name_profile']);
    $instructor_email = $_SESSION['instructor_email'];
    $edit_instr_phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $edit_instr_gender = mysqli_real_escape_string($conn, $_POST['gender_name']);
    $instructor_role_id = $_SESSION['instructor_role_id'];
    $edit_instr_experience = mysqli_real_escape_string($conn, $_POST['experience_name']);
    $edit_instr_district = mysqli_real_escape_string($conn, $_POST['district_name']);
    $edit_instr_image = $_FILES['profile_image']['name'];
    $instr_old_image = $_POST['instr_old_image'];
    $edit_instr_date = mysqli_real_escape_string($conn, $_POST['date_name']);

    if ($edit_instr_image != '') {
        $update_filename = $edit_instr_image;

        $upload_path = "../instructor/uploads/instructor/" . $edit_instr_image;

        if (is_uploaded_file($_FILES['profile_image']['tmp_name'])) {
            move_uploaded_file($_FILES['profile_image']['tmp_name'], $upload_path);
            unlink("../instructor/uploads/instructor/" . $instr_old_image);
        } else {
            $_SESSION['status'] = "Failed to upload the image. Please try again.";
            header('Location:../instructor/profile_edit.php');
            exit();
        }
    } else {
        $update_filename = $instr_old_image;
    }

    $query = "UPDATE `tbl_instructors` SET `user_id` = '$instructor_user_id', `instructor_name` = '$edit_instr_name', `email` = '$instructor_email', `phone_number` = '$edit_instr_phone', `gender` = '$edit_instr_gender',`user_role_id` = '$instructor_role_id', `course` = '$edit_instr_experience', `district` = '$edit_instr_district', `instructor_image` = '$update_filename', `doj` = '$edit_instr_date'
    WHERE `instructor_id` = '$edit_instr_id'";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['success'] = $edit_instr_name . ', your profile is updated successfully.';
        header('Location:../instructor/profile.php');
    } else {
        $_SESSION['status'] = 'Failed to update category data.';
        header('Location: ../instructor/profile_edit.php');
    }

}

// Student registration
function studentExist($conn, $phone){
    $phone = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $query = "SELECT * FROM `tbl_students` WHERE `phone`= '$phone'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;

}

if(isset($_POST['student_profile'])){
    $student_user_id = $_SESSION['student_id'];
    $student_name = $_SESSION['student_name'];
    $student_email = $_SESSION['student_email'];
    $phone = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $student_role_id = $_SESSION['student_role_id'];
    $district = mysqli_real_escape_string($conn, $_POST['district']);
    $image =  $_FILES['student_image']['name'];
    $course = mysqli_real_escape_string($conn, $_POST['course']);

    if (studentExist($conn, $phone)) {
        $_SESSION['status'] = $student_name.'  is already registered!';
        header('Location: ../student/register.php');
        exit();
    }else{
        if(file_exists("../student/uploads/students/".$_FILES['student_image']['name'])){

            $filename = $_FILES['student_image']['name'];
    
            $_SESSION['status'] =$filename.' image is already exists. Please try again.';
            header('Location:../student/register.php');
            exit();
        }else{
            $query = "INSERT INTO `tbl_students` (`student_id`, `user_id`, `student_name`, `email`,`phone`,`gender`,`user_role_id`,`district`,`student_image`,`course`) 
            VALUES (NULL, '$student_user_id', '$student_name', '$student_email', '$phone', '$gender', '$student_role_id', '$district', '$image', '$course')";
            $query_run = mysqli_query($conn, $query);
    
           if ($query_run) {
               move_uploaded_file($_FILES['student_image']['tmp_name'], "../student/uploads/students/". $_FILES['student_image']['name']);
               $_SESSION['success'] = $student_name. ", You've finished registering as a student on this site.";
               header('Location: ../student/profile.php');
               exit();
           } else {
               $_SESSION['status'] = 'Your Data is Not added';
               header('Location:../student/register.php');
               exit();
           }
    
    
        }
    }

}
// student profile picture update
if(isset($_POST['student_edit_profile'])){
    $edit_student_id = $_POST['edit_id'];
    $student_user_id = $_SESSION['student_id'];
    $edit_name = mysqli_real_escape_string($conn, $_POST['st_name_profile']);
    $student_email = $_SESSION['student_email'];
    $edit_phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $edit_gender = mysqli_real_escape_string($conn, $_POST['gender_name']);
    $instructor_role_id = $_SESSION['student_role_id'];
    $edit_district = mysqli_real_escape_string($conn, $_POST['district_name']);
    $edit_student_image = $_FILES['st_profile_image']['name'];
    $student_old_image = $_POST['student_old_image'];
    $edit_student_course = mysqli_real_escape_string($conn, $_POST['st_course_name']);

    if ($edit_student_image != '') {
        $update_filename = $edit_student_image;

        $upload_path = "../student/uploads/students/" . $edit_student_image;

        if (is_uploaded_file($_FILES['st_profile_image']['tmp_name'])) {
            move_uploaded_file($_FILES['st_profile_image']['tmp_name'], $upload_path);
            unlink("../student/uploads/students/" . $student_old_image);
        } else {
            $_SESSION['status'] = "Failed to upload the image. Please try again.";
            header('Location:../student/profile_edit.php');
            exit();
        }
    } else {
        $update_filename = $student_old_image;
    }

    $query = "UPDATE `tbl_students` SET `user_id` = '$student_user_id', `student_name` = '$edit_name', `email` = '$student_email', `phone` = '$edit_phone',`gender` = '$edit_gender', `user_role_id` = '$instructor_role_id', `district` = '$edit_district', `student_image` = '$update_filename', `course` = '$edit_student_course'
    WHERE `student_id` = '$edit_student_id'";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['success'] = $edit_name . ', your profile is updated successfully.';
        header('Location:../student/profile.php');
    } else {
        $_SESSION['status'] = 'Failed to update category data.';
        header('Location: ../student/profile_edit.php');
    }

}
