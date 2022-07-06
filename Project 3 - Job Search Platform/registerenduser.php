<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
    <title>End-User Registration</title>
        <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        
	<!-- Favicons -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<link rel="icon" sizes="16x16 32x32 64x64" href="img/favicon.ico">
	<link rel="icon" type="image/png" sizes="196x196" href="img/favicon-192.png">
	<link rel="icon" type="image/png" sizes="160x160" href="img/favicon-160.png">
	<link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96.png">
	<link rel="icon" type="image/png" sizes="64x64" href="img/favicon-64.png">
	<link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16.png">
	<link rel="apple-touch-icon" href="img/favicon-57.png">
	<link rel="apple-touch-icon" sizes="114x114" href="img/favicon-114.png">
	<link rel="apple-touch-icon" sizes="72x72" href="img/favicon-72.png">
	<link rel="apple-touch-icon" sizes="144x144" href="img/favicon-144.png">
	<link rel="apple-touch-icon" sizes="60x60" href="img/favicon-60.png">
	<link rel="apple-touch-icon" sizes="120x120" href="img/favicon-120.png">
	<link rel="apple-touch-icon" sizes="76x76" href="img/favicon-76.png">
	<link rel="apple-touch-icon" sizes="152x152" href="img/favicon-152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="img/favicon-180.png">
	<meta name="msapplication-TileColor" content="#FFFFFF">
	<meta name="msapplication-TileImage" content="img/favicon-144.png">
	<meta name="msapplication-config" content="img/browserconfig.xml">
	<link rel="stylesheet" href="main.css">
	<style>
	html, body {
		margin: 0;
		height: 100%;
		overflow: hidden;
		background-image: linear-gradient(to right bottom, #1e1e1e, #1c1c1c, #1a1a1a, #171717, #151515, #131313, #101010, #0d0d0d, #0a0a0a, #070707, #030303, #000000);
	}
	</style>
    </head>
    <body>
        <?php
        echo "<center>";
        echo "<div style='padding: 100px;'>";
        include "connection.php";
        $username = $_POST["username"]; 
        $passwrd = $_POST["passwrd"]; 
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $military_service_stat = $_POST["military_service_stat"];

        $query1= "select * from end_user where username='$username'";
        $result1 = mysqli_query($conn, $query1);
        
        $query2 = "select * from eu_emails where email = '$email'";
        $result2 = mysqli_query($conn, $query2);
        
        if (mysqli_num_rows($result1)!=0){
            echo "<br><h1>This user already exists</h1><br><br>Redirecting to home page...<script>
              var timer = setTimeout(function() {
                  window.location='index.html'
              }, 2000);
          </script>";
        } else if (mysqli_num_rows($result2)!=0) {
            echo "<br><h1>This email has already been assigned to another user</h1><script>
              var timer = setTimeout(function() {
                  window.location='index.html'
              }, 2000);
          </script>";
        }
        else {
            $addquery= "insert into end_user (username,passwrd,fname,lname,military_service_stat) values ('$username','$passwrd','$fname','$lname','$military_service_stat')";
            $addresult=mysqli_query($conn, $addquery);
            
            $addquery2 = "insert into eu_emails(username,email) values ('$username','$email')";
            $addresult2 = mysqli_query($conn, $addquery2);
            
            if ($addresult && $addresult2) {
                    echo "<br><h1>End user successfully added!</h1><br>Redirecting to home page...<script>
              var timer = setTimeout(function() {
                  window.location='index.html'
              }, 2000);
          </script>";
            } else {
              echo "Error: ".$addquery."<br>".$addquery2."<br>".mysqli_error($conn);
            }
        }
        mysqli_close($conn);
        echo "</div>";
        echo "</center>";
        ?>
    </body>
</html>
