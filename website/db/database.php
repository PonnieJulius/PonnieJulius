<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ponnie_works";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $dbconfig = mysqli_select_db($conn, $dbname);
    if ($dbconfig) {
        // echo 'Database connected';
      }else{
        echo '  <div class="container">
                  <div class="row">
                      <div class="col-lg-6 mr-auto ml-auto text-center py-5 mt-5">
                      <div class="card-box">
                        <h1 class="card-title fw-bolder">404 Error</h1>
                        <p class="card-text">The page you are Searching for is not avilable.</p>
                        <a href="index.php" class="btn btn-primary">Go back to Home Page</a>
                      </div>
                    </div>
                  </div>
              </div>
              ';        
      }
?>