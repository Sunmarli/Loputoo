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
