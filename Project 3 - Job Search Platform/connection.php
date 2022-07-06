<?php
$dbname="abc";
$conn=mysqli_connect("localhost", "root", "", $dbname);
// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: ".$conn -> connect_error;
  exit();
}  
?>

