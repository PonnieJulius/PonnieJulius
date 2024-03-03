<?php
require('../db/security.php');
 $instructor_id = $_SESSION['instructor_id'];
 if(!isset($instructor_id)){
    header('Location: ../login.php');
 }
 include('../includes/hdb.php');
 include('../includes/sidenavinstructor.php');
 include('../includes/topnav.php');

?> 
<div class="container-xxl flex-grow-1 container-p-y">
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
                          <a href="courses.php?id=<?php echo $category_id;?>" class="btn btn-outline-danger text-center">Add a Course</a>
                        </div>
                      </div>
                    </div>
                  <?php
                  }
                }
              ?>
          </div>

<?php 
include('../includes/fdb.php');
include('../includes/script.php');
?>

