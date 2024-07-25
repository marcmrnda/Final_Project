
<?php 
require_once('classes/database.php');
$con = new database();
session_start();

if (isset($_POST['id3'])) {
    $id = $_POST['id3'];
    $data = $con->viewEducation($id);
    
    }
    else {  
     header('location:index.php');
    }
  
  if(empty($_SESSION['username'])) {
  
    header('location:login.php');
    exit();
  
  }



if(!isset($_SESSION['username'])|| $_SESSION['account_type'] != 1) {
    header('location:login.php');
    exit();
  }

  if(empty($_SESSION['username'])) {

    header('location:login.php');
    exit();
  
  }

  if (isset($_POST['updateEDU'])) {
    $school_level = $_POST['schoolLevel'];
    $school_name = $_POST['schoolName'];
    $school_year = $_POST['schoolYear'];
    $school_description = $_POST['schoolDesc'];
              // Update the user profile picture in the database
    $userID = $_SESSION['user_id']; // Ensure user_id is stored in session
    if($con->updateEducation($id,  $school_level, $school_name, $school_year, $school_description)) {
        header('location:index.php');
        exit;
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
      
      
    <form action="editEducation.php" method="post" enctype="multipart/form-data">

        <div class="tab">
            <div class="card1">
                <div class="form-row">
                    <h1 class="display-1"> Edit Education Page</h1>
                    <?php foreach ($data as $row) { ?>
                                <div class="form-group">
                                    <label for="schoolLevel">School Level:</label>
                                    <input type="text" class="form-control" id="schoolLevel" name="schoolLevel" value="<?php echo $row['school_level']?>">
                                </div>
                                
                                <div class="form-group">
                                    <label for="schoolName">School Name:</label>
                                    <input type="text" class="form-control" id="schoolName" name="schoolName" value="<?php echo $row['school_name']?>">
                                </div>
                
                                <div class="form-group">
                                    <label for="schoolYear">School Year:</label>
                                    <input type="text" class="form-control" id="schoolYear" name="schoolYear" value="<?php echo $row['school_year']?>">
                                </div>

                                <div class="form-group">
                                    <label for="schoolDesc">School Description:</label>
                                    <input type="text" class="form-control" id="schoolDesc" name="schoolDesc" value="<?php echo $row['school_desc']?>">
                                </div>

                                <input type="hidden" name="id3" value="<?php echo $row['education_id']; ?>">
                                <?php } ?>
                                <button type="submit" class="btn btn-primary" name="updateEDU">Update Page</button>
    
                </div>
            </div>
        </div>
    
    </form>
    
    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab
    
        function showTab(n) {
            // This function will display the specified tab of the form...
            var x = document.getElementsByClassName("tab");
            for (var i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            x[n].style.display = "block";
            //... and fix the Previous/Next buttons:
            if (n == 0) {
                document.querySelector(".prevBtn").style.display = "none";
            } else {
                document.querySelector(".prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.querySelector(".nextBtn").innerHTML = "Submit";
            } else {
                document.querySelector(".nextBtn").innerHTML = "Next";
            }
            //... and run a function that displays thecorrect step indicator:
            fixStepIndicator(n)
        }
    
        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // Exit the function if anyfield in the current tab is invalid:
            if (n == 1 &&!validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form... :
            if (currentTab >= x.length) {
                //...the form gets submitted:
                document.getElementById("regForm").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }
    
        function validateForm() {
            // This function deals with validation of the form fields
            // Validation code goes here
            return true; // If all fields are valid, return true
        }
    
    
    </script>
</body>
</html>