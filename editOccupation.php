<?php 
require_once('classes/database.php');
$con = new database();
session_start();

$id = $_SESSION['user_id'];
$data = $con->viewdata($id);


  if (isset($_POST['updateOccu'])) {
    $occupation1 = $_POST['occup1'];
    $occupation2 = $_POST['occup2'];
    $occupation3 = $_POST['occup3'];
// Update the user profile picture in the database
              $userID = $_SESSION['user_id']; // Ensure user_id is stored in session
              if ($con->updateOccupation($userID, $occupation1, $occupation2, $occupation3)) {
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
                <a class="nav-link active" aria-current="page" href="index.html#home">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.html#portfolio">Portfolio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.html#about">About Me</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.html#contact">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link split" href="./tables.html"><i class="fa-solid fa-gear"></i></a>
              </li>
            </ul>

          </div>
        </div>
      </nav>

    <div class="card1">

    <form action="editHome.php" method="post" enctype="multipart/form-data">
        <div class="form-row">
          <h1 class="display-1"> Edit Occupation Page</h1>
          <div class="form-group">
            <label for="occup1">Your Occupation 1:</label>
            <input type="text" class="form-control" id="occup1" name="occup1" value="<?php echo $data['occupation_name1']?>">
          </div>

          <div class="form-group">
            <label for="occup2">Your Occupation 2:</label>
            <input type="occup2" class="form-control" id="occup2" name="occup2" value="<?php echo $data['occupation_name2']?>">
          </div>

          <div class="form-group">
            <label for="occup3">Your Occupation 3:</label>
            <input type="occup3" class="form-control" id="occup3" name="occup3" value="<?php echo $data['occupation_name3']?>">
          </div>
          <button type="submit" class="btn btn-primary" name="updateOccu">Update Page</button>
        </div>
        
      </form>
    </div>

    <script src="bootstrap-4.5.3-dist/js/bootstrap.js"></script>
<script src="bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<script src="./typed.js-2.1.0/dist/typed.umd.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
<script src="./aos-master/dist/aos.js"></script>
<script src="app.js"></script>
</body>
</html>