<!DOCTYPE html>
<html>
<head>
  <title>Dynamic Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h2>Dynamic Form</h2>
    <div class="form-group">
      <label for="selectField">Select Field:</label>
      <select class="form-control" id="selectField">
        <option value="name">Name</option>
        <option value="email">Email</option>
        <option value="phone">Phone</option>
      </select>
    </div>
    <div class="form-group">
      <button class="btn btn-primary" onclick="addField()">Add Field</button>
    </div>
    <form id="dynamicForm">
      <div class="row">
        <div class="col">
          <label>Field Name</label>
        </div>
        <div class="col">
          <label>Field Value</label>
        </div>
      </div>
      <div id="fieldsContainer"></div>
    </form>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="script.js"></script>
</body>
</html>
<script>

// Initialize field count and disable remove button for first row
let fieldCount = 0;

// Function to add new fields
function addField() {
  fieldCount++;

  const fieldsContainer = document.getElementById('fieldsContainer');
  
  // Create a new row
  const row = document.createElement('div');
  row.className = 'row';

  // Create field name input
  const fieldNameCol = document.createElement('div');
  fieldNameCol.className = 'col';

  const fieldNameInput = document.createElement('input');
  fieldNameInput.type = 'text';
  fieldNameInput.name = `fieldName${fieldCount}`;
  fieldNameInput.className = 'form-control';
  fieldNameCol.appendChild(fieldNameInput);
  row.appendChild(fieldNameCol);

  // Create field value input
  const fieldValueCol = document.createElement('div');
  fieldValueCol.className = 'col';

  const fieldValueInput = document.createElement('input');
  fieldValueInput.type = 'text';
  fieldValueInput.name = `fieldValue${fieldCount}`;
  fieldValueInput.className = 'form-control';
  fieldValueCol.appendChild(fieldValueInput);
  row.appendChild(fieldValueCol);

  // Create remove button
  if (fieldCount > 1) {
    const removeButtonCol = document.createElement('div');
    removeButtonCol.className = 'col';

    const removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.className = 'btn btn-danger';
    removeButton.innerHTML = 'Remove';
    removeButton.onclick = function() {
      fieldsContainer.removeChild(row);
    };
    removeButtonCol.appendChild(removeButton);
    row.appendChild(removeButtonCol);
  }

  fieldsContainer.appendChild(row);
}

// Fetch data based on select value
document.getElementById('selectField').addEventListener('change', function() {
  const selectedValue = this.value;
  console.log(`Selected value: ${selectedValue}`);

  // Perform your data fetching logic here
});
</script>