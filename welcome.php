<?php
// Initialize the session
session_start();

if(isset($_SESSION['email'])) 
{
	
	if((time()-$_SESSION['last_time'])>200)
	{
		
		header('location:logout.php');
		
		
	}
	
	else
	{
		
		$_SESSION['last_time'] = time();
	}	
}

else
{
	
	
	header('location:Login.php');
	
	
	
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb1";

$err = "";

try 
{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to get values from form
	
	if(isset($_POST['Register']))
	{
	// Name
	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	
	//Experience
	$experience = $_POST['experience'];

	//Education
	$Degree1 = $_POST['Degree1'];
	$Degree2 = $_POST['Degree2'];
	
	$Major1 = $_POST['Major1'];
	$Major2 = $_POST['Major2'];
	
	$School1 = $_POST['School1'];
	$School2 = $_POST['School2'];
	
	$Year1 = $_POST['Year1'];
	$Year2 = $_POST['Year2'];
	
	$certification = $_POST['certification'];
	$certification1 = $_POST['certification1'];
	
	//Skills
	$Skills = $_POST['Skills'];
	
	
	//Accomplishments
	$Accomplishments = $_POST['Accomplishments'];
	$Accomplishments2 = $_POST['Accomplishments2'];
	$Accomplishments3 = $_POST['Accomplishments3'];


	//Address
	$City = $_POST['City'];
	$State = $_POST['State'];
	
	//Relocation
	$Relocate = $_POST['Relocate'];

	
	
	//Date
	$Date = $_POST['Date'];
	
	//Telephone Number
	$TelephoneNumber = $_POST['TelephoneNumber'];
	
	$usercheck = "Select count(*) as count From candidate WHERE `firstname`= '" . $firstname ."' AND lastname = '" . $lastname ."'";

	$result = $conn->query($usercheck);
	
	$count = 0;
	
	while ($row = $result->fetch())
	{
		$count = $row['count'];
		
	}
	
	if($count > 0)
	{
		echo "Value already exist";
	}
	
	else
	{
	
	//Insert data into mysql	
$sql = "INSERT INTO candidate (firstname, lastname, middlename, experience, Degree1, Degree2, Major1, Major2, 
School1, School2, Year1, Year2, certification, certification1, Skills, Accomplishments, Accomplishments2, Accomplishments3, City, State, Relocate, Date, TelephoneNumber)
VALUES('$firstname', '$middlename', '$lastname', '$experience', '$Degree1', 
'$Degree2', '$Major1', '$Major2', '$School1', 
'$School2', '$Year1', '$Year2', '$certification', 
'$certification1', '$Skills', '$Accomplishments', '$Accomplishments2', 
'$Accomplishments3', '$City', '$State', '$Relocate','$Date', '$TelephoneNumber')";

//if the data is inserted successfully display message "Successful"

    
    
    echo "Thank You for Registering with us.";
	
$conn->query($sql);

	}
  }		
}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>


<html>
<head>


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="Chrome">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
    
	
<style><?php include 'bootstrapstyle.css' ?></style>
    
    </head>
<title> Personal details </title>
<body>

<fieldset>
<legend>
<form name = "Exultancy" method = "post"  class = "registration" enctype = "multipart/form-data">
<input type = "hidden" name="submitted" value = "true" /> 
</legend>
     
	<div><h1>Exultancy Registration</h1></div>

	<ul>
	<div align = "right"><h3><a href = "logout.php"> Logout </a></h3></div></align>
	</ul>
	<br>
	<div>
	<ul class = "col-xs-6 col-sm-4"><label>First name:</label>  <input type="text" name="firstname" size = "15" value=" " required>
	</ul>
	<ul class = "col-xs-6 col-sm-4"><label>Middle name:</label>  <input type="text" name="middlename" size = "15" value="">
	</ul>
	<ul class = "col-xs-6 col-sm-4"><label>Last name:</label> <input type="text" name="lastname" size = "15" value=" " required >
	</ul></div>


<ul class = "col-xs-6 col-sm-4"><label>Experience:</label>
<div>
<select  name = "experience">
<option value = "Student"><b>Student</b></option>
<option value = "Entry level"><b>Entry level</b></option>
<option value = "Experienced"><b>Experienced</b></option>
</select>
</ul>
</div>
<br><br><br><br><br><br>

