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
