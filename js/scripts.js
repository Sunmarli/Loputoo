
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


import { Modal, Ripple, initMDB } from "mdb-ui-kit";

initMDB({ Modal, Ripple });


