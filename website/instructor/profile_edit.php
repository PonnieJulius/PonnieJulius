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
        $query = "SELECT * FROM `tbl_instructors` WHERE `instructor_id` = $id";
        $query_run = mysqli_query($conn, $query);

        if(mysqli_num_rows($query_run) > 0){
          foreach($query_run as $row){
            // echo $row['instructor_id'];
            ?>
            <div class="col-lg-8">
               <div class="card mb-4">
                  <form action="../db/code.php" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                     <input type="hidden" name="edit_id" value="<?php echo $row['instructor_id']; ?>"> 
                            <div class="mb-3 mt-3">
                                <label for="email" class="form-label">Name</label>
                                <input type="text" value="<?php echo $row['instructor_name'] ?>" name="name_profile" class="form-control">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" value="<?php echo  $row['email']?>" class="form-control" disabled>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="email" class="form-label">Phone</label>
                                <input type="text" value="<?php echo  $row['phone_number']?>" name="phone" class="form-control">
                            </div>
                            <div class="mb-3">
                            <?php
                              $query = "SELECT * FROM `tbl_categories`";
                              $query_run = mysqli_query($conn, $query);
                        
                              if(mysqli_num_rows($query_run) > 0){
                                ?>
                              <label for="pwd" class="form-label">Category:</label>
                                  <select name="experience_name" class="form-control dropdown-toggle">
                                  <?php
                                    foreach($query_run as $course){
                                      $_SESSION['instr_category_id'] = $course['category_id'];
                                    $_SESSION['instr_category'] = $course['category_name'];
                                  ?>
                                  <option value="<?php echo $_SESSION['instr_category_id']; ?>"><?php echo $_SESSION['instr_category'];?></option>
                                  <?php
                                   }
                              }else{
                              echo '<div class="alert alert-danger"><strong>Sorry!! </strong>No data found</div>'; 
                              }?>
                               </select> 
                             </div>
                            <div class="mb-3">                          
                                <label for="pwd" class="form-label">Gender:</label>
                                <select name="gender_name" class="form-control dropdown-toggle">
                                  <option><?php echo  $row['gender']?></option>
                                  <option value="Male">Male</option>
                                  <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="pwd" class="form-label">District:</label>
                                <input type="text" value="<?php echo  $row['district']?>" name="district_name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="pwd" class="form-label">Date:</label>
                                <input type="date" value="<?php echo  $row['doj']?>" name="date_name" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image:</label>
                                <input type="file" name="profile_image" accept="image/jpg, image/png, image/jpeg" class="form-control">
                                <input type="hidden" name="instr_old_image" value="<?php echo $row['instructor_image']?>"class="form-control">
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="location.reload();">Close</button>
                              <button type="submit" class="btn btn-primary" name="intsructor_profile">Update</button>
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