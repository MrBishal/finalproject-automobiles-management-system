<!DOCTYPE html>
<html>
<head>
	<title>Add Vehicle</title>
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
	<h1>Add Vehicle</h1>
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
		<legend>Vehicle Information:</legend>

		<label for="brandName">Brand Name:</label>
		<input type="text" id="brandName" name="bname">
		<span class="error">* 
			<?php 
			if (isset($brandNameErr)) echo $brandNameErr;
			?>
				
		</span>

		<br>
		
		<label for="modelName">Model Name: </label>
		<input type="text" id="modelName" name="mname">
		<span class="error">* <?php if (isset($modelNameErr)) echo $modelNameErr;?></span>

		<br>

		<label for="type">Vehicle Type: </label>
		<input type="radio" id="type" name="type" value="Luxury">
		<label for="Luxury">Luxury</label>
		<input type="radio" id="Type" name="type" value="Sports">
		<label for="Sports">Sports</label>
		<span class="error">* <?php if (isset($typeErr)) echo $typeErr;?></span>
		<br>

		<label for="securityNo">Security No: </label>
		<input type="password" id="sequrityNo" name="sno">
		<span class="error">* <?php if (isset($securityErr)) echo $securityErr;?></span>

		<br>
		
		
		
		</fieldset>

		<input type="submit" value="Submit">
		<input type="reset" value="Reset">

	</form>

	<p id="errorMsg"></p>

  </article>
</section>

<footer>
	<div class="footer">
	<?php require 'Footer.php';?>
	</div>
  <!-- <p><h2>Footer</h2></p> -->
</footer>	

	<?php
		// define variables and set to empty values
		$brandName= $modelName =$type = $securityNo = "";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		  if (empty($_POST["bname"])) {
		    $brandNameErr = "Brand Name is required";
		  } else {
		    $brandName = test_input($_POST["bname"]);
		    // check if name only contains letters and whitespace
		    if (!preg_match("/^[a-zA-Z-' ]*$/",$brandName)) {
		      $brandNameErr = "Only letters and white space allowed";
		    }
		  }

		  if (empty($_POST["mname"])) {
		    $modelNameErr = "Model Name is required";
		  } else {
		    $modelName = test_input($_POST["mname"]);
		    // check if name only contains letters and whitespace
		    if (!preg_match("/^[a-zA-Z-' ]*$/",$modelName)) {
		      $modelNameErr = "Only letters and white space allowed";
		    }
		  }

		  if (empty($_POST["type"])) {
		    $typeErr = "Type is required";
		  } else {
		    $type = test_input($_POST["type"]);
		  }
		  
		    
		  if (empty($_POST["sno"])) {
		    $securityErr = "Security No. is required";
		  } else {
		    $securityNo = test_input($_POST["sno"]);
		    
		    if (strlen($_POST["sno"]) <= 7) {
        		$securityErr = "Your Security code Must Contain At Least 8 Characters!";
    		}
    		elseif(!preg_match("#[0-9]+#",$securityNo)) {
        		$securityErr = "Your Security code Must Contain At Least 1 Number!";
    		}
    		elseif(!preg_match("#[A-Z]+#",$securityNo)) {
        		$securityErr = "Your Security code Must Contain At Least 1 Capital Letter!";
    		}
    		elseif(!preg_match("#[a-z]+#",$securityNo)) {
        		$securityErr = "Your Security code Must Contain At Least 1 Lowercase Letter!";
    		}
		  }

		}

		if(!empty($_POST['bname']) && !empty($_POST['mname']) && !empty($_POST['type']) && !empty($_POST['sno'])){

			$hostname = "localhost";
			$dbusername = "automs_user_1";
			$dbpassword = "123";
			$dbname = "automs";

			$conn1 = new mysqli($hostname, $dbusername, $dbpassword, $dbname);

			if($conn1->connect_errno) {
				echo "Database Connection Failed!...";
				echo "<br>";
				echo $conn1->connect_error;
			}
			else {
				//echo "Database Connection Successful!";
				//echo "<br>";

				$stmt1 = $conn1->prepare("insert into vehicle (brandname, modelname, type, securityno) values (?, ?, ?, ?)");
				$stmt1->bind_param("ssss", $brandName, $modelName, $type, $securityNo);
				
				$status = $stmt1->execute();
				if($status) {
					echo "\nVehicle Added Successfully.";
					echo "<br>";
				}
				else {
					echo '<b><p style="color:red;">Failed to insert data!</p></b>';
					echo '<b><p style="color:red;">' . $conn1->error . '</p></b>';
		
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

	<script>
		function validate() {
			var isValid = false;
			var brandName = document.forms["jsForm"]["bname"].value;
			var modelName = document.forms["jsForm"]["mname"].value;
			var type = document.forms["jsForm"]["type"].value;
			var securityNo = document.forms["jsForm"]["sno"].value;

			if(brandName == "" || modelName =="" || type == "" || email == "" || securityNo == "") {
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