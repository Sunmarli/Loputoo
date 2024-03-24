// Leaflet Map

// var map = L.map('map').setView([ 59.436962 ,24.753574], 13);
//
// L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
//   maxZoom: 19,
//   attribution:
//     '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
// }).addTo(map);

function Eraisik() {
  var formEraIsik = document.getElementById('eraisik_form');
  var formFirma = document.getElementById('firma_form');
  var form=document.getElementById('form');
  if (formEraIsik !== null && formFirma !== null) {
    formEraIsik.style.display = 'block';
    formFirma.style.display = 'none';
    form.style.display='none';
  }
}

function ForCompanyRegistration() {
  var formEraIsik = document.getElementById('eraisik_form');
  var formFirma = document.getElementById('firma_form');
  var form=document.getElementById('form');
  if (formEraIsik !== null && formFirma !== null) {
    formEraIsik.style.display = 'none';
    formFirma.style.display = 'block';
    form.style.display='none';
  }
}

document.addEventListener("DOMContentLoaded", function() {
  var elements = document.querySelectorAll('.truncated-text');
  elements.forEach(function(element) {
    truncateText(element);
  });
});

function truncateText(element) {
  var maxHeight = element.clientHeight;
  var text = element.innerHTML;

  // Create a temporary element to measure the height
  var tempElement = document.createElement('div');
  tempElement.style.visibility = 'hidden';
  tempElement.style.position = 'absolute';
  tempElement.style.width = element.offsetWidth + 'px';
  tempElement.innerHTML = text;
  document.body.appendChild(tempElement);

  // Check if the text exceeds the maximum height
  if (tempElement.offsetHeight > maxHeight) {
    // Binary search to find the maximum number of characters that fit within the maximum height
    var low = 0;
    var high = text.length - 1;
    while (low <= high) {
      var mid = Math.floor((low + high) / 2);
      tempElement.innerHTML = text.slice(0, mid + 1);
      if (tempElement.offsetHeight <= maxHeight) {
        low = mid + 1;
      } else {
        high = mid - 1;
      }
    }
    // Truncate the text and add ellipsis
    var truncatedText = text.slice(0, high) + '...';
    element.innerHTML = truncatedText;
  }

  // Remove the temporary element
  document.body.removeChild(tempElement);
}