<div>
    <br><br>
    <ul><label>Education</label>
    <br>
   <div class= "row">
    <div class="col-xs-8 col-sm-6"><label>Degree</label>
	 <ul><input type="text" size="15" name="Degree1" id ="t1" required></ul>
	  <ul> <input type="text" size="15" name="Degree2" id ="t6" required></ul>
	</div>
    <div class="col-xs-8 col-sm-6"><label>Major</label>
	<ul> <input type="text" size="15" name="Major1" id ="t2" required></ul>
	<ul> <input type="text" size="15" name="Major2" id ="t7" required></ul>
	</div>
   <div class="col-xs-8 col-sm-6"><label>School</label>
	<ul> <input type="text" size="15" name="School1" id ="t3" required></ul>
	<ul> <input type="text" size="15" name="School2" id ="t8" required></ul>
                           
	</div>
    <div class="col-xs-8 col-sm-6"><label>Passing Year</label>
	 <ul> <input type="text" size = "15" name="Year1" id ="t4" required></ul>
	 <ul> <input type="text" size = "15" name="Year2" id ="t9" required></ul>
     </ul>                       
	</div></div>
	
    <br>
 <div>
	<ul class = "col-xs-6 col-sm-4"><label>Certification 1:</label> <br> <input type="text" name="certification" size = "15" value=" " required>
	</ul>
	<ul class = "col-xs-6 col-sm-4"><label>Certification 2:</label> <br> <input type="text" name="certification1" size = "15" value=" " required>
	</ul>
	</div>
	<br><br><br><br>
	<div>
	<ul class = "col-xs-6 col-sm-4"><label>Skills:</label>
    <br>
    <textarea rows = "3" cols = "20" name = "Skills">
	
	</textarea>
	</div>
    <br><br><br><br><br><br>
    </ul>
   
	<ul>
	<label>Accomplishments</label>
	 <ul> <input type="text" size = "15" name="Accomplishments" id ="t5"></ul>
	 <ul> <input type="text" size = "15" name="Accomplishments2" id ="t10"></ul>
	 <ul> <input type="text" size = "15" name="Accomplishments3" id ="t10"></ul>
       </ul>
	
    <br>
	<ul>
   <div align = "left"><label>Current location</label></div>
   <ul class="col-xs-4 col-md-6 last list-unstyled"><label>City</label>
   <li><input type = "text" size = "15" name = "City" required></li></ul>
   
   <ul class="col-xs-4 col-md-2 last list-unstyled"><label>State</label>
   <li><select name = "State" required>
   <option value = ""><b></b></option>
	<option value = "AL"><b>AL</b></option>
	<option value = "AK"><b>AK</b></option>
	<option value = "AZ"><b>AZ</b></option>
	
	<option value = "AR"><b>AR</b></option>
	<option value = "CA"><b>CA</b></option>
	<option value = "CO"><b>CO</b></option>
	
	<option value = "CT"><b>CT</b></option>
	<option value = "DE"><b>DE</b></option>
	<option value = "FL"><b>FL</b></option>
	
	<option value = "GA"><b>GA</b></option>
	<option value = "HI"><b>HI</b></option>
	<option value = "ID"><b>ID</b></option>
	
	<option value = "IL"><b>IL</b></option>
	<option value = "IN"><b>IN</b></option>
	<option value = "IA"><b>IA</b></option>
	
	<option value = "KS"><b>KS</b></option>
	<option value = "KY"><b>KY</b></option>
	<option value = "LA"><b>LA</b></option>
	
	<option value = "ME"><b>ME</b></option>
	<option value = "MD"><b>MD</b></option>
	<option value = "MA"><b>MA</b></option>
	
	<option value = "MI"><b>MI</b></option>
	<option value = "MN"><b>MN</b></option>
	<option value = "MS"><b>MS</b></option>
   
	<option value = "MO"><b>MO</b></option>
	<option value = "MT"><b>MT</b></option>
	<option value = "NE"><b>NE</b></option>
	
	<option value = "NV"><b>NV</b></option>
	<option value = "NH"><b>NH</b></option>
	<option value = "NJ"><b>NJ</b></option>
	
	<option value = "NM"><b>NM</b></option>
	<option value = "NY"><b>NY</b></option>
	<option value = "NC"><b>NC</b></option>
	
	<option value = "ND"><b>ND</b></option>
	<option value = "OH"><b>OH</b></option>
	<option value = "OK"><b>OK</b></option>
	
	<option value = "OR"><b>OR</b></option>
	<option value = "PA"><b>PA</b></option>
	<option value = "RI"><b>RI</b></option>
	
	<option value = "SC"><b>SC</b></option>
	<option value = "SD"><b>SD</b></option>
	<option value = "TN"><b>TN</b></option>
	
	<option value = "TX"><b>TX</b></option>
	<option value = "UT"><b>UT</b></option>
	<option value = "VT"><b>VT</b></option>
   
	<option value = "VA"><b>VA</b></option>
	<option value = "WA"><b>WA</b></option>
	<option value = "WV"><b>WV</b></option>
	
	<option value = "WI"><b>WI</b></option>
	<option value = "WY"><b>WY</b></option>
   
   </select>
   </li></ul>
        
<br><br><br><br>
<br>
<div>
<label>Willing to Relocate</label>
<br>

<input type = "radio" name = "Relocate" value ="Yes">Yes<br>
<input type = "radio" name = "Relocate" value ="No">No<br>
</div>
 
<br>
<form action = "upload.php" method = "POST" enctype="multipart/form-data">
<label>Upload Resume:</label> <input type = "file" name ="file" id = "fileToUpload">
<br>
</form>

<label>Date of Availability</label>
<br><input type = "date" name = "Date" required>

<br><br>

<label>Telephone:</label>
<br>

<input type = "number" size = "15" name = "TelephoneNumber" required>
    
 <br><br>
    
    <center><label><input type="submit" class ="submit" value="Register" name = "Register" /></label>
    
<label><input type = "Reset" class ="submit" value = "Reset" name = "Click"></label>


    </ul>
</center>
</fieldset>
</form>

</div>



				
</legend>		
</body>
</html>
      