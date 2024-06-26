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


if (isset($_POST['addProject'])) {
  // Debugging: Check if POST and FILES arrays are populated
  echo '<pre>';
  print_r($_POST);
  print_r($_FILES);
  echo '</pre>';

  // Fetch project details from POST array
  $project_name = isset($_POST['projectName']) ? $_POST['projectName'] : '';
  $project_desc = isset($_POST['projectDescription']) ? $_POST['projectDescription'] : '';
  $projectLink = isset($_POST['projectLink']) ? $_POST['projectLink'] : '';

  $target_dir = 'uploads/'; // specify the upload directory

  // Check if file was uploaded
  if (isset($_FILES["projectPic"]) && $_FILES["projectPic"]["error"] == 0) {
      $original_file_name1 = basename($_FILES["projectPic"]["name"]);
      $new_file_name1 = $original_file_name1;
      $target_file1 = $target_dir . $new_file_name1;
      $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));

      $uploadOk1 = 1;

      // Check if file already exists and rename if necessary
      if (file_exists($target_file1)) {
          $new_file_name1 = pathinfo($original_file_name1, PATHINFO_FILENAME) . '_' . time() . '.' . $imageFileType1;
          $target_file1 = $target_dir . $new_file_name1;
      }

      // Check if file is an actual image or fake image
      $check1 = getimagesize($_FILES["projectPic"]["tmp_name"]);
      if ($check1 === false) {
          echo "File is not an image.";
          $uploadOk1 = 0;
      }

      // Check file size
      if ($_FILES["projectPic"]["size"] > 500000000) {
          echo "Sorry, your project picture file is too large.";
          $uploadOk1 = 0;
      }

      // Allow certain file formats
      $allowedFormats = ["jpg", "jpeg", "png", "gif"];
      if (!in_array($imageFileType1, $allowedFormats)) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed for the project picture.";
          $uploadOk1 = 0;
      }

      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk1 == 0) {
          echo "Sorry, your files were not uploaded.";
      } else {
          // Move the file to the target directory
          if (move_uploaded_file($_FILES["projectPic"]["tmp_name"], $target_file1)) {
              echo "The file " . htmlspecialchars($new_file_name1) . " has been uploaded.";
              $profile_picture_path1 = $target_file1; // Set the full path to be stored in the database

              // Save the user data and the path to the pictures in the database
              if ($con->insertProjects($id, $project_name, $project_desc, $projectLink, $profile_picture_path1)) {
                  header('location:index.php?status=success4');
                  exit();
              } else {
                  header('location:index.php?status=error');
                  exit();
              }
          } else {
              echo "Sorry, there was an error uploading your project picture.";
          }
      }
  } else {
      header('location:index.php?status=no_file');
      exit();
  }
}


if (isset($_POST['deleteProject'])) {
  $ids = $_POST['id1'];
  if ($con->deleteProject($ids)) {
      header('location:index.php?status=success');
  }else{
     header('location:index.php?status=error');
  }
}

if (isset($_POST['deleteSkill'])) {
  $ids = $_POST['id2'];
  if ($con->deleteSkills($ids)) {
      header('location:index.php?status=success');
  }else{
     header('location:index.php?status=error');
  }
}





