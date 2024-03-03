<?php
    require('../db/security.php');
    $admin_id = $_SESSION['admin_id'];
    if(!isset($admin_id)){
        header('Location: ../login.php');
    }
    include('../includes/hdb.php'); 
    include('../includes/sidenavadmin.php'); 
    include('../includes/topnav.php');
?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add a Course</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="../db/code.php" method="POST" enctype="multipart/form-data">

                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Course:</label>
                        <input type="text" name="course_name" class="form-control"required>
                    </div>

                    <div class="mb-3">
                        <?php
                          $query = "SELECT * FROM `tbl_categories`";
                          $query_run = mysqli_query($conn, $query);
                            if(mysqli_num_rows($query_run)> 0){
                              ?>                              
                              <div class="mb-3 mt-3">
                                <label for="pwd" class="form-label">Category:</label>
                                <select name="category_id" class="form-control dropdown-toggle" required>
                                <option value="">Choose a Catergory</option>
                                  <?php
                                   foreach($query_run as $category){
                                  ?>
                                  <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name'];?></option>
                                  <?php
                                     }
                                  ?>
                                </select>
                              </div>
                              <?php
                            }else{
                              echo '<div class="alert alert-danger"><strong>Sorry!! </strong>No data found</div>';
                            }
                         
                          ?>
                    </div>
                    <div class="mb-3">
                        <label for="pwd" class="form-label">Price:</label>
                        <input type="text" name="course_price" class="form-control"required>
                    </div>
                    <div class="mb-3">
                        <label for="pwd" class="form-label">Tag Name:</label>
                        <input type="text" name="tag_name" class="form-control"required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image:</label>
                        <input type="file" name="course_image" accept="image/jpg, image/png, image/jpeg" class="form-control" required>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="courses">Submit</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>

<div class="container py-5">
    <div class="card">
        <h5 class="card-header justify-content-between">
            Instructors
            <button type="button" class="mx-2 btn btn-primary float-right"data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add
            </button>
        </h5>
        <div class="card-body">
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
            <div class="table-responsive text-nowrap">
            <?php
                $query = "SELECT * FROM `tbl_instructors`";
                $query_run = mysqli_query($conn, $query);
                ?>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Instructor</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Course</th>
                    <th>District</th>
                    <th>image</th>                    
                    <th>Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                     if(mysqli_num_rows($query_run) > 0){
                        foreach($query_run as $row){
                            $_SESSION['category'] = $row['course'];
                            ?>
                        <tr>
                            <td>
                                <i class="fab fa-angular fa-lg text-danger me-3"></i><strong><?php echo $row['instructor_id'];?></strong>
                            </td>
                                <td><?php echo $row['instructor_name'];?></td>
                                <td><?php echo $row['email'];?></td>
                                <td><?php echo $row['phone_number'];?></td>
                                <td><?php echo $row['gender'];?></td>
                                <?php
                                    $category = $_SESSION['category'];
                                    $query = "SELECT * FROM `tbl_categories` WHERE `category_id` = '$category'";
                                    $query_run = mysqli_query($conn, $query);

                                    if(mysqli_num_rows($query_run) > 0){
                                        foreach($query_run as $category_name){
                                        $_SESSION['category_name'] = $category_name['category_name'];
                                        }
                                    }
                                ?>
                                <td><?php echo $_SESSION['category_name'];?></td>
                                <td><?php echo $row['district'];?></td>
                            <td>
                                <?php 
                                if($row['instructor_image'] == null){
                                    ?>
                                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom"data-bs-placement="top"class="avatar avatar-lg align-items-center pull-up"title="<?php echo $row['instructor_name'] ?>">
                                            <img src="assets/profile.png" alt="Avatar" class="rounded-5"/>
                                            </li>
                                        </ul>
                                    <?php
                                }else{
                                    ?>
                                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom"data-bs-placement="top"class="avatar avatar-lg align-items-center pull-up"title="<?php echo $row['instructor_name'] ?>">
                                                <img src="<?php echo "../instructor/uploads/instructor/".$row['instructor_image'] ?>" alt="Avatar" class="rounded-5"/>
                                            </li>
                                        </ul>
                                    <?php
                                }
                                ?>
                            </td>
                                
                                <td><?php echo $row['doj'];?></td>
                                <td>
                                    <a class="dropdown-item btn-primary text-center rounded-5" href="instructor_edit.php?id=<?php echo $row['instructor_id'];?>">
                                        <i class="bx bx-edit-alt me-1"></i></a>
                                </td>
                                <td>
                                    <form action="../db/code.php" method="post">
                                        <input type="hidden" name="deleteCourse_id" value="<?php echo $row['instructor_id'];?>">
                                        <button type="submit" name="instructorDeleteBtn" class="dropdown-item btn-danger btn-sm align-items-center text-center " href="javascript:void(0);"><i class="bx bx-trash me-1"></i></button>
                                    </form>
                                </td>
                        </tr>
                        <?php
                        }
                    }else{
                        echo 'No result found';
                    }
                          
                    ?>                   
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
<?php 
include('../includes/fdb.php');
include('../includes/script.php');
?>