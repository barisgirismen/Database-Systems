<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include "connection.php";
        
        $newjid = $_POST["$jid"];
        $salary = $_POST["salary"];
        $description = $_POST["description"];
        $phone = $_POST["phone"];
        $numOpenings = $_POST["numOpenings"];
        $newusername = $_POST["$hrrusername"];
        $openingdate = $_POST["openingdate"];
        $duration = $_POST["duration"];
        $comp_cid = $_POST["comp_cid"];
        $is_manOrIntern = $_POST["is_manOrIntern"];
        $contract_type = $_POST["contract_type"];
        
        
        $jquery1= "select * from company where cid='$comp_cid'";
        $jresult1 = mysqli_query($conn, $query1);
        
        if (mysqli_num_rows($jresult1)!=0){
            echo "<font size='3'> <br>Invalid company CID, failed to create job posting</font>"; 
            echo "<br><a href=hrr.php> Back to Home Page </a>";
        }
        else {
            if ($is_manOrIntern == 0) {
                $addquery= "insert into job_posting(jid,descrption,salary,phone,numOpenings,hrr_username,openingdate,duration,comp_cid,is_manOrIntern,contract_type) values ('$newjid','$salary','$description','$phone','$numOpenings','$newusername','$openingdate','$duration','$comp_cid','$is_manOrIntern','$contract_type')";
                $addresult=mysqli_query($conn, $addquery);
                ?>
                <form action="hrr.php" method="post">
                <?php
                if ($addresult) {
                  echo "<br>End user successfully added<br><a href=index.html> Back to Home page </a>";
                } else {
                  echo "Error: ".$addquery."<br>".$addquery2."<br>".mysqli_error($conn);
                }    
            } else {
                $addquery= "insert into job_posting(jid,descrption,salary,phone,numOpenings,hrr_username,openingdate,duration,comp_cid,is_manOrIntern,contract_type) values ('$newjid','$salary','$description','$phone','$numOpenings','$newusername','$openingdate','$duration','$comp_cid','$is_manOrIntern','$contract_type')";
                $addresult=mysqli_query($conn, $addquery);
                ?>
                <form action="hrr.php" method="post">
                <?php
                if ($addresult) {
                  echo "<br>End user successfully added<br><a href=index.html> Back to Home page </a>";
                } else {
                  echo "Error: ".$addquery."<br>".$addquery2."<br>".mysqli_error($conn);
                }    
            }
        }
        mysqli_close($conn);
        ?>
    </body>
</html>