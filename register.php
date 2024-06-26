<?php

require_once('classes/database.php');
$con = new database();
$error_message = "";
$error_message1 = "";
$uploadOk = 1;
if (isset($_POST['multisave'])) {

    //Account Details//
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    //Home Page Details//
    $fullName = $_POST['fullname'];
    $user_description = $_POST['userDescription'];

    //Projects Details//
    $projectName = $_POST['projectName'];
    $project_description = $_POST['projectDescription'];
    $projectLink = $_POST['projectLink'];
    
    //Education Details//
    $pre_school = $_POST['pre_school'];
    $pre_schoolYear = $_POST['pre_schoolYear'];
    $grade_school = $_POST['grade_school'];
    $grade_schoolYear = $_POST['grade_schoolYear'];
    $Jhigh_school =  $_POST['jhigh_school'];
    $Jhigh_schoolYear = $_POST['jhigh_schoolYear'];
    $Shigh_school = $_POST['shigh_school'];
    $Shigh_schoolYear = $_POST['shigh_schoolYear'];
    $college_school = $_POST['college_school'];
    $collegeYear = $_POST['college_schoolYear'];

    //Skills Details//
    $skillsName = $_POST['skillsName'];
    $skillsPercentage = $_POST['skillsPer'];

    //Links Details//
    $facebookLink = $_POST['fbLink'];
    $XLink = $_POST['xLink'];
    $instagramLink = $_POST['IGLink'];
    $githubLink = $_POST['gitLink'];

$target_dir = "uploads/";
$original_file_name = basename($_FILES["profilePic"]["name"]);
$original_file_name1 = basename($_FILES["projectPic"]["name"]);

// Initialize $new_file_name with $original_file_name
$new_file_name = $original_file_name; 
$new_file_name1 = $original_file_name1;

$target_file = $target_dir . $original_file_name;
$target_file1 = $target_dir . $original_file_name1;

$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
$uploadOk = 1;
$uploadOk1 = 1;

// Check if file already exists and rename if necessary
if (file_exists($target_file)) {
    $new_file_name = pathinfo($original_file_name, PATHINFO_FILENAME) . '_' . time() . '.' . $imageFileType;
    $target_file = $target_dir . $new_file_name;
} else {
    $target_file = $target_dir . $original_file_name;
}

if (file_exists($target_file1)) {
    $new_file_name1 = pathinfo($original_file_name1, PATHINFO_FILENAME) . '_' . time() . '.' . $imageFileType1;
    $target_file1 = $target_dir . $new_file_name1;
} else {
    $target_file1 = $target_dir . $original_file_name1;
}

// Check if file is an actual image or fake image
$check = getimagesize($_FILES["profilePic"]["tmp_name"]);
if ($check === false) {
    echo "File is not an image.";
    $uploadOk = 0;
}

$check1 = getimagesize($_FILES["projectPic"]["tmp_name"]);
if ($check1 === false) {
    echo "File is not an image.";
    $uploadOk1 = 0;
}

// Check file size
if ($_FILES["profilePic"]["size"] > 500000000) {
    echo "Sorry, your profile picture file is too large.";
    $uploadOk = 0;
}

if ($_FILES["projectPic"]["size"] > 500000000) {
    echo "Sorry, your project picture file is too large.";
    $uploadOk1 = 0;
}

// Allow certain file formats
$allowedFormats = ["jpg", "jpeg", "png", "gif"];
if (!in_array($imageFileType, $allowedFormats)) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed for the profile picture.";
    $uploadOk = 0;
}

