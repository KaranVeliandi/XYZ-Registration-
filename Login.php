<?php
// Include config file
require_once 'DBConnect.php';
 
// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = "";


 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
 
    // Check if username is empty
    if(empty(trim($_POST["email"])))
	{
        $email_err = 'Please enter email.';
    } 
	else
	{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password'])))
	{
        $password_err = 'Please enter your password.';
    }
	else
	{
        $password = trim($_POST['password']);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err))
	{
        // Prepare a select statement
        $sql = "SELECT email, password FROM sign_in WHERE email = :email";
        
        if($stmt = $conn->prepare($sql))
		{
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':email', $param_email, PDO::PARAM_STR);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute())
			{
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1)
				{
                    if($row = $stmt->fetch())
					{
                        $hashed_password = $row['password'];
                        if(password_verify($password, $hashed_password))
						{
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['email'] = $email;
							$_SESSION['last_time'] = time();							
                            header("location: welcome.php");
                        } 
						else
						{
                            // Display an error message if password is not valid
                           echo '<script type = text/javascript> alert("In-correct password entered.")</script>';
                        }
                    }
                } 
				else
				{
                    // Display an error message if username doesn't exist
                    echo '<script type = text/javascript> alert("No account found with that email ID.");</script>';
                }
            } 
			
			else
			{
                echo '<script type=text/javascript>alert("Oops!! Something went wrong");</script>';
            }
        }
		
		if($conn)
		{
			
			if(!empty($_POST['remember']))
			{
				
				setcookie("email", $_POST["email"],time()+(2*365*24*60*60));
				setcookie("password", $_POST["password"],time()+(2*365*24*60*60));
				
			}
			else
			{
				if(isset($_COOKIE["email"]))
				{
					setcookie("email", "");
				}
				if(isset($_COOKIE["password"]))
				{
					setcookie("password", "");
				}
				
			}
			
			
			
		}
			
        
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($conn);
}
?>

<html>
<head>
<link rel = "stylesheet" href="NewStyle.css">
</head>
<title> Sign in</title>
<body>

<form class="pure-form" method = "POST" action = "">

    <fieldset>
	<Center>
        <legend><h1>Exultancy Inc</h1></legend>
		<Center>
		<div>
		<div align = "left"><label><b>E-Mail</label></align></div>
		<input type = "email" placeholder="Enter Email" id="email" name="email" type="email"  value = "<?php if(isset($_COOKIE["email"])){ echo $_COOKIE["email"]; }?>" required>
		<div id="email_error" class="val_error"></div>
		</div>
<br>
		<div>
		<div align = "left"><label>Password</label></align></div></b>
        <input type="password" placeholder="Enter Password" id="password" name="password" minlength = "6" maxlength = "20" value = "<?php if(isset($_COOKIE["password"])){ echo $_COOKIE["password"]; }?>" required><br>
		<div align = "left">
		<p style= "color:black;"><b>Not a member yet??? <a href = "Sign-up.php"><p style= "color:antiquewhite;"> Sign up </a></p>
		<input type = "checkbox" name = "remember" value = "1" <?php if(isset($_COOKIE["email"])){?> checked <?php } ?> <label>Remember Me</label>
		<br><br><label>Forgot Password??</label> <a href = "ForgotPassword.php">Click here!!
		</align>
		<br>
		<Center>
        <button type="submit" class="pure-button pure-button-primary" name = "login" value="Login">Login</button>
		</Center>
    </fieldset>
</form>
</body>
</html>


