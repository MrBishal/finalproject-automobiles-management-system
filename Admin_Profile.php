<!DOCTYPE html>
<html>
<head>
	<title>Admin Profile</title>
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

    <div style="padding: 20px"; class="menu">
    <?php require 'Menu.php';?>
    </div>

    <div style="text-align: left";>
	<?php
	session_start();
	echo "Logged in Successfully... Welcome Admin : " . "<b>". $_SESSION['user'] . "</b>". "<br><br>";
	?>
    </div>
<body background="car.jpg" style="text-align:center;">

    <header>
    <h1>Manage Information</h1>
    </header>

<section>
  <nav>
    <ul>
      <!-- <h2>Navigation</h2> -->
      <fieldset>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
        <input type="submit" name="profileBtn" value="Prifile" /><br><br>
          
        <input type="submit" name="customerBtn" value="Customer" /><br><br>

        <input type="submit" name="accountantBtn" value="Accountant" /><br><br>

        <input type="submit" name="mechanicBtn" value="Mechanic" /><br><br>

        <input type="submit" name="vehicleBtn" value="Vehicle" /><br><br>

        <input type="submit" name="logoutBtn" value="Log Out" /><br><br>
        </form>
      </fieldset>   
    </ul>
  </nav>
  
  <article>

    <fieldset>
        <h4>Search User</h4>
        <label for="uname">User Name:</label>
        <input type="text" name="uname" id="uname">

    <button id="btn1" onclick="sendRequest()"> Search </button>

    <p id="p1"></p>
    </fieldset>

  </article>
</section>

    <footer>
        <div class="footer">
        <?php require 'Footer.php';?>
        </div>
        <!-- <p><h2>Footer</h2></p> -->
    </footer>

    <?php
        if(array_key_exists('profileBtn', $_POST)) {
            profile();
        }
        else if(array_key_exists('customerBtn', $_POST)) {
            customer();
        }
        else if(array_key_exists('accountantBtn', $_POST)) {
            accountant();
        }
        else if(array_key_exists('mechanicBtn', $_POST)) {
            mechanic();
        }
        else if(array_key_exists('vehicleBtn', $_POST)) {
            vehicle();
        }
        else if(array_key_exists('logoutBtn', $_POST)) {
            logout();
        }

        function profile() {
            header('Location: Profile.php');
            exit;
        }
        function customer() {
            header('Location: Customer.php');
            exit;
        }
        function accountant() {
            header('Location: Accountant.php');
            exit;
        }
        function mechanic() {
            header('Location: Mechanic.php');
            exit;
        }
        function vehicle() {
            header('Location: Vehicle.php');
            exit;
        }
        function logout() {
            unset($_SESSION['user']);
            header('Location: Admin_Registration.php');
            exit;
        }
    ?>

    <script>
        function sendRequest(){
            var uname = document.getElementById("uname").value;

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById("p1").innerHTML = xhttp.responseText;
                }
            }
            xhttp.open("GET", "Admin_Profile_Search.php?uname=" + uname , true);
            xhttp.send();
        }

    </script>

</body>
</html>