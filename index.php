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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="./aos-master/dist/aos.css">
</head>
<body>
    <div class="all">
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
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#portfolio">Portfolio</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#about">About Me</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link split" href="./tables.php"><i class="fa-solid fa-gear"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link split logout" href="./logout.php">Log Out</a>
                  </li>
                </ul>

              </div>
            </div>
          </nav>


        <section class="firstMain" id="home" data-aos="fade-up" data-aos-duration="1000">
            <article>
                <h1 class="display-2 hello" data-aos="fade-up" data-aos-duration="1000">こんにちは</h1>
                <h1 class="display-1 name" data-aos="fade-up" data-aos-duration="1000"><?php echo $data['user_fullName'] ?></h1>
                <h1 class="display-3 hii" data-aos="fade-up" data-aos-duration="1000"></h1>
                <p data-aos="fade-up" data-aos-duration="1000"><?php echo $data['user_desc'] ?></p>
                <a href="https://mail.google.com/mail/?view=cm&to=marcmrnda@gmail.com&su=What is it that you want?&body=Hello I am (State Your Name And Then Your Concerns)" target="_blank"><button class="contact" data-aos="fade-up" data-aos-duration="1000">Contact Me</button></a>
                <div class="socialmedia" data-aos="fade-up" data-aos-duration="1000">
                    <a href="<?php echo $data['facebook_link'] ?>" target="_blank" data-aos="fade-up" data-aos-duration="1000"><i class="fab fa-facebook-f"></i></a>
                    <a href="<?php echo $data['X_link'] ?>" target="_blank"><i class="fab fa-twitter" data-aos="fade-up" data-aos-duration="1000"></i></a>
                    <a href="<?php echo $data['instagram_link'] ?>" target="_blank" data-aos="fade-up" data-aos-duration="1000"><i class="fab fa-instagram"></i></a>
                    <a href="<?php echo $data['github_link'] ?>" target="_blank" data-aos="fade-up" data-aos-duration="1000"><i class="fab fa-github"></i></a>
                </div>
                <img src="<?php echo $data['user_pic'] ?>" class="profilepic" alt="">
            </article>
        </section>
    </div>

    <section class="secondMain" id="portfolio" data-aos="fade-down" data-aos-duration="2000">
            <h1 class="display-1">Projects</h1>  
      <div class="nav-wrapper">

      <?php $con->getProjectsByUserId($id); ?>

            
        </div>
        <button class="moreport">More Projects Here!</button>
    </section>

    <section class="thirdMain" id="about" data-aos="fade-up" data-aos-duration="1000">
      <h2 class="display-1">Education</h2>
      <div class="timelines">

  <ul>
    <li style="--accent-color:#41516C">
        <div class="date"><?php echo $data['preschool_year'] ?></div>
        <div class="title"><?php echo $data['preschool_name'] ?></div>
        <div class="descr"><?php echo $data['preschool_desc'] ?></div>
    </li>
    <li style="--accent-color:#FBCA3E">
        <div class="date"><?php echo $data['gradeSchool_year'] ?></div>
        <div class="title"><?php echo $data['gradeSchool_name'] ?></div>
        <div class="descr"><?php echo $data['gradeSchool_desc'] ?></div>
    </li>
    <li style="--accent-color:#E24A68">
        <div class="date"><?php echo $data['Jhighschool_year'] ?></div>
        <div class="title"><?php echo $data['Jhighschool_name'] ?></div>
        <div class="descr"><?php echo $data['Jhighschool_desc'] ?></div>
    </li>
    <li style="--accent-color:#1B5F8C">
        <div class="date"><?php echo $data['Shighschool_year'] ?></div>
        <div class="title"><?php echo $data['Shighschool_name'] ?></div>
        <div class="descr"><?php echo $data['Shighschool_desc'] ?></div>
    </li>
    <li style="--accent-color:#4CADAD">
        <div class="date"><?php echo $data['College_year'] ?></div>
        <div class="title"><?php echo $data['University_name'] ?></div>
        <div class="descr"><?php echo $data['University_desc'] ?></div>
    </li>
