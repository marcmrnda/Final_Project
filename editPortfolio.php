<?php 
require_once('classes/database.php');
$con = new database();
session_start();


if (isset($_POST['id1'])) {
  $id = $_POST['id1'];
  $data = $con->viewPort($id);
  
  }
  else {  
   header('location:index.php');
  }



// Redirect to login if the user is not logged in or doesn't have the correct account type
if (empty($_SESSION['username']) || $_SESSION['account_type'] != 1) {
    header('location:login.php');
    exit();
}

// Handle form submission
if (isset($_POST['updateProject'])) {
    $project_name = $_POST['projectName'];
    $project_description = $_POST['projectDescription'];
    $projectLink = $_POST['projectLink'];
    $projects_id = $_POST['id1']; // This should be the unique ID of the project

    // Update the user profile project details in the database
      $userID = $_SESSION['user_id'];
    if ($con->updateProjects($projects_id, $project_name, $project_description, $projectLink)) {
        header('location:index.php');
        exit(); // Make sure to exit after header redirection
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

     <form action="editPortfolio.php" method="post" enctype="multipart/form-data">
      <?php foreach($data as $row) {?>
  <div class="form-row">
    <h1 class="display-1"> Edit Portfolio Page</h1>
    <div class="form-group">
      <label for="projectName">Project Name:</label>
      <input type="text" class="form-control" id="projectName" name="projectName" value="<?php echo $row['project_name'];?>">
    </div>
    <div class="form-group">
      <label for="projectDescription">Project Description:</label>
      <input type="text" class="form-control" id="projectDescription" name="projectDescription" value="<?php echo $row['project_desc'];?>">
    </div>
    <div class="form-group">
      <label for="projectLink">Project Link:</label>
      <input type="text" class="form-control" id="projectLink" name="projectLink" value="<?php echo $row['project_link'];?>">
    </div>
    '<input type="hidden" name="id1" value="<?php echo htmlspecialchars($row['projects_id'])?>">;
      <?php } ?>
              <button type="submit" class="btn btn-primary" name="updateProject">Update Page</button>

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