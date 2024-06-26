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

    function view(){
      $con = $this->opencon();
      return $con->query("SELECT users.user_id, users.user_firstname, users.user_lastname, users.user_birthday, users.user_sex, users.user_name, users.user_profile_picture, CONCAT(user_address.city,', ', user_address.province) AS address from users INNER JOIN user_address ON users.user_id = user_address.user_id")->fetchAll();

    }

    function delete($id) {
    try {
    $con = $this->opencon();
    $con->beginTransaction();

    // Delete user address
    $query = $con->prepare("DELETE FROM user_address WHERE user_id = ?");
    $query->execute([$id]);

    // Delete user
    $query2 = $con->prepare("DELETE FROM users WHERE user_id = ?");
    $query2->execute([$id]);

    $con->commit();
    return true; // Deletion successful
} catch (PDOException $e) {
    $con->rollBack();
    return false;
}  

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

    function insertEducation($user_id, $preschoolName, $preschoolYear, $gradeschoolName, $gradeschoolYear, $JhighschoolName, $JhighschoolYear, $ShighschoolName, $ShighschoolYear, $universityName, $collegeYear) {
        
      try
    {
        $con = $this->opencon();
        $con->beginTransaction();
        $con->prepare("INSERT INTO education (user_id, preschool_name, preschool_year, gradeSchool_name, gradeSchool_year, Jhighschool_name, Jhighschool_year, Shighschool_name, Shighschool_year, University_name, College_year) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?)")->execute([$user_id, $preschoolName, $preschoolYear, $gradeschoolName, $gradeschoolYear, $JhighschoolName, $JhighschoolYear, $ShighschoolName, $ShighschoolYear, $universityName, $collegeYear]);
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




    function viewdata($id){
    
      try {
        $con = $this->opencon();
        $query = $con->prepare("SELECT users.user_id, users.user_firstname, users.user_lastname, users.user_birthday, users.user_sex, users.user_name, user_profile_picture, user_address.city, user_address.barangay, user_address.street, user_address.province FROM users INNER JOIN user_address ON users.user_id = user_address.user_id WHERE users.user_id = ?");
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
        $query = $con->prepare("UPDATE users SET user_profile_picture = ? WHERE user_id = ?");
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
}