</ul>

      </div>
    </section>

  <section class="fourthMain" data-aos="fade-down" data-aos-duration="2000">
      <h2 class="display-1">Skills Progress</h2>
      <div class="containers">
      <div class="skills">
        
        <?php $con->getSkillsByUserId($id); ?>

        
      </div>
    </div>
  </section>
    


    <section class="fifthMain" id="contact" data-aos="fade-up" data-aos-duration="1000">
      <h2 class="display-1">Contact Me</h2>
      <!-- Wrapper container -->
<div class="containersss py-4">

  <!-- Bootstrap 5 starter form -->
  <form id="contactForm">

    <!-- Name input -->
    <div class="mb-3">
      <label class="form-label" for="name">Name</label>
      <input class="form-control" id="name" type="text" placeholder="Name" data-sb-validations="required" />
    </div>

    <!-- Email address input -->
    <div class="mb-3">
      <label class="form-label" for="emailAddress">Email Address</label>
      <input class="form-control" id="emailAddress" type="email" placeholder="Email Address" data-sb-validations="required, email" />
    </div>

    <!-- Subject input -->
    <div class="mb-3">
      <label class="form-label" for="subject">Subject</label>
      <input class="form-control" id="subject" type="text" placeholder="Subject" data-sb-validations="required" />
    </div>

    <!-- Message input -->
    <div class="mb-3">
      <label class="form-label" for="message">Message</label>
      <textarea class="form-control" id="message" type="text" placeholder="Message" style="height: 10rem;" data-sb-validations="required"></textarea>
    </div>

    <!-- Form submit button -->
    <div class="d-grid">
      <button class="btn btn-primary btn-lg" type="submit">Submit</button>
    </div>

  </form>

</div>
    </section>

      <footer class="bg-dark text-center text-white">
      <!-- Grid container -->
      <div class="container p-4 pb-0">
        <!-- Section: Social media -->
        <section class="mb-4">
          <!-- Facebook -->
          <a class="btn btn-outline-light btn-floating m-1" href="<?php echo $data['facebook_link'] ?>" role="button" target="_blank"
            ><i class="fab fa-facebook-f"></i
          ></a>
    
          <!-- Twitter -->
          <a class="btn btn-outline-light btn-floating m-1" href="<?php echo $data['X_link'] ?>" role="button" target="_blank"
            ><i class="fab fa-twitter"></i
          ></a>
    
          <!-- Instagram -->
          <a class="btn btn-outline-light btn-floating m-1" href="<?php echo $data['instagram_link'] ?>" role="button" target="_blank"
            ><i class="fab fa-instagram"></i
          ></a>
    
          <!-- Github -->
          <a class="btn btn-outline-light btn-floating m-1" href="<?php echo $data['github_link'] ?>" role="button" target="_blank"
            ><i class="fab fa-github"></i
          ></a>
        </section>
        <!-- Section: Social media -->
      </div>
      <!-- Grid container -->
    
      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2024 Copyright:
        <a class="text-white" href="https://mdbootstrap.com/">marcmrnda.com</a>
      </div>
      <!-- Copyright -->
    </footer>

</div>
  
    
</body>
<script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
<div class="elfsight-app-414a4784-4be7-4a55-b5d2-589c583441ec" data-elfsight-app-lazy></div>
<script src="bootstrap-4.5.3-dist/js/bootstrap.js"></script>
<script src="bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<script src="./typed.js-2.1.0/dist/typed.umd.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
<script src="./aos-master/dist/aos.js"></script>
<script src="app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="package/dist/sweetalert2.js"></script>
<script>
  var typed = new Typed(".hii",{
    strings: ["<?php echo $data['occupation_name1']?>","<?php echo $data['occupation_name2']?>", "<?php echo $data['occupation_name3']?>"],
    typespeed: 10,
    backspeed: 10,
    loop: true
});
</script>

<script>
    $('.skill-per').each(function() {
  var $this = $(this);
  var per = $this.attr('per');
  $this.css("width", per+'%');
  });

</script>
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