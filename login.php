<?php

require_once('classes/database.php');
$con = new database();
session_start();



if (isset($_SESSION['username']) && isset($_SESSION['account_type'])) {
  if ($_SESSION['account_type'] == 0) {
    header('location:index.php');
  } else if ($_SESSION['account_type'] == 1) {
    header('location:index.php?status=success3');
  }
  exit();
}




$error = ""; // Initialize error variable

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $result = $con->check($username, $password);

  if ($result) {
      $_SESSION['username'] = $result['user_name'];
      $_SESSION['account_type'] = $result['account_type'];
      $_SESSION['user_id'] = $result['user_id'];
      $_SESSION['project_id'] = $result['projects_id'];
      // Redirect based on account type
      if ($result['account_type'] == 0) {
        header('location:admin.php?status=success2');
      } else if ($result['account_type'] == 1) {
        header('location:index.php?status=success2');
      }
      exit();
  } else {
      $error = "Incorrect username or password. Please try again.";
      
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
    <title>Document</title>
</head>
<body>
    <div class="allLogin">
        <h1 class="display-1">Ready to Dive Into The Fun?</h1>
        <div class="containers1">
            <h2 class="text-center login-heading mb-2">Login</h2>
            <form method="post">
                <div class="form-group">
                    <input type="text" name="username" class="form-control <?php if (!empty($error)) echo 'error-input'; ?>" placeholder="Enter a username"> 
                    <input type="password" name="password" class="form-control <?php if (!empty($error)) echo 'error-input'; ?>" placeholder="********">
                </div>

                <?php if (!empty($error)) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $error; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>


                
                <input type="submit" name="login" class="buttonLogin" value="Login">
                <small>You don't have an Account? <a href="">Register Here!!</a></small>
                
            </form>
        </div>
    </div>
</body>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="bootstrap-4.5.3-dist/js/bootstrap.js"></script>
<script src="bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<!-- Bootsrap JS na nagpapagana ng danger alert natin -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</html>

