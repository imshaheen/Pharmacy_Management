// Assume you have form fields with IDs: 'name', 'email', 'message'
const customers_name = document.getElementById('customers_name').value;
const customers_contact_number = document.getElementById('customers_contact_number').value;
const customers_address = document.getElementById('customers_address').value;
const invoice_number = document.getElementById('invoice_number').value;
const invoice_date = document.getElementById('invoice_date').value;
const in_time = document.getElementById('in_time').value;
const out_time = document.getElementById('out_time').value;
const Disease = document.getElementById('Disease').value;
const fit_for_work = document.getElementById('fit_for_work').value;
const c_doctor = document.getElementById('c_doctor').value;
const medicine_name = document.getElementById('medicine_name').value;
const quantity_ = document.getElementById('quantity_').value;


// Create an object to hold the data
const data = {
  customers_name: customers_name,
  // invoice_number: invoice_number,
  invoice_date: invoice_date,
  in_time: in_time,
  out_time: out_time,
  Disease: Disease,
  fit_for_work: fit_for_work,
  c_doctor: c_doctor,
  medicine_name: medicine_name,
  quantity_: quantity_,
  // customers_address: customers_address,
};

// Send the data to the PHP script using AJAX
const xhr = new XMLHttpRequest();
xhr.open('POST', '/php/insert_data.php', true);
xhr.setRequestHeader('Content-Type', 'application/json');
xhr.onreadystatechange = function () {
  if (xhr.readyState === 4 && xhr.status === 200) {
    console.log(xhr.responseText);
    // Perform any additional actions after the data is sent
  }
};
xhr.send(JSON.stringify(data));

