
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

  if (isset($_POST['updateEDU'])) {
    $preschoolName = $_POST['pre_school'];
    $preschoolYear = $_POST['pre_schoolYear'];
    $pre_schoolDesc = $_POST['pre_schoolDesc'];
    $gradeschoolName = $_POST['grade_school'];
    $gradeschoolYear = $_POST['grade_schoolYear'];
    $grade_schoolDesc = $_POST['grade_schoolDesc'];
    $JhighschoolName =  $_POST['jhigh_school'];
    $JhighschoolYear = $_POST['jhigh_schoolYear'];
    $Jhigh_schoolDesc = $_POST['jhigh_schoolDesc'];
    $ShighschoolName = $_POST['shigh_school'];
    $ShighschoolYear = $_POST['shigh_schoolYear'];
    $Shigh_schoolDesc = $_POST['shigh_schoolDesc'];
    $universityName = $_POST['college_school'];
    $collegeYear = $_POST['college_schoolYear'];
    $collegeDesc = $_POST['college_schoolDesc'];
              // Update the user profile picture in the database
    $userID = $_SESSION['user_id']; // Ensure user_id is stored in session
    if($con->updateEducation($userID, $preschoolName, $preschoolYear, $pre_schoolDesc, $gradeschoolName,  $gradeschoolYear, $grade_schoolDesc, $JhighschoolName, $JhighschoolYear, $Jhigh_schoolDesc, $ShighschoolName, $ShighschoolYear, $Shigh_schoolDesc, $universityName, $collegeYear , $collegeDesc)) {
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
      
      
    <form action="editEducation.php" method="post" enctype="multipart/form-data">

        <div class="tab">
            <div class="card1">
                <div class="form-row">
                    <h1 class="display-1"> Edit Education Page</h1>
                    <div class="form-group">
                                    <label for="pre_school">Pre-School Name:</label>
                                    <input type="text" class="form-control" id="pre_school" name="pre_school" value="<?php echo $data['preschool_name']?>">
                                </div>
                
                                <div class="form-group">
                                    <label for="pre_schoolYear">Pre-School Year:</label>
                                    <input type="text" class="form-control" id="pre_schoolYear" name="pre_schoolYear" value="<?php echo $data['preschool_year']?>">
                                </div>

                                <div class="form-group">
                                    <label for="pre_schoolDesc">Pre-School Description:</label>
                                    <input type="text" class="form-control" id="pre_schoolDesc" name="pre_schoolDesc" value="<?php echo $data['preschool_desc']?>">
                                </div>
    
                    <button type="button" class="nextBtn" onclick="nextPrev(1)">Next</button>
    
                </div>
            </div>
        </div>
    
        <div class="tab">
            <div class="card1">
                <div class="form-row">
                    <h1 class="display-1"> Edit Education Page</h1>
                                <div class="form-group">
                                    <label for="grade_school">Grade School Name:</label>
                                    <input type="text" class="form-control" id="grade_school" name="grade_school" value="<?php echo $data['gradeSchool_name']?>">
                                </div>
                
                                <div class="form-group">
                                    <label for="grade_schoolYear">Grade School Year:</label>
                                    <input type="text" class="form-control" id="grade_schoolYear" name="grade_schoolYear" value="<?php echo $data['gradeSchool_year']?>">
                               
                                </div>

                                <div class="form-group">
                                    <label for="grade_schoolDesc">Grade School Description:</label>
                                    <input type="text" class="form-control" id="grade_schoolDesc" name="grade_schoolDesc" value="<?php echo $data['gradeSchool_desc']?>">
                                </div>
    
                    <button type="button" class="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button type="button" class="nextBtn" onclick="nextPrev(1)">Next</button>
    
                </div>
            </div>
        </div>

        <div class="tab">
            <div class="card1">
                <div class="form-row">
                    <h1 class="display-1"> Edit Education Page</h1>
                                <div class="form-group">
                                    <label for="jhigh_school">Junior High School Name:</label>
                                    <input type="text" class="form-control" id="jhigh_school" name="jhigh_school" value="<?php echo $data['Jhighschool_name']?>">
                                </div>
                
                                <div class="form-group">
                                    <label for="jhigh_schoolYear">Junior High School Year:</label>
                                    <input type="text" class="form-control" id="jhigh_schoolYear" name="jhigh_schoolYear" value="<?php echo $data['Jhighschool_year']?>">
                        
                                </div>

                                <div class="form-group">
                                    <label for="jhigh_schoolDesc">Junior High School Description:</label>
                                    <input type="text" class="form-control" id="jhigh_schoolDesc" name="jhigh_schoolDesc" value="<?php echo $data['Jhighschool_desc']?>">
                                </div>
    
                    <button type="button" class="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button type="button" class="nextBtn" onclick="nextPrev(1)">Next</button>
    
                </div>
            </div>
        </div>

        <div class="tab">
            <div class="card1">
                <div class="form-row">
                    <h1 class="display-1"> Edit Education Page</h1>
                    <div class="form-group">
                                    <label for="shigh_school">Senior High School Name:</label>
                                    <input type="text" class="form-control" id="shigh_school" name="shigh_school" value="<?php echo $data['Shighschool_name']?>">
                     
                                </div>
                
                                <div class="form-group">
                                    <label for="shigh_schoolYear">Senior High School Year:</label>
                                    <input type="text" class="form-control" id="shigh_schoolYear" name="shigh_schoolYear" value="<?php echo $data['Shighschool_year']?>">
                                   
                                </div>

                                <div class="form-group">
                                    <label for="shigh_schoolDesc">Senior High School Description:</label>
                                    <input type="text" class="form-control" id="shigh_schoolDesc" name="shigh_schoolDesc" value="<?php echo $data['Shighschool_desc']?>">
                                 
                                </div>
    
                    <button type="button" class="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button type="button" class="nextBtn" onclick="nextPrev(1)">Next</button>
    
                </div>
            </div>
        </div>
    
        <div class="tab">
            <div class="card1">
                <div class="form-row">
                    <h1 class="display-1"> Edit Education Page</h1>
                    <div class="form-group">
                                    <label for="college_school">University Name:</label>
                                    <input type="text" class="form-control" id="college_school" name="college_school" value="<?php echo $data['University_name']?>">
                                </div>
                
                                <div class="form-group">
                                    <label for="college_schoolYear">University Year:</label>
                                    <input type="text" class="form-control" id="college_schoolYear" name="college_schoolYear" value="<?php echo $data['College_year']?>">
                                </div>

                                <div class="form-group">
                                    <label for="college_schoolDesc">University Description:</label>
                                    <input type="text" class="form-control" id="college_schoolDesc" name="college_schoolDesc" value="<?php echo $data['University_desc']?>">
                                </div>
                    <button type="button" class="prevBtn" onclick="nextPrev(-1)">Previous</button>
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