<?php
  require('../db/security.php');

 $student_id = $_SESSION['student_id'];
 if(!isset($student_id)){
    header('Location: ../login.php');
 }

 include('../includes/hdb.php');
 include('../includes/sidenavstudent.php');
 include('../includes/topnav.php');
?>
       
            <div class="container-xxl flex-grow-1 container-p-y">
<!-- categories -->
            <div class="row mb-5">
              <?php
                $query = "SELECT * FROM `tbl_categories`";
                $query_run = mysqli_query($conn, $query);

                if(mysqli_num_rows($query_run) > 0){
                  foreach($query_run as $category){
                    $category_id = $category['category_id'];
                    ?>
                    <div class="col-md-4 col-lg-4 mb-3">
                      <div class="card p-2 h-100">
                        <img class="card-img-top" src="<?php echo "../admin/uploads/categories/".$category['category_image'] ?>" alt="Card image cap" />
                        <div class="card-body text-center">
                          <h5 class="card-title text-center fs-4"><?php echo $category['category_name']?></h5>
                          <a href="courses.php?id=<?php echo $category_id;?>" class="btn btn-outline-danger text-center">View Courses</a>
                        </div>
                      </div>
                    </div>
                  <?php
                  }
                }
              ?>
            </div>

            
            
<?php 
include('../includes/fdb.php');?>
  <?php
    $user_student_id = $_SESSION['student_id'];
    $query = "SELECT * FROM `tbl_students`WHERE `user_id`= '$user_student_id'";
    $query_run = mysqli_query($conn, $query);
    if(mysqli_num_rows($query_run) > 0){
      foreach($query_run as $student){
        
      }
    }
  ?>
<div class="buy-now">
    <a href="register.php"class="btn btn-danger btn-buy-now">Register</a>
</div>
<?php
include('../includes/script.php');
?>
 