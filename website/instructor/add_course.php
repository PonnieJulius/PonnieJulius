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
            <li class="breadcrumb-item active" aria-current="page"></li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-10">
        
        <div class="card mb-4">
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
                            <?php
                              $query = "SELECT * FROM `tbl_categories`";
                              $query_run = mysqli_query($conn, $query);
                        
                              if(mysqli_num_rows($query_run) > 0){?>
                              <label for="pwd" class="form-label">Category:</label>
                                  <select name="experience" class="form-control dropdown-toggle">
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
                        <label for="pwd" class="form-label">District:</label>
                        <input type="text" name="district" class="form-control"required>
                    </div>
                    <div class="mb-3">
                        <label for="pwd" class="form-label">Date of jioning:</label>
                        <input type="date" name="date" class="form-control"required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Profile Picture:</label>
                        <input type="file" name="instructor_image" accept="image/jpg, image/png, image/jpeg" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="instructor_profile">Submit</button>
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