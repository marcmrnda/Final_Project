<?php 
require_once('classes/database.php');
$con = new database();
session_start();

$id = $_SESSION['user_id'];
$data = $con->viewdata($id);

if(empty($_SESSION['username'])) {

  header('location:login.php');
  exit();

}

if(!isset($_SESSION['username'])|| $_SESSION['account_type'] != 1) {
  header('location:login.php');
  exit();
}

  if (isset($_POST['updateSkill'])) {
    $skillsName =  $_POST['skillsName'];
    $skillsPercentage = $_POST['skillsPer'];
    $SkillsID = $_POST['ids'];
    
              if ($con->updateSkills($SkillsID, $skillsName, $skillsPercentage)) {

                  header('location:index.php');
              }
            }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="./aos-master/dist/aos.css">
    <title>Document</title>
</head>
<body>
<div class="editall">

    <nav class="navbar navbar-expand-lg">
            
        <div class="container-fluid">
            <div class="cat">
                <img src="./backgrounds/14-40-05-944_512.webp" alt="" class="catwalk">
              </div>
          <a class="navbar-brand" href="#">
            <img src="./backgrounds/TITANS UNIVERSITY (1).png" alt="">
          </a>
            <button class="navbar-toggler burger" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNav">
            
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php#home">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php#portfolio">Portfolio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php#about">About Me</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php#contact">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link split" href="./tables.php"><i class="fa-solid fa-gear"></i></a>
              </li>
            </ul>

          </div>
        </div>
      </nav>

    <div class="card1">
    <form action="editSkills.php" method="post" enctype="multipart/form-data">
          <div class="form-row">
            <h1 class="display-1"> Edit Skills Page</h1>
            
            <div class="form-group">
              <label for="skillsName">Skills Name:</label>
              <input type="text" class="form-control" id="skillsName" name="skillsName" value="<?php echo $data['skills_name']?>">
            </div>
            <div class="form-group">
              <label for="userDescription">Skills Percentage:</label>
              <input type="text" class="form-control" id="skillsPer" name="skillsPer" value="<?php echo $data['skills_percentage']?>">
            </div>
            <input type="text" name="ids" value="<?php echo $data['skills_id']; ?>">
            <button type="submit" class="btn btn-primary" name="updateSkill">Update Page</button>
          </div>
          
        </form>
      </div>
</div>
    
 <script src="bootstrap-4.5.3-dist/js/bootstrap.js"></script>
<script src="bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<script src="./typed.js-2.1.0/dist/typed.umd.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
<script src="./aos-master/dist/aos.js"></script>
<script src="app.js"></script>
</body>
</html>