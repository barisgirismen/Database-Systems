<html>
   <head>
      <title>HRR Home Page</title>
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
      <div class="container" style="overflow-y: hidden; overflow-x: hidden; background: radial-gradient(circle, rgba(231,130,0,1) 0%, rgba(49,28,0,1) 70%, rgba(37,21,0,1) 80%, rgba(0,0,0,1) 100%); margin: -8px;">
         <div class="logo">
            <img src="img/favicon-64.png" width="32px">
         </div>
         <h2 style="text-align: center;">HRR Home Page</h2>
         <a href="logout.php">
            <div class="logoutLblPos">Logout</div>
         </a>
      </div>
      </label>
      </form>
      <?php
         include "connection.php";
         echo "<center>";
         echo "<br><br>";
         
         $hrrusername = $_POST["username"]; 
         $passwrd = $_POST["passwrd"]; 
         
         $hquery0 = "select * from hrr where username = '$hrrusername' and passwrd = '$passwrd'";
         $hresult0 = mysqli_query($conn, $hquery0);
         
         //Prevent users from logging in when wrong combination of username/password is entered
         if (mysqli_num_rows($hresult0) == 0) {    
             header("Location: /ABProject3/index.html");
         } else {
             //Welcome message
             echo "<h2>Successful login, welcome $hrrusername!</h2>";            
             $hquery3 = "select distinct max(jid) as jid from job_posting";
             $hresult3 = mysqli_query($conn, $hquery3);
         }
             
             //Check Maximum JID
             $jid = 0;
             if (mysqli_num_rows($hresult3) > 0) {
                 while($row = mysqli_fetch_assoc($hresult3)) {                    
                 $jid = $row["jid"];
                 }
                 echo "<h3>Maximum JID: $jid</h3>";    
             } else {
                 echo "<h3>No maximum JIDs</h3>";
             }           
                         
             //Create job posting's JID
             $createjid = ($jid + 1);
         
             //Display my postings
             $hquery2 = "select * from job_posting where hrr_username = '$hrrusername'";
             $hresult2 = mysqli_query($conn, $hquery2);
             
             echo "</center>";
         
             ?>
      <!---Added a button that looks like a chat-box to customize the project and give some information about us--->
      <div class="chat-bot loaded" id="myBtn"> <img src="img/create.png" height="48" id="myBtn">
         <label>Create job posting</label>
      </div>
      <!---Content of the button that looks like a chat-box--->
      <div id="myModal" class="modal">
         <div class="modal-content">
            <div class="modal-header">
               <span class="close-button"></span>
               <h2>Create a new job posting</h2>
            </div>
            <div class="modal-body">
               <form action="hrr.php" method="post">
                   <!--Create job postings--><br>
                  <b>Salary: </b> <input type="number" required name="salary"><br><br>
                  <b>Description: </b> <input type="text" required name="description"><br><br>
                  <b>Phone: </b> <input type="number" min="0000000000" max="9999999999" required name="phone"><br><br>
                  <b>Opening: </b> <input type="number" required min="1" name="salary"><br><br>
                  <b>Opening Date: </b><input type="date" required name="openingdate"><br><br>
                  <b>Duration: </b> <input type="number" required min="1" name="salary"><br><br>
                  <b>CID: </b> <input type="number" required name="cid"><br><br>
                  <label for="is_ManOrIntern"><b>Manager/Intern</b></label>
                  <select name="is_ManOrIntern" required id="is_ManOrIntern">
                     <option value="" disabled selected>Choose the position your are applying for</option>
                     <option value="0">Intern</option>
                     <option value="1">Manager</option>
                  </select>
                  <br><br>
                  <!--Manager Job Posting-->
                  <div id="0" class="hidden">
                      <b>Minimum Days: </b> <input type="number" min="1" required name="cid"><br><br>
                  </div>
                  
                  <!--Internship Job Posting-->
                  <div id="1" class="hidden">
                      
                      <b>Department Name: </b> <input type="text" required min="1" name="deptName"><br><br>
                      <b>Department Size: </b> <input type="number" required min="1" name="deptSize"><br><br>
                  </div>
                  
                  <label for="contract_type"><b>Contract Type:</b></label>
                  <select name="contract_type" required id="contract_type">
                     <option value="PT">PT</option>
                     <option value="FT">FT</option>
                  </select>
                  <br><br>
                  <input type="reset" name="resetbtn1" value="Reset">&emsp;<input type="submit" name="submitbtn1" value="Create Job Posting">
               </form>
            </div>
         </div>
      </div>
      <br>
      <br>
      <?php
         //Create table
         if (mysqli_num_rows($hresult2) > 0) {
         echo "<table style='border: solid 0px black; margin-left:auto; margin-right:auto; margin-top:6px; border-collapse: collapse; border: 4px ridge #E78200;'>";
         echo "<tr><th>JID   </th><th>Description   </th><th>Salary   </th><th>Phone   </th><th>Openings   </th><th>HRR Username   </th><th>Opening Date   </th><th>Duration   </th><th>CID   </th><th>Manager/Intern   </th><th>Contract Type</th></tr>";
             while($row = mysqli_fetch_assoc($hresult2)) {
                 echo "<tr><td>" . $row["jid"]."</td><td>".$row["description"]."</td><td>".$row["salary"]."</td><td>".$row["phone"]."</td><td>".$row["numOpenings"]."</td><td>".$row["hrr_username"]."</td><td>".$row["openingdate"]."</td><td>".$row["duration"]."</td><td>".$row["comp_cid"]."</td><td>".$row["is_manOrIntern"]."</td><td>".$row["contract_type"]."</td></tr>";
             }
         } else {
             echo "This HRR doesn't have any postings.";
         }
         
         
         ?>
      <script>
         //Script to run the button that looks like a chat-box
         var modal = document.getElementById("myModal");
         var btn = document.getElementById("myBtn");
         var span = document.getElementsByClassName("close-button")[0];
         btn.onclick = function() {
         modal.style.display = "block";
         btn.style.display = "none";
         }
         span.onclick = function() {
         modal.style.display = "none";
         btn.style.display = "block";
         }
         window.onclick = function(event) {
         if(event.target == modal) {
         modal.style.remove = "none";
         }
         }
         
        //Script to display options for Intern/Manager
        var ids3 = ["0", "1"];
        var dropDown3 = document.getElementById("is_ManOrIntern");
        dropDown3.onchange = function() {
                for(var x = 0; x < ids3.length; x++) {
                        document.getElementById(ids3[x]).style.display = "none";
                }
                document.getElementById(this.value).style.display = "block";
        }
      </script>
   </body>
</html>