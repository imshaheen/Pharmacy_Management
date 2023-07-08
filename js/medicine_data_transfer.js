$(document).ready(function() {
    $('#medicineDropdown').on('change', function() {
      var selectedValue = $(this).val();
      if (selectedValue !== "") {
        fetchData(selectedValue);
      } else {
        clearFields();
      }
    });
  
    function fetchData(medicineName) {
      $.ajax({
        url: 'api.php',
        type: 'GET',
        data: { medicine: medicineName },
        success: function(response) {
          var data = JSON.parse(response);
          if (data) {
            $('#qty').val(data.qty);
            $('#batchId').val(data.batchId);
            $('#expiry').val(data.expiry);
          } else {
            clearFields();
          }
        },
        error: function() {
          alert('Error occurred while fetching data.');
        }
      });
    }
  
    function clearFields() {
      $('#qty').val('');
      $('#batchId').val('');
      $('#expiry').val('');
    }
  });


  function addField() {
    var templateRow = document.getElementById("medicines");
    var newRow = templateRow.cloneNode(true);
  
    var removeButton = newRow.querySelector(".btn-remove");
    removeButton.style.display = "inline-block";
    removeButton.addEventListener("click", function() {
      removeField(newRow);
    });
  
    newRow.removeAttribute("id"); // Remove the "id" attribute to avoid duplication
  
    document.getElementById("fieldsContainer").appendChild(newRow);
  
    var dropdown = newRow.querySelector("select[name='medicine_name[]']");
    var batchIdInput = newRow.querySelector("input[name='batchid']");
    var qtyInput = newRow.querySelector("input[name='quantity']");
    var expiryInput = newRow.querySelector("input[name='expiry_date']");
  
    dropdown.addEventListener("change", function() {
      var selectedMedicine = dropdown.value;
      var url = "api.php?medicine=" + selectedMedicine;
  
      fetch(url)
        .then(function(response) {
          return response.json();
        })
        .then(function(data) {
          batchIdInput.value = data.batchId;
          qtyInput.value = data.qty;
          expiryInput.value = data.expiry;
        })
        .catch(function(error) {
          console.log("Error fetching data: ", error);
        });
    });
  }
  



  function removeField(element) {
    var row = $(element).closest('.form-group');
    if (row.attr('id') === 'firstRow') {
      // Do not remove the first row
      return;
    }
    row.remove();
  }


  