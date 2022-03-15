<?php
try {
  $username = "root";
  $password = "";
$conn = new PDO('mysql:host=localhost;dbname=transporte;charset=utf8', $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo 'ERROR: ' . $e->getMessage();
}
?>
