<!DOCTYPE html>
<html>
<head>
	<title>Add Customer</title>
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
  padding: 10px;
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
	<h1>Add Customer</h1>
</header>

<section>
  <nav>
    <ul>
      <!-- <h2>Navigation</h2> -->
    </ul>
  </nav>
  
  <article>
	<form name="jsForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return validate()">
		<fieldset>
		<legend>Basic Information:</legend>

		<label for="firstName">First Name:</label>
		<input type="text" id="firstName" name="fname">
		<span class="error">* 
			<?php 
			if (isset($firstNameErr)) echo $firstNameErr;
			?>
				
		</span>

		<br>
		
		<label for="lastName">Last Name: </label>
		<input type="text" id="lastName" name="lname">
		<span class="error">* <?php if (isset($lastNameErr)) echo $lastNameErr;?></span>

		<br>

		<label for="Gender">Gender: </label>
		<input type="radio" id="Gender" name="gender" value="male">
		<label for="male">Male</label>
		<input type="radio" id="Gender" name="gender" value="female">
		<label for="female">Female</label>
		<span class="error">* <?php if (isset($genderErr)) echo $genderErr;?></span>
		<br>
		
		<label for="Email">Email: </label>
		<input type="email" id="email" name="email">
		<span class="error">* <?php if (isset($emailErr)) echo $emailErr;?></span>

		<br>
		
		
		</fieldset>
		
		<fieldset>
		<legend>User Account Information:</legend>

		<label for="userName">User Name:</label>
		<input type="text" id="userName" name="uname">
		<span class="error">* <?php if (isset($userNameErr)) echo $userNameErr;?></span>

		<br>
		

		<label for="Password">Password: </label>
		<input type="password" id="Password" name="pword">
		<span class="error">* <?php if (isset($passwordErr)) echo $passwordErr;?></span>

		<br>
		
		<label for="recoveryEmail">Recovery Email: </label>
		<input type="email" id="remail" name="remail">
		<span class="error">* <?php if (isset($recoveryEmailErr)) echo $recoveryEmailErr;?></span>

		<br>
		
		
		</fieldset>

		<input type="submit" value="Submit">
		<input type="reset" value="Reset">

	</form>

	<p id="errorMsg"></p>

  </article>
</section>	

	<?php
		// define variables and set to empty values
		$firstName = 
				$lastName = $gender = $email = $userName = $password = $recoveryEmail = "";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		  if (empty($_POST["fname"])) {
		    $firstNameErr = "First Name is required";
		  } else {
		    $firstName = test_input($_POST["fname"]);
		    // check if name only contains letters and whitespace
		    if (!preg_match("/^[a-zA-Z-' ]*$/",$firstName)) {
		      $firstNameErr = "Only letters and white space allowed";
		    }
		  }

		  if (empty($_POST["lname"])) {
		    $lastNameErr = "Last Name is required";
		  } else {
		    $lastName = test_input($_POST["lname"]);
		    // check if name only contains letters and whitespace
		    if (!preg_match("/^[a-zA-Z-' ]*$/",$lastName)) {
		      $lastNameErr = "Only letters and white space allowed";
		    }
		  }

		  if (empty($_POST["gender"])) {
		    $genderErr = "Gender is required";
		  } else {
		    $gender = test_input($_POST["gender"]);
		  }
		  
		  if (empty($_POST["email"])) {
		    $emailErr = "Email is required";
		  } else {
		    $email = test_input($_POST["email"]);
		    // check if e-mail address is well-formed
		    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		      $emailErr = "Invalid email format";
		    }
		  }

		  if (empty($_POST["uname"])) {
		    $userNameErr = "User Name is required";
		  } else {
		    $userName = test_input($_POST["uname"]);
		    // check if name only contains letters and whitespace
		    if (!preg_match("/^[a-zA-Z-' ]*$/",$userName)) {
		      $userNameErr = "Only letters and white space allowed";
		    }
		  }
		    
		  if (empty($_POST["pword"])) {
		    $passwordErr = "Password is required";
		  } else {
		    $password = test_input($_POST["pword"]);
		    
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
		    $recoveryEmailErr = "Email is required";
		  } else {
		    $recoveryEmail = test_input($_POST["remail"]);
		    // check if e-mail address is well-formed
		    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		      $recoveryEmailErr = "Invalid email format";
		    }
		  }

		}

		if(!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['gender']) && !empty($_POST['email'])
				&& !empty($_POST['uname']) && !empty($_POST['pword']) && !empty($_POST['remail'])){

			// $arr1 = array('firstName' => $firstName, 'lastName' => $lastName, 'gender' => $gender , 'email' => $email, 'userName' => $userName, 'password' => $password , 'recoveryEmail' => $recoveryEmail);
			// $json_encoded_1 = json_encode($arr1);

			// $f1 = fopen("cdata.txt", "a");
			// fwrite($f1, $json_encoded_1 . "\n");
			// fclose($f1);

			// echo "\n Customer added successfully!";

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

				$stmt1 = $conn1->prepare("insert into customer (firstname, lastname, gender, email, username, password, recoveryemail) values (?, ?, ?, ?, ?, ?, ?)");
				$stmt1->bind_param("sssssss", $firstName, $lastName, $gender, $email, $userName, $password, $recoveryEmail);
				
				$status = $stmt1->execute();
				if($status) {
					echo "\nCustomer Added Successfully.";
					echo "<br>";
				}
				else {
					echo '<p style="color:red;">Failed to insert data!</p>';
					echo '<p style="color:red;">' . $conn1->error . '</p>';
		
				}

				$conn1->close();
			}
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

	<script>
		function validate() {
			var isValid = false;
			var firstName = document.forms["jsForm"]["fname"].value;
			var lastName = document.forms["jsForm"]["lname"].value;
			var gender = document.forms["jsForm"]["gender"].value;
			var email = document.forms["jsForm"]["email"].value;
			var userName = document.forms["jsForm"]["uname"].value;
			var password = document.forms["jsForm"]["pword"].value;
			var recoveryEmail = document.forms["jsForm"]["remail"].value;

			if(firstName == "" || lastName =="" || gender == "" || email == "" ||userName == "" || password == "" || recoveryEmail == "") {
				document.getElementById('errorMsg').innerHTML = "<b>Please fill up the form properly.</b>";
				document.getElementById('errorMsg').style.color = "red";
			}
			else {
				isValid = true;
			}

			return isValid;
		}
	</script>

</body>
</html>