<?php

class database{
      
    function opencon() {
        return new PDO('mysql:host=localhost; dbname=myport', 'root', '');
      }
      
      function signupUser($email, $username, $password) {
        $con = $this->opencon();
        $con->prepare("INSERT INTO users (user_email, user_name, user_pass) 
        VALUES (?,?,?)")->execute([$email, $username, $password]);

        return $con->lastInsertId();

      }
      function signUp($firstname, $lastname, $birthday, $sex, $username, $password){
        $con = $this->opencon();
        //checking if the username is existing
        $query = $con->prepare("SELECT user_name FROM users WHERE user_name = ?");
        $query->execute([$username]);
        $existingUser = $query->fetch();
        if ($existingUser) {
          return false; 
        }
        
        else{
          return $con->prepare("INSERT INTO users(user_firstname, user_lastname, user_birthday, user_sex, user_name, user_pass) 
          VALUES(?,?,?,?,?,?)")->execute([$firstname, $lastname, $birthday, $sex, $username, $password]);
        }

      }

      function check($username, $password) {
        // Open database connection
        $con = $this->opencon();
    
        // Prepare the SQL query
        $query = $con->prepare("SELECT * FROM users WHERE user_name = ?");
        $query->execute([$username]);
    
        // Fetch the user data as an associative array
        $user = $query->fetch();
    
        // If a user is found, verify the password
        if ($user && password_verify($password, $user['user_pass'])) {
            return $user;
        }
    
        // If no user is found or password is incorrect, return false
        return false;
    }

function getProjectsByUserId($userId) {
  $dbhost = 'localhost';
  $dbuser = 'root';
  $dbpass = '';
  $dbname = 'myport';

  $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
  }

  $sql = "SELECT * FROM projects WHERE user_id =?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $userId);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      // Output the project details in HTML format
      echo '<div class="item" data-aos="fade-down" data-aos-duration="2000">';
      echo '<div class="img-wrapper">';
      echo '<img src="'. $row['project_pic']. '" alt="">';
      echo '</div>';
      echo '<div class="content-wrapper">';
      echo '<h1>'. $row['project_name']. '</h1>';
      echo '<p>'. $row['project_desc']. '</p>';
      echo '<a href="'. $row['project_link']. '" target="_blank">More Information</a>';
      echo '</div>';
      echo '</div>';
    }
  } else {
    echo "No projects found";
  }

  $conn->close();
}

function getSkillsByUserId($userId) {
  $dbhost = 'localhost';
  $dbuser = 'root';
  $dbpass = '';
  $dbname = 'myport';

  $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM skills WHERE user_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $userId);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          // Output the skill details in HTML format
          echo '<div class="skill">';
          echo '<div class="skill-name">' . htmlspecialchars($row['skills_name']) . '</div>';
          echo '<div class="skill-bar">';
          echo '<div class="skill-per prog1" per="' . htmlspecialchars($row['skills_percentage']) . '"></div>';
          echo '</div>';
          echo '</div>';
      }
  } else {
      echo "No skills found";
  }

  $conn->close();
}


function getSkills($userId) {
  $dbhost = 'localhost';
  $dbuser = 'root';
  $dbpass = '';
  $dbname = 'myport';

  $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM skills WHERE user_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $userId);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          // Output the skill details in HTML table row format
          echo '<tr>';
          echo '<td>' . htmlspecialchars($row['skills_name']) . '</td>';
          echo '<td>' . htmlspecialchars($row['skills_percentage']) . '%</td>';
          echo '<td>';
          echo '<!-- Update Button -->';
          echo '<form action="editSkills.php" method="post" class="d-inline">';
          echo '<button type="submit" name="edit" class="btn btn-primary btn-sm" onclick="return confirm(\'Are you sure you want to update this skill? You will be redirected to another page.\')"> <i class="fas fa-edit"></i> </button>';
          echo '</form>';
          echo '<!-- Delete button -->';
          echo '<form method="POST" style="display: inline;">';
          echo '<input type="hidden" name="id2" value="' . htmlspecialchars($row['skills_id']) . '">';
          echo '<button type="submit" name="deleteSkill" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this skill?\')"> <i class="fas fa-trash-alt"></i> </button>';
          echo '</form>';
          echo '</td>';
          echo '</tr>';
      }
  } else {
      echo '<tr><td colspan="3">No skills found</td></tr>';
  }

  $conn->close();
}



    function deleteProject($id) {
    try {
    $con = $this->opencon();
    $con->beginTransaction();

    // Delete user address
    $query = $con->prepare("DELETE FROM projects WHERE projects_id = ?");
    $query->execute([$id]);

    $con->commit();
    return true; // Deletion successful
} catch (PDOException $e) {
    $con->rollBack();
    return false;
}  

}



