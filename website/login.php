<?php
require('db/database.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Ponnie - Login</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login Here to Acess Your Acount</h3></div>
                                    <form action="db/code.php" method="POST">
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
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputEmail" type="email" name="emaill" placeholder="name@example.com" required />
                                                    <label for="inputEmail">Email</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputPassword" type="password" name="passwordd" placeholder="Password" required />
                                                    <label for="inputPassword">Password</label>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="mb-0">
                                                            <div class="d-grid"><a class="btn btn-danger btn-block mb-3" href="index.php">Cancel</a></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-0">
                                                            <div class="d-grid"><button type="sumbit" name="login" class="btn btn-primary btn-block">Log In</button></div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="card-footer text-center py-3">
                                            <div class="fs-6">Need an account? <a href="user_account.php">Register Now</a></div>
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
