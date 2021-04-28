<!DOCTYPE html>
<html>
<head>
	<title>Admin Update Info</title>
</head>

<style>
* {
  box-sizing: border-box;
}

header {
  background-color: white;
  padding: 0;
  text-align: center;
  
}

nav {
  float: left;
  width: 30%;
  height: auto;
  background-color: white;
  padding: 0;
}

nav ul {
  list-style-type: none;
  padding: 0;
}

article {
  float: left;
  padding: 0;
  width: 40%;
  background-color: white;
}

section::after {
  content: "";
  display: table;
  clear: both;
}

footer {
  background-color: white;
  padding: 0;
  text-align: center;
}

table{
	text-align: right;
	width: 100%;
}

@media (max-width: 600px) {
  nav, article {
    width: 100%;
    height: auto;
  }
}
</style>

<body background="car.jpg" style="text-align:center;>

	<div class="menu">
	<?php require 'Menu.php';?>
	</div>

<header>
	<h1>Update Information</h1>
</header>

<section>
  <nav>
    <ul>
      <!-- <h2>Navigation</h2> -->
    </ul>
  </nav>
  
  <article>

	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<fieldset>
		<legend>Basic Information:</legend>

		<label for="firstName">First Name:</label>
		<input type="text" id="firstName" name="fname">
		<span class="error"> 
			<?php 
			if (isset($firstNameErr)) echo $firstNameErr;
			?>
				
		</span>

		<br>
		
		<label for="lastName">Last Name: </label>
		<input type="text" id="lastName" name="lname">
		<span class="error"> <?php if (isset($lastNameErr)) echo $lastNameErr;?></span>

		<br>

		<label for="Gender">Gender: </label>
		<input type="radio" id="Gender" name="gender" value="male">
		<label for="male">Male</label>
		<input type="radio" id="Gender" name="gender" value="female">
		<label for="female">Female</label>
		<span class="error"> <?php if (isset($genderErr)) echo $genderErr;?></span>
		<br>
		
		<label for="Email">Email: </label>
		<input type="email" id="email" name="email">
		<span class="error"> <?php if (isset($emailErr)) echo $emailErr;?></span>

		<br>
		
		
		</fieldset>
		
		<fieldset>
		<legend>User Account Information:</legend>

		<br>
		

		<label for="Password">Password: </label>
		<input type="password" id="Password" name="pword">
		<span class="error"> <?php if (isset($passwordErr)) echo $passwordErr;?></span>

		<br>
		
		<label for="recoveryEmail">Recovery Email: </label>
		<input type="email" id="remail" name="remail">
		<span class="error"> <?php if (isset($recoveryEmailErr)) echo $recoveryEmailErr;?></span>

		<br>
		
		
		</fieldset>

		<input type="submit" value="Submit">
		<input type="reset" value="Reset">

	</form>

	<p id="errorMsg"></p>

  </article>
