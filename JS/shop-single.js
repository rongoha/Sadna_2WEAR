
$(document).ready(function(){

    $("#buy").click(function()
    {
        $("#buy").hide();
        $("#addToCart").hide();
    })
  });
  

  
 function cartMes(){

  window.alert('The piece has been successfully added to your cart - this page is not Available');
}
function buyMes(){

  window.alert('Thank you for your purchase - this page is not Available');
}



// slide pictures

let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("demo");
  let captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}

    function openUploadDialog() {
      // Hide the Buy and Add To Cart buttons
      document.getElementById("buy").style.display = "none";
      document.getElementById("addToCart").style.display = "none";
      // Show the upload form and the Cancel button
      document.getElementById("upload-form").style.display = "block";
      document.getElementById("cancel-upload-btn").style.display = "block";
  }

    function closeUploadDialog() {
      // Show the Buy and Add To Cart buttons
      document.getElementById("buy").style.display = "block";
      document.getElementById("addToCart").style.display = "block";
      // Hide the upload form and the Cancel button
      document.getElementById("upload-form").style.display = "none";
      document.getElementById("cancel-upload-btn").style.display = "none";
  }

  