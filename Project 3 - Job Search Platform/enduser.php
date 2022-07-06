<html>
    <head>
        <title>End-User Home Page</title>
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
         overflow: visible;
         overflow-x: hidden;
         height: 100%;
         background-image: linear-gradient(to right bottom, #1e1e1e, #1c1c1c, #1a1a1a, #171717, #151515, #131313, #101010, #0d0d0d, #0a0a0a, #070707, #030303, #000000);
         }
      </style>
    </head>
    <body>
        <div class="container" style="overflow-y: hidden; overflow-x: hidden; background: radial-gradient(circle, rgba(231,130,0,1) 0%, rgba(49,28,0,1) 70%, rgba(37,21,0,1) 80%, rgba(0,0,0,1) 100%); margin: -8px;">
         <div class="logo">
            <img src="img/favicon-64.png" width="32px">
         </div>
         <h2 style="text-align: center;">End-User Home Page</h2>
         <a href="logout.php">
            <div class="logoutLblPos">Logout</div>
         </a>
      </div>
        <?php
        include "connection.php";
        echo "<center>";
        echo "<div style=''>";
        $username = $_POST["username"]; 
        $passwrd = $_POST["passwrd"]; 
        
        $equery0 = "select * from end_user where username = '$username' and passwrd = '$passwrd'";
        $eresult0 = mysqli_query($conn, $equery0);
        
        if (mysqli_num_rows($eresult0) == 0) {
            echo "<h1>Login unsuccessful</h1><br><br>Redirecting to home page...<script>
              var timer = setTimeout(function() {
                  window.location='index.html'
              }, 2000);
          </script>";
        } else {
            echo "<br><br><h1>Successful login, welcome $username!";
            $today = date('2011-05-02');
            echo "<h3>Current date: $today</h3>";
        
        //List all job postings, internship postings separately.
        $equery1_1 = "select * from job_posting where jid not in (select jid from internshipjobposting)";
        $eresult1_1 = mysqli_query($conn, $equery1_1);
        
        $equery1_2 = "select * from job_posting natural join internshipjobposting";
        $eresult1_2 = mysqli_query($conn, $equery1_2);
        
        //Create job postings table
        if (mysqli_num_rows($eresult1_1) > 0) {
        echo "<table style='border: solid 0px black; margin-left:auto; margin-right:auto; margin-top:6px; border-collapse: collapse; border: 4px ridge #E78200;'>";
        echo "<tr><th>JID</th><th>Description</th><th>Salary</th><th>Phone</th><th>Openings</th><th>HRR Username</th><th>Opening Date</th><th>Duration</th><th>CID</th><th>Manager/Intern</th><th>Contract Type</th></tr>";
            while($row = mysqli_fetch_assoc($eresult1_1)) {
                echo "<tr><td>" . $row["jid"]."</td><td>".$row["description"]."</td><td>".$row["salary"]."</td><td>".$row["phone"]."</td><td>".$row["numOpenings"]."</td><td>".$row["hrr_username"]."</td><td>".$row["openingdate"]."</td><td>".$row["duration"]."</td><td>".$row["comp_cid"]."</td><td>".$row["is_manOrIntern"]."</td><td>".$row["contract_type"]."</td></tr>";
            }
        } else {
            echo "No job postings available.";
        }
        
        echo "<br><br>";
        
        //Create internship postings table
        if (mysqli_num_rows($eresult1_2) > 0) {
        echo "<table style='border: solid 0px black; margin-left:auto; margin-right:auto; margin-top:6px; border-collapse: collapse; border: 4px ridge #E78200;'>";
        echo "<tr><th>JID</th><th>Description</th><th>Salary</th><th>Phone</th><th>Openings</th><th>HRR Username</th><th>Opening Date</th><th>Duration</th><th>CID</th><th>Manager/Intern</th><th>Contract Type</th><th>Minimum Days</th></tr>";
            while($row = mysqli_fetch_assoc($eresult1_2)) {
                echo "<tr><td>" . $row["jid"]."</td><td>".$row["description"]."</td><td>".$row["salary"]."</td><td>".$row["phone"]."</td><td>".$row["numOpenings"]."</td><td>".$row["hrr_username"]."</td><td>".$row["openingdate"]."</td><td>".$row["duration"]."</td><td>".$row["comp_cid"]."</td><td>".$row["is_manOrIntern"]."</td><td>".$row["contract_type"]."</td><td>".$row["minnumDays"]."</td></tr>";
            }
        } else {
            echo "No internship postings available.";
        }
        
        echo "<br><br>";
               
        //List open job postings, open internship postings separately.
        $equery2_1 = "select * from job_posting j where j.jid not in (select jid from internshipjobposting) and ('$today' > j.openingdate) and '$today' < (select date_add(j1.openingdate, interval duration day) from job_posting j1 where j.jid=j1.jid and ('$today' > j1.openingdate))";
        $eresult2_1 = mysqli_query($conn, $equery2_1);
        
        $equery2_2 = "select * from job_posting j natural join internshipJobPosting i where ('$today' > j.openingdate) and '$today' < (select date_add(j1.openingdate, interval duration day) from job_posting j1 natural join internshipJobPosting i where j.jid=j1.jid and ('$today' > j1.openingdate))";
        $eresult2_2 = mysqli_query($conn, $equery2_2);
        
        //Create open job postings table
        if (mysqli_num_rows($eresult2_1) > 0) {
        echo "<table style='border: solid 0px black; margin-left:auto; margin-right:auto; margin-top:6px; border-collapse: collapse; border: 4px ridge #E78200;'>";
        echo "<tr><th>JID</th><th>Description</th><th>Salary</th><th>Phone</th><th>Openings</th><th>HRR Username</th><th>Opening Date</th><th>Duration</th><th>CID</th><th>Manager/Intern</th><th>Contract Type</th></tr>";
            while($row = mysqli_fetch_assoc($eresult2_1)) {
                echo "<tr><td>" . $row["jid"]."</td><td>".$row["description"]."</td><td>".$row["salary"]."</td><td>".$row["phone"]."</td><td>".$row["numOpenings"]."</td><td>".$row["hrr_username"]."</td><td>".$row["openingdate"]."</td><td>".$row["duration"]."</td><td>".$row["comp_cid"]."</td><td>".$row["is_manOrIntern"]."</td><td>".$row["contract_type"]."</td></tr>";
            }
        } else {
            echo "No job postings available.";
        }
        
        echo "<br><br>";
        
        //Create open internship postings table
        if (mysqli_num_rows($eresult2_2) > 0) {
        echo "<table style='border: solid 0px black; margin-left:auto; margin-right:auto; margin-top:6px; border-collapse: collapse; border: 4px ridge #E78200;'>";
        echo "<tr><th>JID</th><th>Description</th><th>Salary</th><th>Phone</th><th>Openings</th><th>HRR Username</th><th>Opening Date</th><th>Duration</th><th>CID</th><th>Manager/Intern</th><th>Contract Type</th><th>Minimum Days</th></tr>";
            while($row = mysqli_fetch_assoc($eresult2_2)) {
                echo "<tr><td>" . $row["jid"]."</td><td>".$row["description"]."</td><td>".$row["salary"]."</td><td>".$row["phone"]."</td><td>".$row["numOpenings"]."</td><td>".$row["hrr_username"]."</td><td>".$row["openingdate"]."</td><td>".$row["duration"]."</td><td>".$row["comp_cid"]."</td><td>".$row["is_manOrIntern"]."</td><td>".$row["contract_type"]."</td><td>".$row["minnumDays"]."</td></tr>";
            }
        } else {
            echo "No internship postings available.";
        }
        
        //Display the company with highest paying job’s posting. (Part#2.Q3)
        /*$equery3 = "select j.comp_cid from job_posting as j where j.salary = (select max(salary) from job_posting);";
        $eresult3 = mysqli_query($conn, $equery3);
        
        //Find the highest paying manager job with department size<50 for an end user E.
        $equery4 = "select j.jid, description, j.salary, c.name from job_posting j, company c where j.salary = ( select max(j1.salary) from job_posting j1, manager_job_posting m where j1.is_manOrIntern=1 and j1.jid=m.jid and m.deptSize<50) and j.comp_cid=c.cid;";
        $eresult4 = mysqli_query($conn, $equery4);
        
        //Find the jobs those are suitable for an end user E, who is looking for a part-time job to work during the summer in Bodrum.
        $equery5 = "";
        $eresult5 = mysqli_query($conn, $equery5);
        
        //List the open internships positions of a particular company C which allows more than 20 days.
        $equery6 = "select * from (job_posting J natural join internshipJobPosting J1) join company C on J.comp_cid = C.cid where C.name = 'cname'  and J1.minnumdays>20";
        $eresult6 = mysqli_query($conn, $equery6);*/
        
        }
        echo "</div>";
        echo "</center>";
        ?>
    </body>
</html>