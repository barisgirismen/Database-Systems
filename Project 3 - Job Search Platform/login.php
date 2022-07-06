<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    <?php
    include "connection.php";
    $uname=$_POST["uname"];
    $pwd=$_POST["pwd"];
    $logincid= intval($loginuname);
/////////////////////////////////////////////////////////////////////////////////////////////////            
    $login_eu = "select * from end_user where username = '$uname' and passwrd = '$pwd'";
    $success_eu = mysqli_query($conn, $pwd_eu);
/////////////////////////////////////////////////////////////////////////////////////////////////    
    $login_hrr = "select * from hrr where username = '$uname' and passwrd = '$pwd'";
    $success_hrr = mysqli_query($conn, $login_hrr);
//////////////////////////////////////////////////////////////////////////////////////////////////  
    $login_cid = "select * from company where cid = '$logincid'";
    $success_cid = mysqli_query($conn, $login_cid);
//////////////////////////////////////////////////////////////////////////////////////////////////          
    if (mysqli_num_rows($result_eu)!=0) {
        if (mysqli_num_rows($login_eu)!=0) {
        echo "<font size='3'> <br> End user login successful! </font>";
        }
    } elseif (mysqli_num_rows($result_hrr)!=0) {
        if (mysqli_num_rows($result_eu)!=0) {

        }    
    } elseif (mysqli_num_rows($result_cid)!=0) {
        if (mysqli_num_rows($result_eu)!=0) {
            
        }
    } else {
        echo "<font size='3'> <br> Unsuccessful login </font>"; 
        echo "<br><a href=index.html> Back to Login Page </a>";  
    }
    mysqli_close($conn);
    ?>
    </body>
</html>