</section>	

	<?php

	session_start();
	$firstName = 
				$lastName = $gender = $email = $userName = $password = $recoveryEmail = "";

		$var = $_SESSION['user'];
        $pass = $_SESSION['password'];

		// $f = fopen("data.txt", "r");
				
		// $data = fread($f, filesize("data.txt"));
		// $data_filter = explode("\n", $data);

		// for($i = 0; $i< count($data_filter)-1; $i++){
		// 	$json_decode = json_decode($data_filter[$i], true);

		// 	if(($json_decode['userName']==$_SESSION['user']) && ($json_decode['password']==$_SESSION['password']))
		// 	{
		// 		$firstName = $json_decode['firstName'];
		// 		$lastName = $json_decode['lastName'];
		// 		$gender = $json_decode['gender'];
		// 		$email = $json_decode['email'];
		// 		$userName = $json_decode['userName'];
		// 		$password = $json_decode['password']; 
		// 		$recoveryEmail = $json_decode['recoveryEmail'];

		// 		$nuserName= $userName;
						
		// 	}
		// }

        $conn = new mysqli("localhost", "automs_user_1", "123", "automs");
        if($conn -> connect_error) {
            echo "Failed to connect database!";
        }
        else {

            $sql = "SELECT * FROM admin WHERE username= '".$var."' AND password='".$pass."'";
            $result = $conn -> query($sql);

            if($result -> num_rows > 0){
                while ($row = $result -> fetch_assoc()) {
                    if($row['username'] == $var)
                    {
                        $firstName=$row['firstname'];
                        $lastName=$row['lastname']; 
                        $gender=$row['gender'];
                        $email=$row['email'];
                        $userName=$row['username'];
                        $password=$row['password'];
                        $recoveryEmail=$row['recoveryemail'];
                        $nuserName= $var;
                    }
            }

                
            }

            $conn -> close();
        }

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		  if (empty($_POST["fname"])) {
		  	$nfirstName= $firstName;
		  } else {
		    $nfirstName = test_input($_POST["fname"]);
		    // check if name only contains letters and whitespace
		    if (!preg_match("/^[a-zA-Z-' ]*$/",$firstName)) {
		      $firstNameErr = "Only letters and white space allowed";
		    }
		  }

		  if (empty($_POST["lname"])) {
		  	$nlastName= $lastName;
		  } else {
		    $nlastName = test_input($_POST["lname"]);
		    // check if name only contains letters and whitespace
		    if (!preg_match("/^[a-zA-Z-' ]*$/",$lastName)) {
		      $lastNameErr = "Only letters and white space allowed";
		    }
		  }

		  if (empty($_POST["gender"])) {
		  	$ngender= $gender;
		  } else {
		    $ngender = test_input($_POST["gender"]);
		  }
		  
		  if (empty($_POST["email"])) {
		  	$nemail= $email;
		  } else {
		    $nemail = test_input($_POST["email"]);
		    // check if e-mail address is well-formed
		    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		      $emailErr = "Invalid email format";
		    }
		  }
		    
		  if (empty($_POST["pword"])) {
		  	$npassword= $password;
		  } else {
		    $npassword = test_input($_POST["pword"]);
		    
		    if (strlen($_POST["pword"]) <= 7) {
        		$passwordErr = "Your Password Must Contain At Least 8 Characters!";
    		}
    		elseif(!preg_match("#[0-9]+#",$password)) {
        		$passwordErr = "Your Password Must Contain At Least 1 Number!";
    		}
    		elseif(!preg_match("#[A-Z]+#",$password)) {
        		$passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
    		}
    		elseif(!preg_match("#[a-z]+#",$password)) {
        		$passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
    		}
		  }

		  if (empty($_POST["remail"])) {
		  	$nrecoveryEmail= $recoveryEmail;
		  } else {
		    $nrecoveryEmail = test_input($_POST["remail"]);
		    // check if e-mail address is well-formed
		    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		      $recoveryEmailErr = "Invalid email format";
		    }
		  }

		}

		if((!empty($_POST['fname']) || !empty($_POST['lname']) || !empty($_POST['gender']) || !empty($_POST['email']) || !empty($_POST['pword']) || !empty($_POST['remail'])) && (!isset($firstNameErr) && !isset($lastNameErr) && !isset($emailErr) && !isset($passwordErr) && !isset($recoveryEmailErr))){

			$hostname = "localhost";
			$dbusername = "automs_user_1";
			$dbpassword = "123";
			$dbname = "automs";

			// Mysqli Object-Oriented
			//echo "Mysqli Object-Oriented";
			//echo "<br>";
			$conn1 = new mysqli($hostname, $dbusername, $dbpassword, $dbname);

			if($conn1->connect_errno) {
				echo "Database Connection Failed!...";
				echo "<br>";
				echo $conn1->connect_error;
			}
			else {
				//echo "Database Connection Successful!";
				//echo "<br>";

				$stmt1 = $conn1->prepare("update admin set firstname = ?, lastname = ?, gender = ?, email = ?, password = ?, recoveryemail = ? where username = ?");
				$stmt1->bind_param("sssssss", $nfirstName, $nlastName, $ngender, $nemail, $npassword, $nrecoveryEmail, $nuserName);
				
				$status = $stmt1->execute();
				if($status) {
					echo "\n\nUpdated Successfully.";
					echo "<br>";
				}
				else {
					echo '<b><p style="color:red;">Failed to insert data!</p></b>';
					echo '<b><p style="color:red;">' . $conn1->error . '</p></b>';
		
				}

				$conn1->close();
			}

			//echo "Update Successfull.";
		}

		function test_input($data) {
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  		return $data;
		}
	?>

	<footer>
		<div class="footer">
		<?php require 'Footer.php';?>
		</div>
  		<!-- <p><h2>Footer</h2></p> -->
	</footer>

</body>
</html>