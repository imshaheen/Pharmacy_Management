<!DOCTYPE html>
<html>
<head>
  <title>Add/Remove Rows Dynamically with PHP</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      // Add new row
      $('#add-row').click(function() {
        var html = '<tr><td><input type="text" name="name[]" placeholder="Name"></td><td><input type="text" name="email[]" placeholder="Email"></td><td><button class="remove-row">Remove</button></td></tr>';
        $('#data-table').append(html);
      });

      // Remove row
      $(document).on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
      });
    });
  </script>
</head>
<body>
  <form method="POST" action="process.php">
    <table id="data-table">
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
      <tr>
        <td><input type="text" name="name[]" placeholder="Name"></td>
        <td><input type="text" name="email[]" placeholder="Email"></td>
        <td><button class="remove-row">Remove</button></td>
      </tr>
    </table>
    <button id="add-row">Add Row</button>
    <button type="submit">Submit</button>
  </form>
</body>
</html>
