var url = "https://nominatim.openstreetmap.org/search?format=json&q=" + address;

fetch(url)
  .then(response => response.json())
  .then(data => {
    var lat = data[0].lat;
    var lon = data[0].lon;
    var mymap = L.map('map').setView([lat, lon], 14);
    //L.marker([lat, lon]).addTo(mymap).bindPopup(address).openPopup();
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
    }).addTo(mymap);
    L.circle([lat, lon], {
      color: '#6699CC',
      fillColor: '#6699CC',
      fillOpacity: 0.2,
      radius: 500
    }).addTo(mymap);
    mymap.attributionControl.setPrefix(false);
    });


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
      document.getElementById("trade").style.display = "none";
      // Show the upload form and the Cancel button
      document.getElementById("upload-form").style.display = "block";
      document.getElementById("cancel-upload-btn").style.display = "block";
  }

    function closeUploadDialog() {
      // Show the Buy and Add To Cart buttons
      document.getElementById("buy").style.display = "block";
      document.getElementById("trade").style.display = "block";
      // Hide the upload form and the Cancel button
      document.getElementById("upload-form").style.display = "none";
      document.getElementById("cancel-upload-btn").style.display = "none";
  }

  