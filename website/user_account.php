<?php
  require('db/security.php');
?>
  <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Ponnie Works-register</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <form action="db/code.php" method="POST">
                                        <div class="card-body">
                                                    <?php
                                                        if(isset($_SESSION['status']) && $_SESSION['status'] !=''){
                                                            echo '<div class="alert alert-danger"><strong>Sorry!! </strong>'.$_SESSION['status'].'</div>';
                                                            unset($_SESSION['status']);
                                                        }
                                                    ?>
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <div class="form-floating mb-3 mb-md-0">
                                                            <input class="form-control" id="inputFirstName" type="text" name="name" placeholder="Enter your first name" required/>
                                                            <label for="inputFirstName">Name</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputEmail" type="email"  name="email" placeholder="name@example.com" required/>
                                                    <label for="inputEmail">Email</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputEmail" type="text"  name="phone" placeholder="name@example.com" required/>
                                                    <label for="inputEmail">Phone</label>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>User Role</label>
                                                    <select name="user_role" class="form-control" required>
                                                        <?php
                                                        $roles = mysqli_query($conn, "SELECT `user_role_id` FROM `tbl_users` WHERE user_role_id = '1'");
                                                        if(mysqli_num_rows($roles) > 0){?>
                                                        <option value="2">Student</option>
                                                        <option value="3">Instructor</option>
                                                        <?php
                                                        }else{?>
                                                            <option value="1">Admin</option>
                                                            <option value="2">Student</option>
                                                            <option value="3">Instructor</option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <div class="form-floating mb-3 mb-md-0">
                                                            <input class="form-control" id="inputPassword" type="password"  name="password" placeholder="Create a password" />
                                                            <label for="inputPassword">Password</label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="mb-0">
                                                            <div class="d-grid"><a class="btn btn-danger btn-block" href="index.php">Cancel</a></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-0">
                                                            <div class="d-grid"><button type="sumbit" name="registerBtn" class="btn btn-primary btn-block">Create Account</button></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="card-footer text-center py-3">
                                            <div class="fs-6">Have an account? <a href="login.php">Login In Now</a></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>