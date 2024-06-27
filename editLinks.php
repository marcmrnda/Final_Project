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


  if (isset($_POST['updateLinks'])) {
    $facebookLink = $_POST['fbLink'];
    $XLink = $_POST['xLink'];
    $instagramLink = $_POST['IGLink'];
    $githubLink = $_POST['gitLink'];
// Update the user profile picture in the database
              $userID = $_SESSION['user_id']; // Ensure user_id is stored in session
              if ($con->updateLinks($userID,$facebookLink,$XLink,$instagramLink,$githubLink)) {
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

    <form action="editLinks.php" method="post" enctype="multipart/form-data"><form action="POST">
    <div class="form-row">
    <h1 class="display-1"> Edit Links Page</h1>
                                 <div class="form-group">
                                    <label for="fbLink">Facebook Link:</label>
                                    <input type="url" class="form-control" id="fbLink" name="fbLink" value="<?php echo $data['facebook_link']  ?>">
                                  </div>

                                  <div class="form-group">
                                    <label for="xLink">X Link:</label>
                                    <input type="url" class="form-control" id="xLink" name="xLink" value="<?php echo $data['X_link']  ?>">
                                  </div>

                                  <div class="form-group">
                                    <label for="IGLink">Instagram Link:</label>
                                    <input type="url" class="form-control" id="IGLink" name="IGLink" value="<?php echo $data['instagram_link']  ?>">
                                  </div>

                                  <div class="form-group">
                                    <label for="gitLink">GitHub Link:</label>
                                    <input type="url" class="form-control" id="gitLink" name="gitLink" value="<?php echo $data['github_link']  ?>"> 
                                  </div>
          <button type="submit" class="btn btn-primary" name="updateLinks">Update Page</button>
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