if (isset($_POST['addSkill'])) {

$skillsName =  $_POST['skillName'];
$skillsPercentage =  $_POST['skillPercentage'];
if($con->insertSkills($id,$skillsName,$skillsPercentage)){
  header('location:index.php?status=success5');
} 
else {
  header('location:index.php?status=error');
}
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="./aos-master/dist/aos.css">
    
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

        <button class="tablink" onclick="openPage('Home', this, 'red')">Home</button>
        <button class="tablink" onclick="openPage('Portfolio', this, 'green')" id="defaultOpen">Portfolio</button>
        <button class="tablink" onclick="openPage('Education', this, 'blue')">Education</button>
        <button class="tablink" onclick="openPage('Skills', this, 'orange')">Skills</button>
        <button class="tablink" onclick="openPage('Links', this, 'purple')">Links</button>
        <button class="tablink" onclick="openPage('Occupation', this, 'gold')">Occupation</button>
        <button class="tablink" onclick="openPage('Add Skills', this, 'pink')">Add Skills</button>
        <button class="tablink" onclick="openPage('Add Projects', this, 'violet')">Add Project</button>
        <div id="Home" class="tabcontent">
            <table class="table table-bordered">
                <thead>
                <tr>
                <th>Profile-Pic:</th>
                <th>Name:</th>
                <th>Description:</th>
                <th>Edit Home</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td>
                  <img src="<?php echo $data['user_pic'] ?>" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%;">
              </td>
              <td><?php echo $data['user_fullName'] ?></td>
              <td><?php echo $data['user_desc'] ?></td>
              <td>
                <!-- Update Button -->
                <form action="editHome.php" class="d-inline w-100 p-3">
                <input type="hidden" name="id" value="<?php echo $row['user_id']?>">
                  <button type="submit"  name="edit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to update this user? You will be redirected to another page.')"> <i class="fas fa-edit"></i> </button>
                  </form>
                </td>
            </tr>
            </tbody>
          </table>
    </div>
    
    <div id="Portfolio" class="tabcontent">

        <table class="table table-bordered">
            <thead>
            <tr>
            <th>Picture:</th>
            <th>Name:</th>
            <th>Description:</th>
            <th>Link:</th>
            <th>Edit & Delete</th>
            </tr>
            </thead>
            <tbody>

            <?php $con->getProject($id)?>

        </tbody>
      </table>
      
    </div>
    
    <div id="Education" class="tabcontent">

        <table class="table table-bordered">
            <thead>
            <tr>
            <th>Pre-School Name:</th>
            <th>Pre-School Year:</th>
            <th>Pre-School Description</th>
            <th>Grade School Name:</th>
            <th>Grade School Year:</th>
            <th>Grade School Description</th>
            <th>Junior High School Name:</th>
            <th>Junior High School Year:</th>
            <th>Junior High School Description</th>
            <th>Senior High School Name:</th>
            <th>Senior High School Year:</th>
            <th>Senior High School Description</th>
            <th>University Name:</th>
            <th>College Year:</th>
            <th>University Description</th>
            <th>Edit</th>
            </tr>
            </thead>
            <tbody>
            <tr>
        <!-- The values we must echoo!! -->
          <td><?php echo $data['preschool_name'] ?></td>
          <td><?php echo $data['preschool_year'] ?></td>
          <td><?php echo $data['preschool_desc'] ?></td>
          <td><?php echo $data['gradeSchool_name'] ?></td>
          <td><?php echo $data['gradeSchool_year'] ?></td>
          <td><?php echo $data['gradeSchool_desc'] ?></td>
          <td><?php echo $data['Jhighschool_name'] ?></td>
          <td><?php echo $data['Jhighschool_year'] ?></td>
          <td><?php echo $data['Jhighschool_desc'] ?></td>
          <td><?php echo $data['Shighschool_name'] ?></td>
          <td><?php echo $data['Shighschool_year'] ?></td>
          <td><?php echo $data['Shighschool_desc'] ?></td>
          <td><?php echo $data['University_name'] ?></td>
          <td><?php echo $data['College_year'] ?></td>
          <td><?php echo $data['University_desc'] ?></td>

         <td><!-- Update Button -->
            <form action="editEducation.php" method="post" class="d-inline">
            <input type="hidden" name="id" value="<?php echo $row['user_id']?>">
              <button type="submit"  name="edit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to update this user? You will be redirected to another page.')"> <i class="fas fa-edit"></i> </button>
          </form>
        </td>
        </tr>
        </tbody>
      </table>
     
    </div>
    
    <div id="Skills" class="tabcontent">

        <table class="table table-bordered">
            <thead>
            <tr>
            <th>Skill Name:</th>
            <th>Percentage of your Knowledge:</th>
            <th>Edit & Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php $con->getSkills($id)?>
          
        </tbody>
      </table>
    
    </div>

    <div id="Links" class="tabcontent">

        <table class="table table-bordered">
            <thead>
            <tr>
            <th>Facebook Link:</th>
            <th>X Link:</th>
            <th>Instagram Link:</th>
            <th>Github Link:</th>
            <th>Edit</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td><?php echo $data['facebook_link'] ?></td>
              <td><?php echo $data['X_link'] ?></td>
              <td><?php echo $data['instagram_link'] ?></td>
              <td><?php echo $data['github_link'] ?></td>
              <td><!-- Update Button -->
                <form action="editLinks.php" method="post" class="d-inline">
                <input type="hidden" name="id" value="<?php echo $row['user_id']?>">
                  <button type="submit"  name="edit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to update this user? You will be redirected to another page.')"> <i class="fas fa-edit"></i> </button>
              </form>
            </td>
            </tr>
          
        </tbody>
      </table>
    
    </div>

    <div id="Occupation" class="tabcontent">

<table class="table table-bordered">
    <thead>
    <tr>
    <th>Occupation 1:</th>
    <th>Occupation 2:</th>
    <th>Occupation 3:</th>
    <th>Edit</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td><?php echo $data['occupation_name1'] ?></td>
      <td><?php echo $data['occupation_name2'] ?></td>
      <td><?php echo $data['occupation_name3'] ?></td>
      <td><!-- Update Button -->
        <form action="editLinks.php" method="post" class="d-inline">
        <input type="hidden" name="id" value="<?php echo $row['user_id']?>">
          <button type="submit"  name="edit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to update this user? You will be redirected to another page.')"> <i class="fas fa-edit"></i> </button>
      </form>
    </td>
    </tr>
  
</tbody>
</table>

</div>



    <div id="Add Skills" class="tabcontent">
    <form action="tables.php" method="post" enctype="multipart/form-data">
        <div class="form-row">
          <div class="form-group">
            <label for="skillName">Skill Name:</label>
            <input type="text" class="form-control" id="skillName" name="skillName">
          </div>
          <div class="form-group">
            <label for="skillPercentage">Skill Percentage:</label>
            <input type="text" class="form-control" id="skillPercentage" name="skillPercentage">
          </div>
          <button type="submit" class="btn btn-primary" name="addSkill">Add Skills</button>
        </div>
      </form>
    </div>

    <div id="Add Projects" class="tabcontent">
    <form action="tables.php" method="post" enctype="multipart/form-data">
        <div class="form-row">
          <div class="form-group">
            <label for="projectName">Project Name:</label>
            <input type="text" class="form-control" id="projectName" name="projectName">
          </div>
          <div class="form-group">
            <label for="projectDescription">Project Description:</label>
            <input type="text" class="form-control" id="projectDescription" name="projectDescription">
          </div>
          <div class="form-group">
            <label for="projectLink">Project Link:</label>
            <input type="text" class="form-control" id="projectLink" name="projectLink">
          </div>
          <div class="form-group">
          <label for="projectPic">Project Picture:</label>
          <input type="file" class="form-control" name="projectPic" accept="application/pdf,image/*" required>
          </div>
          <button type="submit" class="btn btn-primary" name="addProject">Add Project</button>
        </div>
        
      </form>
    </div>
    
    </div>
</div>

</body>
<script src="bootstrap-4.5.3-dist/js/bootstrap.js"></script>
<script src="bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<script src="./typed.js-2.1.0/dist/typed.umd.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
<script src="./aos-master/dist/aos.js"></script>
<script src="app.js"></script>
<script src="package/dist/sweetalert2.js"></script>
<!-- Pop Up Messages after a succesful transaction starts here --> <script>
document.addEventListener('DOMContentLoaded', function() {
  const params = new URLSearchParams(window.location.search);
  const status = params.get('status');

  if (status) {
    let title, text, icon;
    switch (status) {
      case 'success':
        title = 'Success!';
        text = 'Record is successfully deleted.';
        icon = 'success';
        break;
      case 'success1':
        title = 'Success!'
        text = 'Record is successfully updated.';
        icon = 'success'
        break;
        case 'success2':
        title = 'Success!'
        text = 'You are successfully login.';
        icon = 'success'
        break;
        case 'success3':
        title = 'Success!'
        text = 'You are already login.';
        icon = 'success'
        break;
        case 'success4':
        title = 'Success!'
        text = 'You are successfully add.';
        icon = 'success'
        break;
      case 'error':
        title = 'Error!';
        text = 'Something went wrong.';
        icon = 'error';
        break;
      default:
        return;
    }
    Swal.fire({
      title: title,
      text: text,
      icon: icon
    }).then(() => {
      // Remove the status parameter from the URL
      const newUrl = window.location.origin + window.location.pathname;
      window.history.replaceState(null, null, newUrl);
    });
  }
});
</script>
</html>