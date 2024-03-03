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
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <?php
              $user_id = $_SESSION['student_id'];
              $query = "SELECT * FROM `tbl_students`WHERE `user_id`= '$user_id'";
              $query_run = mysqli_query($conn, $query);

              if(mysqli_num_rows($query_run) > 0){
                foreach($query_run as $student){
                  $_SESSION['student_profile'] = $student['student_image'];
                  $_SESSION['student_update_name'] = $student['student_name'];
                  ?>               

            <img src="<?php echo "uploads/students/".$_SESSION['student_profile'] ?>" alt="avatar" class="img-fluid mb-3" style="border-radius: 10px;">
            <h3 class="text-dark"><?php echo  $_SESSION['student_update_name'] ?></h3>
  
            <h5 class="text-danger alert alert-success">Student</h5>
            <div class="d-flex justify-content-center mb-2">
              <a href="student_dashboard.php" class="btn btn-danger me-3">Cancel</a>
              <a href="profile_edit.php?id=<?php echo $student['student_id'] ?>" type="button" class="btn btn-outline-primary ms-1">Edit Profile</a>
            </div>
          <?php
              }
            }else{?>
             <img src="assets/profile.png" alt="avatar" class="rounded-circle img-fluid" style="width: 100%">
            <h4 class="my-3"><?php echo $_SESSION['student_name'] ?></h4>
            <div class="d-flex justify-content-center mb-2">
              <a href="student_dashboard.php" class="btn btn-danger me-3">Cancel</a>
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
              $user_id = $_SESSION['student_id'];
              $query = "SELECT * FROM `tbl_students`WHERE `user_id`= '$user_id'";
              $instruct_query_run = mysqli_query($conn, $query);
              if(mysqli_num_rows($query_run) > 0){
                foreach($query_run as $student){
                  $_SESSION['phone'] = $student['phone'];
                  $_SESSION['email'] = $student['email'];
                  $_SESSION['gender'] = $student['gender'];
                  $_SESSION['district'] = $student['district'];
                  $_SESSION['course'] = $student['course'];
                  ?>
                        <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo  $_SESSION['student_update_name']?></p>
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
                <p class="mb-0">Course</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION['course']?></p>
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
                <p class="mb-0">Gender</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION['gender'] ?></p>
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
