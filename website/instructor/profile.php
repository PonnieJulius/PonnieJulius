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

<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="instructor_dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="instructor_dashboard.php">My Account</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
          </ol>
        </nav>
      </div>
    </div>
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
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <?php
              $user_id = $_SESSION['instructor_id'];
              $query = "SELECT * FROM `tbl_instructors`WHERE `user_id`= '$user_id'";
              $query_run = mysqli_query($conn, $query);

              if(mysqli_num_rows($query_run) > 0){
                foreach($query_run as $instructor){
                  $_SESSION['instructor_profile'] = $instructor['instructor_image'];
                  $_SESSION['instructor_update_name'] = $instructor['instructor_name'];
                  ?>               

            <img src="<?php echo "uploads/instructor/".$_SESSION['instructor_profile'] ?>" alt="avatar" class="img-fluid mb-3" style="border-radius: 10px;">
            <h3 class="text-dark"><?php echo  $_SESSION['instructor_update_name'] ?></h3>

            <h5 class="text-danger alert alert-success">Instructor</h5>
            <div class="d-flex justify-content-center mb-2">
              <a href="instructor_dashboard.php" class="btn btn-danger me-3">Cancel</a>
              <a href="profile_edit.php?id=<?php echo $instructor['instructor_id'] ?>" type="button" class="btn btn-outline-primary ms-1">Edit Profile</a>
            </div>
          <?php
              }
            }else{?>
             <img src="assets/profile.png" alt="avatar" class="rounded-circle img-fluid" style="width: 100%">
            <h4 class="my-3"><?php echo $_SESSION['instructor_name'] ?></h4>
            <div class="d-flex justify-content-center mb-2">
              <a href="instructor_dashboard.php" class="btn btn-danger me-3">Cancel</a>
            </div>
            <?php
            }
          ?>
        </div>
        </div>
      </div>

      
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <?php
              $user_id = $_SESSION['instructor_id'];
              $query = "SELECT * FROM `tbl_instructors`WHERE `user_id`= '$user_id'";
              $instruct_query_run = mysqli_query($conn, $query);
              if(mysqli_num_rows($query_run) > 0){
                foreach($query_run as $instructor){
                  $_SESSION['email'] = $instructor['email'];
                  $_SESSION['phone'] = $instructor['phone_number'];
                  $_SESSION['instr_category'] = $instructor['course'];
                  $_SESSION['gender'] = $instructor['gender'];
                  $_SESSION['district'] = $instructor['district'];
                  $_SESSION['category'] = $instructor['course'];
                  $_SESSION['date'] = $instructor['doj'];
                  ?>
                        <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo  $_SESSION['instructor_update_name']?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION['email']?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone Number</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION['phone'] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Category</p>
              </div>
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

              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION['category_name']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Gender</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION['gender'] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">District</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION['district'] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Date</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION['date'] ?></p>
              </div>
            </div>
                  <?php
                }
              }
            ?>            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php 
include('../includes/fdb.php');
include('../includes/script.php');
?>