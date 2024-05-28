<?php
  $con = mysqli_connect("localhost","root","","pw2024_tubes_233040036");

  // Check Connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }
?>