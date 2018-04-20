
<style><?php  include 'NewStyle.css';?></style>
<form action="" method="POST">

<h2>E-mail Address:</h2> <input type="text" name="email" size="20" />
<center>
<button type="submit" name="ForgotPassword" value=" Request Reset ">Reset Password</button>
</center>
</form>

<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb1";


try 
{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}

if(isset($_POST["ForgotPassword"]))
{
	 if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) 
	 {
		 $email = $_POST["email"];
	 }

	 else
	 {
		 echo "Email not valid";
		 exit;
	 }
	 
	 $query = $conn->prepare('SELECT email FROM sign_in WHERE email = :email');
	 $query->bindParam(':email', $email);
	 $query -> execute();
	 $userExists = $query->fetch(PDO::FETCH_ASSOC);
	 $conn = null;
	 
	 if($userExists["email"])
	 {
		 $salt = "498#2D83B631%3800EBD!801600D*7E3CC13";
		 $password = hash('sha512', $salt.$userExists["email"]);
		 $pwrurl = "Resetpassword1.php?q=".$password;
		 
		 $mailbody = "Dear user,\n\nIf this e-mail does not apply to you please ignore it. It appears that you have requested a password reset at our website www.exultancy.com\n\nTo reset your password, please click the link below. If you cannot click it, please paste it into your web browser's address bar.\n\n" . $pwrurl . "\n\nThanks,\nThe Administration";
		 mail($userExists["email"], "www.exultancy.com - Password Reset", $mailbody);
		 
		 echo '<script type=text/javascript>alert("Your Password Recovery link has been sent to your E-Mail address");</script>';

	 }
	 
	 else
		 echo '<script type=text/javascript>alert("No user with such E-Mail address exists");</script>';
	 

	 
	 
	 
}




?>








