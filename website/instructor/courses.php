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
<div class="container-xxl flex-grow-1 container-p-y">
    


<?php 
include('../includes/fdb.php');
include('../includes/script.php');
?>
