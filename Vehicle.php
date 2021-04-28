<!DOCTYPE html>
<html>
<head>
	<title>Vehicle Information</title>
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

	<?php
	// session_start();
	// echo "Logged in Successfully... Welcome Admin : " . "<b>". $_SESSION['user'] . "</b>". "<br><br>";
	?>

<body background="car.jpg" style="text-align:center;">
    <div class="menu">
    <?php require 'Menu.php';?>
    </div>

<header>
    <h1>Vehicle Mangement</h1>
</header>

<section>
  <nav>
    <ul>
      <!-- <h2>Navigation</h2> -->
    </ul>
  </nav>
  
  <article>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
        <fieldset>
            <br>
        <input type="submit" name="addVehicleBtn" value="Add Vehicle" /><br><br>

        <input type="submit" name="listBtn" value="Vehicle List" /><br><br>
        </fieldset>
    </form> 

    </article>
</section>

	<?php
        if(array_key_exists('addVehicleBtn', $_POST)) {
            addVehicle();
        }

        else if(array_key_exists('listBtn', $_POST)) {
            vehicleList();
        }

        function addVehicle() {
            header('Location: Add_Vehicle.php');
			exit;
        }

        function vehicleList() {

            $conn = new mysqli("localhost", "automs_user_1", "123", "automs");

            if ($conn-> connect_error) {

                echo "Cannot connect to database";
            }
            else{
                $sql = "SELECT * FROM vehicle";
                $result = $conn ->query($sql);

                if($result -> num_rows >0){
                    while ($row = $result -> fetch_assoc()) {
                        echo "<fieldset>";
                        echo "Brand Name: " . $row['brandname'] . "<br>";
                        echo "Model Name: " .$row['modelname'] . "<br>";
                        echo "Vehicle Type: " .$row['type'] . "<br>";
                        echo "Security Number: " .$row['securityno'] . "<br>";
                        echo "</fieldset>";
                        
                    }
                }

                $conn -> close();
            }
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