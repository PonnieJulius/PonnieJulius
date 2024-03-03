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
  <div class="container-fluid py-5">
          <div class="card shadow">
            <div class="card-header py-3">
              <h6 class="m-0 text-primary font-weight-bold">Registered Users
              <!-- Button trigger modal -->
                <button type="button" class="mx-2 btn btn-primary justify-content-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Add
                </button>
              </h6>
            </div> 
            
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
              <div class="table-responsive">
              <?php
                    $query = "SELECT * FROM `tbl_users`";
                    $query_run = mysqli_query($conn, $query);
              ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="text-center">
                      <th>Number</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile</th>
                      <th>Role</th>
                      <th>DELETE</th>
                    </tr>
                  </thead>
                  <tbody> 
                  <?php
                      if(mysqli_num_rows($query_run) > 0){
                          while($row = mysqli_fetch_assoc($query_run)){?>
                          <tr>
                              <td> <?php echo $row['user_id']; ?></td>
                              <td><?php echo $row['username']; ?></td>  
                              <td><?php echo $row['email']; ?></td>
                              <td><?php echo $row['mobile']; ?></td>
                              <td>
                                  <?php
                                  if($row['user_role_id'] == '1'){
                                      echo 'Admin'; 
                                  }elseif($row['user_role_id'] == '2'){
                                      echo 'Student'; 
                                  }elseif($row['user_role_id'] == '3'){
                                      echo 'Instructor'; 
                                  }elseif($row['user_role_id'] == '0'){
                                    echo 'Student';
                                  }
                                  
                                  ?>
                                  </td>
                          <td>
                              <form action="../db/code.php" method="post">
                                  <input type="hidden" name="user_delete_id" value="<?php echo $row['user_id'];?>">
                                  <button type="submit" name="userDeleteBtn" class="btn btn-danger text-center btn-sm">DELETE</button>
                              </form>
                          </td>
                      </tr>
                          <?php
                          }
                      }else{
                          echo  $_SESSION['admin_name'].', there is no result found!'; 
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
