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
       
<div class="container-xxl flex-grow-1 container-p-y">
<!-- courses -->
    <div class="row mb-5">
        <?php
            $category_id = $_GET['id'];
           $query = "SELECT * FROM `tbl_courses` WHERE `category_id` = '$category_id'";
           $query_run = mysqli_query($conn, $query);

           if(mysqli_num_rows($query_run) > 0){
            foreach($query_run as $course){
            $_SESSION['course_id'] = $course['course_id'];?>
                <div class="col-md-6">
                    <div class="card p-2 mb-3">
                    <div class="row g-0">
                        <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $course['course_name'];?></h5>
                            <p class="card-text"><?php echo $course['tag_name'];?></p>
                            <h6 class="card-text">
                                Expert: <?php echo $course['instructor_name'];?>
                            </h6>
                            <a href="enrollment.php?id=<?php echo $_SESSION['course_id'];?>" class="btn btn-outline-danger text-center"><?php echo $course['price'];?></a>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <img class="card-img card-img-right rounded-3" src="<?php echo "../admin/uploads/courses/".$course['course_image'] ?>" alt="Card image" />
                        </div>
                    </div>
                    </div>
                </div>
            <?php
            }
           }else{
            echo "No result found";
           }
        ?>
        
    </div>

            
            
<?php 
include('../includes/fdb.php');?>

<?php
include('../includes/script.php');
?>
 