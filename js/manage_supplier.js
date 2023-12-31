function deleteSupplier(id) {
  var confirmation = confirm("Are you sure?");
  if(confirmation) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if(xhttp.readyState = 4 && xhttp.status == 200)
        document.getElementById('suppliers_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_doctor.php?action=delete&id=" + id, true);
    xhttp.send();
  }
}

function editSupplier(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('suppliers_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_doctor.php?action=edit&id=" + id, true);
  xhttp.send();
}

function updateSupplier(id) {
  var supplier_name = document.getElementById("supplier_name");
  var supplier_email = document.getElementById("supplier_email");
  var contact_number = document.getElementById("supplier_contact_number");
  var supplier_address = document.getElementById("supplier_address");
  if(!validateAddress(supplier_name.value, "name_error"))
    supplier_name.focus();
  else if(!validateContactNumber(contact_number.value, "contact_number_error"))
    contact_number.focus();
  else if(!validateAddress(supplier_address.value, "address_error"))
    supplier_address.focus();
  else {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if(xhttp.readyState = 4 && xhttp.status == 200)
        document.getElementById('suppliers_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_doctor.php?action=update&id=" + id + "&drname=" + supplier_name.value + "&drdegree=" + supplier_email.value +"&drphone=" + contact_number.value + "&draddress=" + supplier_address.value, true);
    xhttp.send();
  }
}

function cancel() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('suppliers_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_doctor.php?action=cancel", true);
  xhttp.send();
}

function searchSupplier(text) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('suppliers_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_doctor.php?action=search&text=" + text, true);
  xhttp.send();
}