if (!in_array($imageFileType1, $allowedFormats)) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed for the project picture.";
    $uploadOk1 = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0 || $uploadOk1 == 0) {
    echo "Sorry, your files were not uploaded.";
} else {
    // Try to upload profile picture
    if (move_uploaded_file($_FILES["profilePic"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars($new_file_name) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your profile picture.";
    }

    // Try to upload project picture
    if (move_uploaded_file($_FILES["projectPic"]["tmp_name"], $target_file1)) {
        echo "The file " . htmlspecialchars($new_file_name1) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your project picture.";
    }

    // Save the user data and the path to the pictures in the database
    $profile_picture_path = 'uploads/' . $new_file_name;
    $project_picture_path = 'uploads/' . $new_file_name1;

    // Database code here to save the paths
    // Assuming $con is your database connection object and methods are defined appropriately
    $user_id = $con->signupUser($email, $username, $password);
    if ($user_id) {
        if ($user_id) {
            $project_inserted = $con->insertProjects($user_id, $projectName, $project_description, $projectLink, $project_picture_path);
            $home_inserted = $con->insertHome($user_id, $fullName, $user_description, $profile_picture_path);
            $education_inserted = $con->insertEducation($user_id, $pre_school, $pre_schoolYear, $grade_school, $grade_schoolYear, $Jhigh_school, $Jhigh_schoolYear, $Shigh_school, $Shigh_schoolYear, $college_school, $collegeYear);
            $skills_inserted = $con->insertSkills($user_id, $skillsName, $skillsPercentage);
            $link_inserted = $con->insertLink($user_id, $facebookLink, $XLink, $instagramLink, $githubLink);
        
            if ($home_inserted && $project_inserted && $education_inserted && $skills_inserted && $link_inserted) {
                header("Location:login.php");
                exit;
            } else {
                // Address insertion failed, display error message
                $error = "Error occurred while signing up. Please try again.";
            }
        }
        }
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
    <style>
        .form-step {
      display: none;
    }
    .active {
      display: block;
    }
    </style>
</head>
<body>

    <div class="container1 custom-container">
        <h3 class="text-center mt-4">Registration Form</h3>
        <form id="registration-form" method="post" action="" enctype="multipart/form-data" novalidate>
            <div class="form-step active" id="step-1">
                <div class="cards">
                    <div class="card-header text-white">Account Information</div>
                        <div class="card-body">
                            <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please enter a valid username.</div>
                                <div id="usernameFeedback" class="invalid-feedback"></div> <!-- New feedback div -->
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter a valid email.</div>
                            <div id="emailFeedback" class="invalid-feedback"></div> <!-- New feedback div -->
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter password" required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one special character.</div>
                        </div>
                
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password:</label>
                            <input type="password" class="form-control" name="confirmPassword" placeholder="Re-enter your password" required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please confirm your password.</div>
                        </div>

                          <button type="button" class="btn btn-primary mt-3" onclick="nextSteps()">Next</button>

                    </div>
                </div>
            </div>

                <div class="form-step" id="step-2">
                    <div class="cards">
                        <div class="card-header text-white">Home Page Information</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="full">Full Name:</label>
                                    <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Enter your full name" required>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter a valid full name.</div>
                                </div>

                                <div class="form-group">
                                    <label for="userDescription">Description About your Self:</label>
                                    <textarea class="form-control" name="userDescription" id="userDescription" placeholder="Describe yourself" rows="6" required></textarea>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter a valid Description About your Self.</div>
                                </div>

                                <div class="form-group">
                                    <label for="profilePic">Profile_Picture:</label>
                                    <input type="file" class="form-control" name="profilePic" accept="application/pdf,image/*" required>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please upload a profile picture.</div>
                                  </div>

                                  <button type="button" class="btn btn-secondary mt-3" onclick="prevSteps()">Previous</button>
                                  <button type="button" class="btn btn-primary mt-3" onclick="nextSteps()">Next</button>
                            </div>
                    </div>
                </div>

                <div class="form-step" id="step-3">
                    <div class="cards">
                        <div class="card-header text-white">Portfolio Page Information</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="projectName">Project Name:</label>
                                    <input type="text" class="form-control" id="projectName" name="projectName">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter a valid Project Name.</div>
                                  </div>
                                  <div class="form-group">
                                    <label for="projectDescription">Project Description:</label>
                                    <input type="text" class="form-control" id="projectDescription" name="projectDescription">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter a valid Project Description.</div>
                                  </div>
                                  <div class="form-group">
                                    <label for="projectLink">Project Link:</label>
                                    <input type="url" class="form-control" id="projectLink" name="projectLink">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter a valid Project Link.</div>
                                  </div>
                                  <div class="form-group">
                                    <label for="projectPic">Project Picture:</label>
                                    <input type="file" class="form-control" name="projectPic" accept="application/pdf,image/*" required>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please upload a profile picture.</div>
                                  </div>

                                  <button type="button" class="btn btn-secondary mt-3" onclick="prevSteps()">Previous</button>
                                  <button type="button" class="btn btn-primary mt-3" onclick="nextSteps()">Next</button>
                        </div>
                    </div>
                </div>


                <div class="form-step" id="step-4">
                    <div class="cards">
                        <div class="card-header text-white">Education Page Information</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="pre_school">Pre-School Name:</label>
                                    <input type="text" class="form-control" id="pre_school" name="pre_school">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter a valid Pre-School Name.</div>
                                </div>
                
                                <div class="form-group">
                                    <label for="pre_schoolYear">Pre-School Year:</label>
                                    <input type="text" class="form-control" id="pre_schoolYear" name="pre_schoolYear">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter a valid School Year.</div>
                                </div>
                
                                <div class="form-group">
                                    <label for="grade_school">Grade School Name:</label>
                                    <input type="text" class="form-control" id="grade_school" name="grade_school">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter a valid Grade School Name.</div>
                                </div>
                
                                <div class="form-group">
                                    <label for="grade_schoolYear">Grade School Year:</label>
                                    <input type="text" class="form-control" id="grade_schoolYear" name="grade_schoolYear">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter a valid School Year.</div>
                                </div>

                                  <button type="button" class="btn btn-secondary mt-3" onclick="prevSteps()">Previous</button>
                                  <button type="button" class="btn btn-primary mt-3" onclick="nextSteps()">Next</button>
                        </div>
                    </div>
                </div>

                <div class="form-step" id="step-5">
                    <div class="cards">
                        <div class="card-header text-white">Education Page Information</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="jhigh_school">Junior High School Name:</label>
                                    <input type="text" class="form-control" id="jhigh_school" name="jhigh_school">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter a valid Junior High School Name.</div>
                                </div>
                
                                <div class="form-group">
                                    <label for="jhigh_schoolYear">Junior High School Year:</label>
                                    <input type="text" class="form-control" id="jhigh_schoolYear" name="jhigh_schoolYear">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter a valid School Year.</div>
                                </div>
                
                                <div class="form-group">
                                    <label for="shigh_school">Senior High School Name:</label>
                                    <input type="text" class="form-control" id="shigh_school" name="shigh_school">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter a valid Senior High School Name.</div>
                                </div>
                
                                <div class="form-group">
                                    <label for="shigh_schoolYear">Senior High School Year:</label>
                                    <input type="text" class="form-control" id="shigh_schoolYear" name="shigh_schoolYear">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter a valid School Year.</div>
                                </div>


                                  <button type="button" class="btn btn-secondary mt-3" onclick="prevSteps()">Previous</button>
                                  <button type="button" class="btn btn-primary mt-3" onclick="nextSteps()">Next</button>
                        </div>
                    </div>
                </div>

                <div class="form-step" id="step-6">
                    <div class="cards">
                        <div class="card-header text-white">Education Page Information</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="college_school">University Name:</label>
                                    <input type="text" class="form-control" id="college_school" name="college_school">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter a valid University Name.</div>
                                </div>
                
                                <div class="form-group">
                                    <label for="college_schoolYear">University Year:</label>
                                    <input type="text" class="form-control" id="college_schoolYear" name="college_schoolYear">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter a valid School Year.</div>
                                </div>

                                  <button type="button" class="btn btn-secondary mt-3" onclick="prevSteps()">Previous</button>
                                  <button type="button" class="btn btn-primary mt-3" onclick="nextSteps()">Next</button>
                            </div>
                    </div>
                </div>

                <div class="form-step" id="step-7">
                    <div class="cards">
                        <div class="card-header text-white">Skills Page Information</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="skillsName">Skills Name:</label>
                                    <input type="text" class="form-control" id="skillsName" name="skillsName">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter a valid Skills Name.</div>
                                  </div>
                                  <div class="form-group">
                                    <label for="userDescription">Skills Percentage:</label>
                                    <input type="text" class="form-control" id="skillsPer" name="skillsPer">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter a valid Skill Percentage.</div>
                                  </div>

                                  <button type="button" class="btn btn-secondary mt-3" onclick="prevSteps()">Previous</button>
                                  <button type="button" class="btn btn-primary mt-3" onclick="nextSteps()">Next</button>
                        </div>
                    </div>
                </div>

                <div class="form-step" id="step-8">
                    <div class="cards">
                        <div class="card-header text-white">Links Information</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="fbLink">Facebook Link:</label>
                                    <input type="url" class="form-control" id="fbLink" name="fbLink">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter a valid Facebook Link.</div>
                                  </div>

                                  <div class="form-group">
                                    <label for="xLink">X Link:</label>
                                    <input type="url" class="form-control" id="xLink" name="xLink">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter a valid X Link.</div>
                                  </div>

                                  <div class="form-group">
                                    <label for="IGLink">Instagram Link:</label>
                                    <input type="url" class="form-control" id="IGLink" name="IGLink">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter a valid Instagram Link.</div>
                                  </div>

                                  <div class="form-group">
                                    <label for="gitLink">GitHub Link:</label>
                                    <input type="url" class="form-control" id="gitLink" name="gitLink">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter a valid Github Link.</div>
                                  </div>

                                
                                  <button type="button" class="btn btn-secondary mt-3" onclick="prevSteps()">Previous</button>
                                  <button type="submit" name="multisave" class="btn btn-primary mt-3">Sign Up</button>
                            </div>
                    </div>
                </div>
        </form>

    </div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <!-- Bootstrap Bundle with Popper -->
  <script src="bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<script src="bootstrap-4.5.3-dist/js/bootstrap.js"></script>

<script>
$(document).ready(function(){
    $('#username').on('input', function(){
        var username = $(this).val();
        if(username.length > 0) {
            $.ajax({
                url: 'check_username.php',
                method: 'POST',
                data: {username: username},
                dataType: 'json',
                success: function(response) {
                    if(response.exists) {
                        $('#username').removeClass('is-valid').addClass('is-invalid');
                        $('#usernameFeedback').text('Username is already taken.');
                        $('#nextButton').prop('disabled', true); // Disable the Next button
                    } else {
                        $('#username').removeClass('is-invalid').addClass('is-valid');
                        $('#usernameFeedback').text('');
                        $('#nextButton').prop('disabled', false); // Enable the Next button
                    }
                }
            });
        } else {
            $('#username').removeClass('is-valid is-invalid');
            $('#usernameFeedback').text('');
            $('#nextButton').prop('disabled', false); // Enable the Next button if username is empty
        }
    });
});

</script>
<!-- AJAX for live checking of existing emails -->
<script>
$(document).ready(function(){
    $('#email').on('input', function(){
        var email = $(this).val();
        if(email.length > 0) {
            $.ajax({
                url: 'check_email.php',
                method: 'POST',
                data: {email: email},
                dataType: 'json',
                success: function(response) {
                    if(response.exists) {
                        $('#email').removeClass('is-valid').addClass('is-invalid');
                        $('#emailFeedback').text('Email is already taken.');
                        $('#nextButton').prop('disabled', true); // Disable the Next button
                    } else {
                        $('#email').removeClass('is-invalid').addClass('is-valid');
                        $('#emailFeedback').text('');
                        $('#nextButton').prop('disabled', false); // Enable the Next button
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        } else {
            $('#email').removeClass('is-valid is-invalid');
            $('#emailFeedback').text('');
            $('#nextButton').prop('disabled', false); // Enable the Next button if email is empty
        }
    });
});
</script>

<!-- Script for Form Validation -->
<script>
    
    document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form");
  const steps = document.querySelectorAll(".form-step");
  let currentStep = 0;

  // Add event listeners for real-time validation
  const inputs = form.querySelectorAll("input");
  inputs.forEach(input => {
    input.addEventListener("input", () => validateInput(input));
  });

  // MultiStep Logic 
  // Add an event listener to the form's submit event
  form.addEventListener("submit", (event) => {
    // Prevent form submission if the current step is not valid
    if (!validateStep(currentStep)) {
      event.preventDefault();
      event.stopPropagation();
    }

    // Add the 'was-validated' class to the form for Bootstrap styling
    form.classList.add("was-validated");
  }, false);

  // Function to move to the next step
  window.nextSteps = () => {
    // Only proceed to the next step if the current step is valid
    if (validateStep(currentStep)) {
      steps[currentStep].classList.remove("active"); // Hide the current step
      currentStep++; // Increment the current step index
      if (currentStep < steps.length) {
        steps[currentStep].classList.add("active"); // Show the next step
      }
    }
  };

  // Function to move to the previous step
  window.prevSteps = () => {
    if (currentStep > 0) {
      steps[currentStep].classList.remove("active"); // Hide the current step
      currentStep--; // Decrement the current step index
      steps[currentStep].classList.add("active"); // Show the previous step
    }
  };

  // Function to validate all inputs in the current step
  function validateStep(step) {
    let valid = true;
    // Select all input and select elements in the current step
    const stepInputs = steps[step].querySelectorAll("input");

    // Validate each input element
    stepInputs.forEach(input => {
      if (!validateInput(input)) {
        valid = false; // If any input is invalid, set valid to false
      }
    });

    return valid; // Return the overall validity of the step
  }

  function validateInput(input) {
    if (input.name === 'password') {
      return validatePassword(input);
    } else if (input.name === 'confirmPassword') {
      return validateConfirmPassword(input);
    } else {
      if (input.checkValidity()) {
        input.classList.remove("is-invalid");
        input.classList.add("is-valid");
        return true;
      } else {
        input.classList.remove("is-valid");
        input.classList.add("is-invalid");
        return false;
      }
    }
  }

  function validatePassword(passwordInput) {
    const password = passwordInput.value;
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
    if (regex.test(password)) {
      passwordInput.classList.remove("is-invalid");
      passwordInput.classList.add("is-valid");
      return true;
    } else {
      passwordInput.classList.remove("is-valid");
      passwordInput.classList.add("is-invalid");
      return false;
    }
  }

  function validateConfirmPassword(confirmPasswordInput) {
    const passwordInput = form.querySelector("input[name='password']");
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;

    if (password === confirmPassword && password !== '') {
      confirmPasswordInput.classList.remove("is-invalid");
      confirmPasswordInput.classList.add("is-valid");
      return true;
    } else {
      confirmPasswordInput.classList.remove("is-valid");
      confirmPasswordInput.classList.add("is-invalid");
      return false;
    }
  }

  document.addEventListener("keydown", (event) => {
    if (event.key === 'Enter') {
      event.preventDefault(); // Prevent form submission
    }
  });
});

</script>
</body>
</html>