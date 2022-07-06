<html>
    <head>
        <title>HRR Registration</title>
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
        $username=$_POST["username"]; 
        $passwrd=$_POST["passwrd"];
        $email=$_POST["email"];
        $fname=$_POST["fname"];
        $lname=$_POST["lname"];
        $endUser_username=$_POST["endUser_username"];
        
        $query1 = "select * from hrr where username = '$username'";
        $result1 = mysqli_query($conn, $query1);
        
        $query2 = "select * from hrr where endUser_username = '$endUser_username'";
        $result2 = mysqli_query($conn, $query2);
        
        $query3 = "select * from end_user where username = '$endUser_username'";
        $result3 = mysqli_query($conn, $query2);
        
        if(mysqli_num_rows($result1)!=0) {
            echo "<br><h1>This HRR already exists</h1><br><br>Redirecting to home page...<script>
              var timer = setTimeout(function() {
                  window.location='index.html'
              }, 2000);
          </script>";
        }
        elseif (mysqli_num_rows($result2)!=0){
            echo "<br><h1>This end user is already linked with another HRR account</h1><br><br>Redirecting to home page...<script>
              var timer = setTimeout(function() {
                  window.location='index.html'
              }, 2000);
          </script>";
        }
        else {
            if(empty($endUser_username)) {
                $addquery = "insert into hrr (username,passwrd,email,fname,lname) values ('$username','$passwrd','$email','$fname','$lname')";
                $addresult = mysqli_query($conn, $addquery);
                if ($addresult) {
                echo "<br><h1>HRR successfully registered!</h1><br><br>Redirecting to home page...<script>
              var timer = setTimeout(function() {
                  window.location='index.html'
              }, 2000);
          </script>";
                } else {
                echo "Error: ".$addquery."<br>".mysqli_error($conn);
                }
            } else {
                if (mysqli_num_rows($result3) == 0) {
                echo "<br><h1>This end user username does not exist</h1><br><br>Redirecting to home page...<script>
              var timer = setTimeout(function() {
                  window.location='index.html'
              }, 2000);
          </script>";
                } else {
                    $addquery = "insert into hrr (username,passwrd,email,fname,lname,endUser_username) values ('$username','$passwrd','$email','$fname','$lname','$endUser_username')";
                    $addresult = mysqli_query($conn, $addquery);
                    if ($addresult) {
                    echo "<br><h1>HRR successfully registered!</h1><br><br>Redirecting to home page...<br><script>
              var timer = setTimeout(function() {
                  window.location='index.html'
              }, 2000);
          </script>";
                    } else {
                    echo "Error: ".$addquery."<br>".mysqli_error($conn);
                    }
                }    
            }                      
        }
    mysqli_close($conn);
    echo "</div>";
    echo "</center>";
    ?>
    </body>
</html>