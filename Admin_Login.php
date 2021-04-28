<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
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

<body background="car.jpg" style="text-align:center;">

	<div class="menu">
	<?php require 'Menu.php';?>
	</div>

<header>
	<h1>Admin Login</h1>
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
		<legend><h3>Fillup Account Information:</h3></legend>

		<table>

		<tr>
		<td><label for="userName"><b>User Name: </b></label></td>
		<td style="text-align:left; width: 60%;"><input type="text" id="userName" name="uname"></td>
		<!-- <?php echo $userNameErr; ?>  -->
		</tr>

		<br>

		<tr>
		<td><label for="Password"><b>Password:</b></label></td>
		<td style="text-align:left; width: 60%;"><input type="password" id="Password" name="pword"></td>
		<!-- <?php echo $passwordErr; ?> -->
		</tr>

		</table>

		<br>
				
		</fieldset>

		<br>

		<input type="submit" value="Login">
		<input type="reset" value="Reset">

	</form>

	<p id="errorMsg"></p>

  </article>
</section>

	<?php 
	session_start();

		$userName = $password = "";
		$userNameErr = $passwordErr = "";

		if($_SERVER['REQUEST_METHOD'] == "POST") {
			
			if(empty($_POST['uname'])) {                    
                $userNameErr = "Username is required.";
            }

            else if(empty($_POST['pword'])) {                    
                $passwordErr = "Password is required.";
            } 
			else {
				
				$userName = $_POST['uname'];
				$password = $_POST['pword'];
				
				// $f = fopen("data.txt", "r");
				
				// $data = fread($f, filesize("data.txt"));
				// $data_filter = explode("\n", $data);

				// for($i = 0; $i< count($data_filter)-1; $i++){
				// 	$json_decode = json_decode($data_filter[$i], true);

				// 	if(($json_decode['userName']==$userName) && ($json_decode['password']==$password))
				// 	{
				// 		$_SESSION['user']= $userName;
				// 		$_SESSION['password']= $password;

				// 		header('Location: Admin_Profile.php');
				// 		exit;
					
				// 	}
				
				// 	else
				// 	{
				// 		echo "Login Failed";
				// 	}
				// }

				$conn = new mysqli("localhost", "automs_user_1", "123", "automs");
				if($conn -> connect_error) {
					echo "Failed to connect database!";
				}
				else {

					$sql = "SELECT * FROM admin WHERE username= '".$userName."' AND password='".$password."'";
					$result = $conn -> query($sql);

					if($result -> num_rows > 0){
						while ($row = $result -> fetch_assoc()) {
							$dbusername=$row['username']; 
							$dbpassword=$row['password'];
						}

				        if($userName == $dbusername && $password == $dbpassword)
				        {

				            $_SESSION['user']= $dbusername;
				            $_SESSION['password']= $dbpassword;

				            /* Redirect browser */
				            header("Location: Admin_Profile.php");
				        }

				        
					}
					else
				    {
						echo '<b><p style="color:red;">Login Failed!</p></b>';
					}

					$conn -> close();
				}					
				 
			}
		}
	?>

<footer>
  <!-- <p><h2>Footer</h2></p> -->
  	<div class="footer">
	<?php require 'Footer.php';?>
	</div>
</footer>	

	<script>
		function validate() {
			var isValid = false;
			var username = document.forms["jsForm"]["uname"].value;
			var password = document.forms["jsForm"]["pword"].value;

			if(username == "" || password == "") {
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