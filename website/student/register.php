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
    <div class="row justify-content-center">
      <div class="col-lg-10">
        
        <div class="card mb-4">
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
             <form action="../db/code.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">

                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Phone number:</label>
                        <input type="text" name="phone_number" class="form-control"required>
                    </div>

                    <div class="mb-3">                          
                            <div class="mb-3 mt-3">
                                <label for="pwd" class="form-label">Gender:</label>
                                <select name="gender" class="form-control dropdown-toggle" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                </select>
                            </div>
                    </div>
                    <div class="mb-3">
                        <label for="pwd" class="form-label">District:</label>
                        <input type="text" name="district" class="form-control"required>
                    </div>
                    <div class="mb-3">
                        <label for="pwd" class="form-label">Course:</label>
                        <input type="text" name="course" class="form-control"required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Profile Picture:</label>
                        <input type="file" name="student_image" accept="image/jpg, image/png, image/jpeg" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="student_profile">Submit</button>
                    </div>            
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</section>



<?php 
include('../includes/fdb.php');
include('../includes/script.php');
?>
