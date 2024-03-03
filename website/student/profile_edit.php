<?php
require('../db/security.php');
$student_id = $_SESSION['student_id'];
if(!isset($student_id)){
   header('Location: ../login.php');
}
 include('../includes/hdb.php');
 include('../includes/sidenavinstructor.php');
 include('../includes/topnav.php');
?> 

<section style="background-color: #eee;">
  <div class="container py-5">
            <?php
                if(isset($_SESSION['success']) && $_SESSION['success'] !=''){
                    echo '<div class="alert alert-primary"><strong>Hey, </strong>'.$_SESSION['success'].'</div>';
                    unset($_SESSION['success']);
                }
                if(isset($_SESSION['status']) && $_SESSION['status'] !=''){
                    echo '<div class="alert alert-danger"><strong>Sorry!! </strong>'.$_SESSION['status'].'</div>';
                    unset($_SESSION['status']);
                }
            ?>
  <div class="row justify-content-center"> 
      <?php
        $id = $_GET['id'];
        $query = "SELECT * FROM `tbl_students` WHERE `student_id` = $id";
        $query_run = mysqli_query($conn, $query);

        if(mysqli_num_rows($query_run) > 0){
          foreach($query_run as $row){
            // echo $row['instructor_id'];
            ?>
            <div class="col-lg-8">
               <div class="card mb-4">
                  <form action="../db/code.php" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                     <input type="hidden" name="edit_id" value="<?php echo $row['student_id']; ?>"> 
                            <div class="mb-3 mt-3">
                                <label for="email" class="form-label">Name</label>
                                <input type="text" value="<?php echo $row['student_name'] ?>" name="st_name_profile" class="form-control">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" value="<?php echo $row['email'] ?>" class="form-control" disabled>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="email" class="form-label">Phone</label>
                                <input type="text" value="<?php echo  $row['phone']?>" name="phone" class="form-control">
                            </div>
                            <div class="mb-3">                          
                                <label for="pwd" class="form-label">Gender:</label>
                                <select name="gender_name" class="form-control dropdown-toggle">
                                  <option value="<?php echo  $row['gender']?>"><?php echo  $row['gender']?></option>
                                  <option value="Male">Male</option>
                                  <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="pwd" class="form-label">District:</label>
                                <input type="text" value="<?php echo  $row['district']?>" name="district_name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="pwd" class="form-label">Course:</label>
                                <input type="text" value="<?php echo  $row['course']?>" name="st_course_name" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image:</label>
                                <input type="file" name="st_profile_image" accept="image/jpg, image/png, image/jpeg" class="form-control">
                                <input type="hidden" name="student_old_image" value="<?php echo $row['student_image']?>"class="form-control">
                            </div>
                          
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="location.reload();">Close</button>
                              <button type="submit" class="btn btn-primary" name="student_edit_profile">Update</button>
                            </div>   
                    </div>
                  </form>
                </div>
            </div>
            <?php
          }
        }
      ?>     
  </div>
</section>

<?php 
include('../includes/fdb.php');
include('../includes/script.php');
?>