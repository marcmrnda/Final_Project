<?php 
require_once('classes/database.php');
$con = new database();
session_start();

$id = $_SESSION['user_id'];
$data = $con->viewdata($id);

if(!isset($_SESSION['username'])|| $_SESSION['account_type'] != 1) {
  header('location:login.php');
  exit();
}

if(empty($_SESSION['username'])) {

  header('location:login.php');
  exit();

}

$response = array('success' => false, 'error' => '', 'filepath' => '');

if (isset($_POST['updateProjectPic'])) {
  $projectID = $_POST['ids'];
  if (isset($_FILES['projectPic']) && $_FILES['projectPic']['error'] == 0) {
    $target_dir = "uploads/";
    $original_file_name = basename($_FILES["projectPic"]["name"]);
    $new_file_name = $original_file_name;
    $target_file = $target_dir . $original_file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadOk = 1;

    // Check if file already exists and rename if necessary
    if (file_exists($target_file)) {
        $new_file_name = pathinfo($original_file_name, PATHINFO_FILENAME) . '_' . time() . '.' . $imageFileType;
        $target_file = $target_dir . $new_file_name;
    } else {
        $target_file = $target_dir . $original_file_name;
    }

    // Check file size
    if ($_FILES["projectPic"]["size"] > 5 * 1024 * 1024) {
        $response['error'] = "File size exceeds 5MB.";
        echo json_encode($response);
        exit;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $response['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        echo json_encode($response);
        exit;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $response['error'] = "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["projectPic"]["tmp_name"], $target_file)) {
            $profile_picture_path = 'uploads/' . $new_file_name;

            // Update the user profile picture in the database// Ensure user_id is stored in session
            if ($con->updateUserProjectPicture($id, $projectID, $profile_picture_path)) {
                header('Location:index.php');
            } else {
                $response['error'] = "Database update failed.";
            }
        } else {
            $response['error'] = "Sorry, there was an error uploading your file.";
        }
    }
} else {
    $response['error'] = "No file was uploaded.";
}

echo json_encode($response);
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

    <form action="editProjectPic.php" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group">
            <input type="hidden" name="project_id" value="<?php echo $projectID; ?>">
                <label for="projectPic">Project Picture:</label>
                <input type="file" class="form-control" name="projectPic" accept="application/pdf,image/*" required>
            </div>
            <input type="hidden" name="ids" value="<?php echo $data['projects_id']; ?>">
          <button type="submit" class="btn btn-primary" name="updateProjectPic">Update Page</button>
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