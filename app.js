const currentStep = 0;
const steps = document.querySelectorAll(".form-step");

$('.nav-wrapper .item').click(function(e){
  if($(this).hasClass('active')){
    $(this).removeClass('active');
  }
  else{
    $('.nav-wrapper .item').removeClass('active');
    $(this).toggleClass('active');
  }
  
});



  AOS.init();

// You can also pass an optional settings object
// below listed default settings
AOS.init({
  // Global settings:
  disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
  startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
  initClassName: 'aos-init', // class applied after initialization
  animatedClassName: 'aos-animate', // class applied on animation
  useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
  disableMutationObserver: false, // disables automatic mutations' detections (advanced)
  debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
  throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)
  

  // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
  offset: 120, // offset (in px) from the original trigger point
  delay: 0, // values from 0 to 3000, with step 50ms
  duration: 400, // values from 0 to 3000, with step 50ms
  easing: 'ease', // default easing for AOS animations
  once: false, // whether animation should happen only once - while scrolling down
  mirror: false, // whether elements should animate out while scrolling past them
  anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation

});

var typed = new Typed(".hi",{
    strings: ["A Striving Student","A Future Developer ", "A Future Cyborg"],
    typespeed: 10,
    backspeed: 10,
    loop: true
});


// script.js
// script.js
document.addEventListener('DOMContentLoaded', function() {
  const items = document.querySelectorAll('.container');
  const timeline = document.querySelector('.timeline');

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');

        // Reset the animation
        timeline.classList.remove('line-visible');
        setTimeout(() => {
          timeline.classList.add('line-visible');
        }, 100); // Add a small delay to allow the animation to reset

      } else {
        entry.target.classList.remove('visible');
      }
    });
  }, { threshold: 0.5 });

  items.forEach(item => {
    observer.observe(item);
  });
});

  $('.skill-per').each(function() {
  var $this = $(this);
  var per = $this.attr('per');
  $this.css("width", per+'%');
  });


  function openPage(pageName, elmnt, color) {
    // Hide all elements with class="tabcontent" by default
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    tablinks = document.getElementsByClassName("tablink");

    // Check if the clicked tab is already open
    var isOpen = document.getElementById(pageName).style.display === "block";

    // Hide all tab content
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }

    // Remove the background color of all tablinks/buttons
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].style.backgroundColor = "";
    }

    // If the clicked tab is not already open, open it
    if (!isOpen) {
      document.getElementById(pageName).style.display = "block";
      elmnt.style.backgroundColor = color;
    }
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

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
              }
          });
      } else {
          $('#email').removeClass('is-valid is-invalid');
          $('#emailFeedback').text('');
          $('#nextButton').prop('disabled', false); // Enable the Next button if username is empty
      }
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form");
  const birthdayInput = document.getElementById("birthday");
  const steps = document.querySelectorAll(".form-step");
  let currentStep = 0;

  // Set the max attribute of the birthday input to today's date
  const today = new Date().toISOString().split('T')[0];    
  birthdayInput.setAttribute('max', today);

  // Add event listeners for real-time validation
  const inputs = form.querySelectorAll("input, select");
  inputs.forEach(input => {
    input.addEventListener("input", () => validateInput(input));
    input.addEventListener("change", () => validateInput(input));
  });

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
  window.nextStep = () => {
    // Only proceed to the next step if the current step is valid
    if (validateStep(currentStep)) {
      steps[currentStep].classList.remove("form-step-active"); // Hide the current step
      currentStep++; // Increment the current step index
      steps[currentStep].classList.add("form-step-active"); // Show the next step
    }
  };

  // Function to move to the previous step
  window.prevStep = () => {
    steps[currentStep].classList.remove("form-step-active"); // Hide the current step
    currentStep--; // Decrement the current step index
    steps[currentStep].classList.add("form-step-active"); // Show the previous step
  };

  // Function to validate all inputs in the current step
  function validateStep(step) {
    let valid = true;
    // Select all input and select elements in the current step
    const stepInputs = steps[step].querySelectorAll("input, select");

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
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/; //make explanation
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