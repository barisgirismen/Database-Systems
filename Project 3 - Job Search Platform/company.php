<html>
    <head>
        <title>Company Home Page</title>
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
         overflow: visible;
         overflow-x: hidden;
         background-image: linear-gradient(to right bottom, #1e1e1e, #1c1c1c, #1a1a1a, #171717, #151515, #131313, #101010, #0d0d0d, #0a0a0a, #070707, #030303, #000000);
         }
      </style>
    </head>
    <body>
        <?php
        echo "<center>";
        echo "<div style='padding: 100px;'>";
        include "connection.php";
        
        echo "<br><br>";
        
        $cid = $_POST["cid"];
        
        $cquery0 = "select * from company where cid = '$cid'";
        $cresult0 = mysqli_query($conn, $cquery0);
        
        if (mysqli_num_rows($cresult0) == 0) {
            echo "<br><h1>Login unsuccessful!</h1><br><br>Redirecting to home page...<script>
              var timer = setTimeout(function() {
                  window.location='index.html'
              }, 2000);
          </script>";
        } else {
            
            echo "<h2>Successful login, CID: '$cid'</h2>";
        
            echo "<br><br>";
            
        //    
        //Retrieve the names of HRRs that have job listings for this company
        $cquery1 = "select distinct H.fname, H.lname from hrr H, job_posting J, company C where H.username = J.hrr_username and '$cid' = J.comp_cid";
        $cresult1 = mysqli_query($conn, $cquery1);
        
        //HRRs that have postings for this company table
        if (mysqli_num_rows($cresult1) > 0) {
            echo "<h3>HRRs that have job listings for this company:</h3>";
            echo "<br><br>";
            while($row = mysqli_fetch_assoc($cresult1)) {
                echo $row["fname"]." ".$row["lname"];
                echo "<br>";
            }
        } else {
            echo "<h3>No HRRs have job postings for this company</h3>";
        }
        
        echo "<br><br>";
        
        //Display company’s job postings, along with the number of applicants
        $cquery2 = "select J.jid, count(*) as applicants from job_posting J, application A where J.jid = A.jid and J.comp_cid = '$cid'";
        $cresult2 = mysqli_query($conn, $cquery2);
        
        //Create postings and their application counts table
        if (mysqli_num_rows($cresult2) > 0) {
        echo "<table style='border: solid 1px black;'>";
        echo "<tr><th>JID</th><th>Number of Applicants</th></tr>";
            while($row = mysqli_fetch_assoc($cresult2)) {
                echo "<tr><td>" . $row["jid"]."</td><td>".$row["applicants"]."</td></tr>";
            }
        } else {
            echo "No internship postings available.";
        }
        
        echo "<br><br>";
        
        //Display applications to each posting if any
        $cquery3 = "select * from job_posting J natural join application A where J.comp_cid = '$cid'";
        $cresult3 = mysqli_query($conn, $cquery3);
        
         if (mysqli_num_rows($cresult2) > 0) {
        echo "<table style='border: solid 1px black;'>";
        echo "<tr><th>JID</th><th>Number of Applicants</th></tr>";
            while($row = mysqli_fetch_assoc($cresult2)) {
                echo "<tr><td>" . $row["jid"]."</td><td>".$row["applicants"]."</td></tr>";
            }
        } else {
            echo "No applications available to show.";
        }
        
        echo "<br><br>";
        
        //For either end-user applied to postings
        //Display unemployed end-users (Part#2.Q1, requires slight modification)
        $cquery4 = "select E.lname from end_user E, job_posting J, application A where E.username = A.username and A.jid = J.jid and J.comp_cid = '$cid' and  E.username not in (select distinct username from eu_employer)";
        $cresult4 = mysqli_query($conn, $cquery4);
        
        //Display the one that has been working at the same company for the longest period (Part#2.Q4, requires slight modification)
        $cquery5 = "select E.username, E.beginDate from eu_employer E, application A, job_posting J where  E.username = A.username and A.jid = J.jid and J.comp_cid = '$cid' and E.beginDate = (select min(beginDate) from eu_employer)";
        $cresult5 = mysqli_query($conn, $cquery5);
                
        //Display the number of applications of each (Part#2.Q7, requires slight modification)
        $cquery6 = "select A.username, count(*) from application A, job_posting J where A.jid = J.jid and J.comp_cid = '$cid'";
        $cresult6 = mysqli_query($conn, $cquery6);
        
        //Display the one with maximum experience (Part#2.Q8, requires slight modification) --> NOT SURE ABOUT THIS ONE THOUGH
        /*$cquery7 = "select username from (select sum(endDate - beginDate) as exp, username as u from employment_history group by username) as e, application a, job_posting j, company c where a.jid = j.jid and j.comp_cid = '$cid' and a.username = e.u and e.exp >= all (select sum(endDate - beginDate)  from employment_history  group by username)";
        $cresult7 = mysqli_query($conn, $cquery7);*/
        
        //Display internship postings, if any.
        $cquery8 = "select * from job_posting J natural join internshipJobPosting I  where J.jid = I.jid and J.comp_cid = '$cid'";
        $cresult8 = mysqli_query($conn, $cquery8);
        
        //For each internship posting, display the applications, and their details
        $cquery9 = "select * from ((internshipJobPosting I natural join job_posting J) natural join application A) where A.jid = J.jid and J.jid = I.jid and J.comp_cid = '$cid'";
        $cresult9 = mysqli_query($conn, $cquery9);
        
        }
            echo "</div>";
            echo "</center>";
        ?>
    </body>
</html>

