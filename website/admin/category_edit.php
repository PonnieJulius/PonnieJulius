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
<div class="container  py-5">
    <div class="row justify-content-center">
        <div class="col-md-10"> 
            <div class="card">
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
                <?php
                    $id = $_GET['id'];
                    $query = "SELECT * FROM `tbl_categories` WHERE `category_id` = '$id'";
                    $query_run = mysqli_query($conn, $query);

                    if(mysqli_num_rows($query_run) > 0){
                        foreach($query_run as $row){?>
                            <form action="../db/code.php" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    <h1 class="modal-title fs-4 text-primary text-center" id="exampleModalLabel">Edit Category</h1>
                                    <input type="hidden" name="edit_id" value="<?php echo $row['category_id']; ?>"> 
                                    <div class="card-body">                
                                        <div class="mb-3 mt-3">
                                            <label class="form-label">Category:</label>
                                            <input type="text" name="editCategory_name" class="form-control" value="<?php echo $row['category_name'] ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Tag Name:</label>
                                            <input type="text" name="editCategory_tag"  value="<?php echo $row['category_tag'] ?>" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image:</label>
                                            <input type="file" name="editCategory_image" accept="image/jpg, image/png, image/jpeg" class="form-control">
                                            <input type="hidden" name="old_image"value="<?php echo $row['category_image'] ?>" accept="image/jpg, image/png, image/jpeg" class="form-control">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="location.reload();">Close</button>
                                            <button type="submit" class="btn btn-primary" name="edit_category">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                            <?php
                        }

                    }else{
                        echo 'Not Data Found';
                    }
                ?>
            </div>

        </div>
    </div>
</div>

       

<?php
    include('../includes/fdb.php');
    include('../includes/script.php');
?>
