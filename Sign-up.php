<?php
$servername = "localhost";
$username = "root";
$password1 = "";
$dbname = "mydb1";

  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password1);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//getting values from the form
if(isset($_POST['email'])&& isset($_POST['password']) && isset($_POST['confirm_password']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];
	$param_password = password_hash($password, PASSWORD_DEFAULT);
	$confirm_password = $_POST['confirm_password'];
	$var_md5password = md5($password);
	$usercheck = $email; // email check
	$usercheck = "Select count(*) as count From sign_in WHERE `email`= '" . $usercheck ."'";
	
	$result = $conn->query($usercheck);
	$count = 0;
	while ($row = $result->fetch())
	{
		$count = $row['count'];
		
	}
	
	
	if($count > 0)
	{
		echo '<script type = text/javascript> alert("Value already exists")</script>';
	}
	else
	{
		//Insert data into mysql	
		$sql = "INSERT INTO sign_in (email, password)VALUES('$email', '$param_password')";

		//if the data is inserted successfully display message "Successful"

    $conn->query($sql);
	
	echo '<script type = text/javascript> alert("Thank You for registering with us. Please Sign-in to proceed")</script>';
    
    }
$conn = null;
}
?>
<html>

<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="Chrome">
		<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        

        <style>
#wrapper
{
	width: 35%;
	margin: 40px auto;
	padding: 20px;
}
body
{
background: linear-gradient(to right, #0fb8ad, #1fc8db, #2cb5e8, #357ae8);
}

form
{
	width: 35%;
    margin: 100px auto;
    background-color: #2f70c0;
    border: 2px solid #2615b0;
    border-radius: 8px;
    padding: 20px
}


input[type=text], input[type=password], input[type=email] 
{
    width: 100%;
    padding: 15px 20px;
    margin: 8px 0;
    border: 1px solid #ccc;
    box-sizing: border-box;
	display: block;
}
button
{
    background-color: #2f499b;
    color: white;
    padding: 14px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 50%;
}


form div
{
	margin: 3px auto;
}

.btn
{
	padding: 7px;
	width: 100%;
}

a:link {
    color: red;
}

/* visited link */
a:visited {
    color: yellow;
}

/* mouse over link */
a:hover {
    color: hotpink;
}

/* selected link */
a:active {
    color: blue;
}
        
        
          
        </style>
</head>
<title> Sign up</title>

<body>


<form class="pure-form" method = "POST" action = "">

   
	<Center>
        <legend><h1>Exultancy Inc</h1></legend>
	</Center>
		<div>
			<div align = "left"><label><b>E-Mail</label></div>
		    <input type = "email" placeholder="Enter Email" id="email" name="email" type="email" required>
		<div id="email_error" class="val_error"></div>
		</div>

		<div>
		<div align = "left"><label><b>Password</label></align>
        <input type="password" placeholder="Password" id="password" name="password" minlength = "6" maxlength = "20" pattern = "(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title = "Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required><br>
        </div>

		<div align = "left"><label><b>Confirm Password</label></align>
        <input type="password" placeholder="Confirm Password" id="confirm_password" name="confirm_password" minlength ="6" maxlength ="20" required>
        </div>
		
		<div align = "left">
	<p><b> Already a member!!!</b></p>
	<p><b>Please</b> <a href = "Login.php">Sign in</p> 
        <a href = ""><b>Terms and conditions</b></a></p>
        </div>
        <div align = "center">
        <button type="submit" class="pure-button pure-button-primary">Submit</button></div>
		<br>
 
</form>

</body>
</html>


<script>
var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

//Password validation

function validatePassword()
{

  if(password.value != confirm_password.value) 
  {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } 
  else 
  {
    confirm_password.setCustomValidity('');
  }
  
}


password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;



</script>


