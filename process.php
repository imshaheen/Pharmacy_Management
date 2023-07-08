<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $names = $_POST['name'];
  $emails = $_POST['email'];

  // Access the submitted values
  for ($i = 0; $i < count($names); $i++) {
    $name = $names[$i];
    $email = $emails[$i];

    // Do something with the values (e.g., insert into database)
    // ...
  }
}
?>