function deleteSkills($id) {
  try {
  $con = $this->opencon();
  $con->beginTransaction();

  // Delete user address
  $query = $con->prepare("DELETE FROM skills WHERE skills_id = ?");
  $query->execute([$id]);

  $con->commit();
  return true; // Deletion successful
} catch (PDOException $e) {
  $con->rollBack();
  return false;
}  

}

function viewPort($userId) {
  $con = $this->opencon();
  $stmt = $con->prepare("SELECT * FROM projects WHERE user_id = ?");
  $stmt->execute([$userId]);
  return $stmt->fetchAll();
}



function getProject($userId) {
  $dbhost = 'localhost';
  $dbuser = 'root';
  $dbpass = '';
  $dbname = 'myport';

  $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM projects WHERE user_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $userId);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          // Output the project details in HTML table row format
          echo '<tr>';
          echo '<td><img src="' . htmlspecialchars($row['project_pic']) . '" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%;"></td>';
          echo '<td>' . htmlspecialchars($row['project_name']) . '</td>';
          echo '<td>' . htmlspecialchars($row['project_desc']) . '</td>';
          echo '<td><a href="' . htmlspecialchars($row['project_link']) . '" target="_blank">LAYA</a></td>';
          echo '<td>';
          echo '<!-- Update Button -->';
          echo '<form action="editPortfolio.php" method="post" class="d-inline">';
          echo '<button type="submit" name="editasd" class="btn btn-primary btn-sm" onclick="return confirm(\'Are you sure you want to update this project? You will be redirected to another page.\')"> <i class="fas fa-edit"></i> </button>';
          echo '</form>';
          echo '<!-- Delete button -->';
          echo '<form method="POST" style="display: inline;">';
          echo '<input type="hidden" name="id1" value="' . htmlspecialchars($row['projects_id']) . '">';
          echo '<button type="submit" name="deleteProject" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this project?\')"> <i class="fas fa-trash-alt"></i> </button>';
          echo '</form>';
          echo '</td>';
          echo '<td>';
          echo '<!-- Update Button -->';
          echo '<form action="editProjectPic.php" method="post" class="d-inline">';
          echo '<button type="submit" name="editasds" class="btn btn-primary btn-sm" onclick="return confirm(\'Are you sure you want to update this project? You will be redirected to another page.\')"> <i class="fas fa-edit"></i> </button>';
          echo '</form>';
          echo '</td>';
          echo '</tr>';
          
      }
  } else {
      echo '<tr><td colspan="5">No projects found</td></tr>';
  }

  $conn->close();
}







      function insertHome($user_id, $fullName, $user_description, $profilepic) {

        try
    {
        $con = $this->opencon();
        $con->beginTransaction();
        $con->prepare("INSERT INTO home (user_id, user_fullName, user_desc, user_pic) VALUES (?,?,?,?)")->execute([$user_id, $fullName, $user_description, $profilepic]);
        $con->commit();
        return true;
    }
        catch (PDOException $e) {
            $con->rollBack();
            return false;
        }  
          
    }
        

    function insertProjects($user_id, $projectName, $project_description, $projectLink, $projectPic) {

      try
    {
        $con = $this->opencon();
        $con->beginTransaction();
        $con->prepare("INSERT INTO projects (user_id, project_name, project_desc, project_link, project_pic) 
        VALUES (?,?,?,?,?)")->execute([$user_id, $projectName, $project_description, $projectLink, $projectPic]);
        $con->commit();
        return true;
    }
        catch (PDOException $e) {
            $con->rollBack();
            return false;
        }  
          
    }

    function insertEducation($user_id, $preschoolName, $preschoolYear, $pre_schoolDesc, $gradeschoolName,  $gradeschoolYear, $grade_schoolDesc, $JhighschoolName, $JhighschoolYear, $Jhigh_schoolDesc, $ShighschoolName, $ShighschoolYear, $Shigh_schoolDesc, $universityName, $collegeYear , $collegeDesc) {
        
      try
    {
        $con = $this->opencon();
        $con->beginTransaction();
        $con->prepare("INSERT INTO education (user_id, preschool_name, preschool_year, preschool_desc, gradeSchool_name, gradeSchool_year, gradeSchool_desc, Jhighschool_name, Jhighschool_year, Jhighschool_desc, Shighschool_name, Shighschool_year, Shighschool_desc, University_name, College_year, University_desc) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")->execute([$user_id, $preschoolName, $preschoolYear, $pre_schoolDesc , $gradeschoolName, $gradeschoolYear, $grade_schoolDesc, $JhighschoolName, $JhighschoolYear, $Jhigh_schoolDesc, $ShighschoolName, $ShighschoolYear, $Shigh_schoolDesc, $universityName, $collegeYear, $collegeDesc]);
        $con->commit();
        return true;
    }
        catch (PDOException $e) {
            $con->rollBack();
            return false;
        }  
      }

    function insertSkills($user_id, $skillsName, $skillsPercentage) {

      try
      {
          $con = $this->opencon();
          $con->beginTransaction();
          $con->prepare("INSERT INTO skills (user_id, skills_name, skills_percentage) 
        VALUES (?,?,?)")->execute([$user_id, $skillsName, $skillsPercentage]);
          $con->commit();
          return true;
      }
          catch (PDOException $e) {
              $con->rollBack();
              return false;
          }    
    }

    function insertLink($user_id, $facebookLink, $XLink, $instagramLink, $githubLink) {

      try
      {
          $con = $this->opencon();
          $con->beginTransaction();
          $con->prepare("INSERT INTO links (user_id, facebook_link, X_link, instagram_link, github_link) 
        VALUES (?,?,?,?,?)")->execute([$user_id, $facebookLink, $XLink, $instagramLink, $githubLink]);
          $con->commit();
          return true;
      }
          catch (PDOException $e) {
              $con->rollBack();
              return false;
          }    
    }

    function insertOccupation($user_id, $occupation1, $occupation2, $occupation3) {
      
      try
      {
          $con = $this->opencon();
          $con->beginTransaction();
          $con->prepare("INSERT INTO occupation (user_id, occupation_name1, occupation_name2, occupation_name3) 
        VALUES (?,?,?,?)")->execute([$user_id, $occupation1, $occupation2, $occupation3]);
          $con->commit();
          return true;
      }
          catch (PDOException $e) {
              $con->rollBack();
              return false;
          }
    }




    function viewdata($id){
    
      try {
        $con = $this->opencon();
        $query = $con->prepare("SELECT
    users.user_id,
    home.user_fullName,
    home.user_desc,
    home.user_pic,
    projects.projects_id,
    projects.project_name,
    projects.project_desc,
    projects.project_link,
    projects.project_pic,
    education.preschool_name,
    education.preschool_year,
    education.preschool_desc,
    education.gradeSchool_name,
    education.gradeSchool_year,
    education.gradeSchool_desc,
    education.Jhighschool_name,
    education.Jhighschool_year,
    education.Jhighschool_desc,
    education.Shighschool_name,
    education.Shighschool_year,
    education.Shighschool_desc,
    education.University_name,
    education.College_year,
    education.University_desc,
    skills.skills_id,
    skills.skills_name,
    skills.skills_percentage,
    links.facebook_link,
    links.X_link,
    links.instagram_link,
    links.github_link,
    occupation.occupation_name1,
    occupation.occupation_name2,
    occupation.occupation_name3
FROM
    users
INNER JOIN home ON users.user_id = home.user_id 
INNER JOIN projects ON users.user_id = projects.user_id
INNER JOIN education ON users.user_id = education.user_id
INNER JOIN skills ON users.user_id = skills.user_id
INNER JOIN links ON users.user_id = links.user_id 
INNER JOIN occupation ON users.user_id = occupation.user_id WHERE users.user_id = ?");
        $query->execute([$id]); 
        return $query->fetch();
    } 
    
    catch (PDOException $e) {
      //Handle the exception(e.g., log error, return empty array, etc)
      return[];

    }

  }

  function updateUser($user_id, $firstname, $lastname, $birthday, $sex){
    try {
      $con = $this->opencon();
      $con ->beginTransaction();
      $query = $con->prepare("UPDATE users SET user_firstname = ?, user_lastname = ?, user_birthday= ?, user_sex = ? WHERE user_id = ?");
      $query->execute([$firstname, $lastname, $birthday, $sex, $user_id]);
      $con->commit();
      return true;
    } 
    
    catch (PDOException $e) {
      $con->rollBack();
      return false;
    }
  }

  function updateHome($user_id, $fullName, $user_description ){
    try {
      $con = $this->opencon();
      $con ->beginTransaction();
      $query = $con->prepare("UPDATE home SET user_fullName = ?, user_desc = ?, user_pic = ? WHERE user_id = ?");
      $query->execute([$fullName, $user_description, $user_id]);
      $con->commit();
      return true;
    } 
    
    catch (PDOException $e) {
      $con->rollBack();
      return false;
    }
  }

  function updateProjects($projects_id, $projectName, $project_description, $projectLink) {
    try {
        $con = $this->opencon();
        $con->beginTransaction();
        $query = $con->prepare("UPDATE projects SET project_name = ?, project_desc = ?, project_link = ? WHERE projects_id = ?");
        $query->execute([$projectName, $project_description, $projectLink, $projects_id]);
        $con->commit();
        return true;
    } catch (PDOException $e) {
        $con->rollBack();
        return false;
    }
}


  function updateEducation($user_id, $preschoolName, $preschoolYear, $pre_schoolDesc, $gradeschoolName,  $gradeschoolYear, $grade_schoolDesc, $JhighschoolName, $JhighschoolYear, $Jhigh_schoolDesc, $ShighschoolName, $ShighschoolYear, $Shigh_schoolDesc, $universityName, $collegeYear , $collegeDesc){
    try {
      $con = $this->opencon();
      $con ->beginTransaction();
      $query = $con->prepare("UPDATE education SET preschool_name = ?, preschool_year = ?, preschool_desc = ?, gradeSchool_name = ?, gradeSchool_year = ?, gradeSchool_desc = ?, Jhighschool_name  = ?, Jhighschool_year  = ?, Jhighschool_desc  = ?, Shighschool_name  = ?, Shighschool_year  = ?, Shighschool_desc  = ?, University_name  = ?, College_year  = ?, University_desc = ? WHERE user_id = ?");
      $query->execute([$preschoolName, $preschoolYear, $pre_schoolDesc, $gradeschoolName,  $gradeschoolYear, $grade_schoolDesc, $JhighschoolName, $JhighschoolYear, $Jhigh_schoolDesc, $ShighschoolName, $ShighschoolYear, $Shigh_schoolDesc, $universityName, $collegeYear , $collegeDesc, $user_id]);
      $con->commit();
      return true;
    } 
    
    catch (PDOException $e) {
      $con->rollBack();
      return false;
    }
  }

  function updateSkills($SkillsID, $skillsName, $skillsPercentage) {
    $con = $this->opencon();
    $query = $con->prepare("UPDATE skills SET skills_name = ?, skills_percentage = ? WHERE skills_id = ?");
    $query->execute([$skillsName, $skillsPercentage, $SkillsID]);
    return $query->rowCount() > 0;
}

  function updateLinks($user_id, $facebookLink, $XLink, $instagramLink, $githubLink){
    try {
      $con = $this->opencon();
      $con ->beginTransaction();
      $query = $con->prepare("UPDATE links SET facebook_link = ?, X_link = ?, instagram_link = ?, github_link = ? WHERE user_id = ?");
      $query->execute([$facebookLink, $XLink, $instagramLink, $githubLink, $user_id]);
      $con->commit();
      return true;
    } 
    
    catch (PDOException $e) {
      $con->rollBack();
      return false;
    }
  }

  function updateOccupation($user_id, $occupation1, $occupation2, $occupation3){
    try {
      $con = $this->opencon();
      $con ->beginTransaction();
      $query = $con->prepare("UPDATE occupation SET occupation_name1 = ?, occupation_name2 = ?, occupation_name3 = ? WHERE user_id = ?");
      $query->execute([$occupation1, $occupation2, $occupation3, $user_id]);
      $con->commit();
      return true;
    } 
    
    catch (PDOException $e) {
      $con->rollBack();
      return false;
    }
  }

  function updateUserAddress($user_id, $street, $barangay, $city, $province){
    try {
      $con = $this->opencon();
      $con ->beginTransaction();
      $query = $con->prepare("UPDATE user_address SET street = ?, barangay = ?, city=?, province =? WHERE user_id = ?");
      $query->execute([$street, $barangay, $city, $province, $user_id]);
      $con->commit();
      return true;
    } 
    
    catch (PDOException $e) {
      $con->rollBack();
      return false;
    }
  }

  function validateCurrentPassword($userId, $currentPassword) {
    // Open database connection
    $con = $this->opencon();

    // Prepare the SQL query
    $query = $con->prepare("SELECT user_pass FROM users WHERE user_id = ?");
    $query->execute([$userId]);

    // Fetch the user data as an associative array
    $user = $query->fetch(PDO::FETCH_ASSOC);

    // If a user is found, verify the password
    if ($user && password_verify($currentPassword, $user['user_pass'])) {
        return true;
    }

    // If no user is found or password is incorrect, return false
    return false;
}

function updatePassword($userId, $hashedPassword){
  try {
      $con = $this->opencon();
      $con->beginTransaction();
      $query = $con->prepare("UPDATE users SET user_pass = ? WHERE user_id = ?");
      $query->execute([$hashedPassword, $userId]);
      // Update successful
      $con->commit();
      return true;
  } catch (PDOException $e) {
      // Handle the exception (e.g., log error, return false, etc.)
       $con->rollBack();
      return false; // Update failed
  }
  }

  function updateUserProfilePicture($userID, $profilePicturePath) {
    try {
        $con = $this->opencon();
        $con->beginTransaction();
        $query = $con->prepare("UPDATE home SET user_pic = ? WHERE user_id = ?");
        $query->execute([$profilePicturePath, $userID]);
        // Update successful
        $con->commit();
        return true;
    } catch (PDOException $e) {
        // Handle the exception (e.g., log error, return false, etc.)
         $con->rollBack();
        return false; // Update failed
    }
     }

     function updateUserProjectPicture($userID, $projectID, $projectPicturePath) {
      try {
          $con = $this->opencon();
          $con->beginTransaction();
          $query = $con->prepare("UPDATE projects SET project_pic = ? WHERE user_id = ? AND projects_id = ?");
          $query->execute([$projectPicturePath, $userID, $projectID]);
          // Update successful
          $con->commit();
          return true;
      } catch (PDOException $e) {
          // Handle the exception (e.g., log error, return false, etc.)
           $con->rollBack();
          return false; // Update failed
      }
       }
}
