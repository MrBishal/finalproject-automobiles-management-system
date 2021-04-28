<!DOCTYPE html>
<html>
<head>
	<title>Accountant Information</title>
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
    <h1>Accountant Mangement</h1>
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
        <input type="submit" name="addAccountantBtn" value="Add Accountant" /><br><br>



        <input type="submit" name="listBtn" value="Accountant List" /><br><br>
    </fieldset>

    </form> 
  </article>
</section>
	<?php
        if(array_key_exists('addAccountantBtn', $_POST)) {
            addAccountant();
        }

        else if(array_key_exists('listBtn', $_POST)) {
            accountantList();
        }

        function addAccountant() {
            header('Location: Add_Accountant.php');
			exit;
        }

        function accountantList() {

            $conn = new mysqli("localhost", "automs_user_1", "123", "automs");

            if ($conn-> connect_error) {

                echo "Cannot connect to database";
            }
            else{
                $sql = "SELECT * FROM accountant";
                $result = $conn ->query($sql);

                if($result -> num_rows >0){
                    while ($row = $result -> fetch_assoc()) {
                        echo "<fieldset>";
                        echo "User Name: " . $row['username'] . "<br>";
                        echo "First Name: " .$row['firstname'] . "<br>";
                        echo "Last Name: " .$row['lastname'] . "<br>";
                        echo "Gender: " .$row['gender'] . "<br>";
                        echo "Email: " .$row['email'] . "<br>";
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