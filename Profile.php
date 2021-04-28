<!DOCTYPE html>
<html>
    <head>
        <title>Admin Information</title>
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

    <div class="menu">
    <?php require 'Menu.php';?>
    </div>

    <body background="car.jpg" style="text-align:center;">

<header>
    <h1>Admin Information</h1>
</header>

<section>
  <nav>
    <ul>
      <!-- <h2>Navigation</h2> -->
    </ul>
  </nav>
  
  <article>
    
    <?php

        $firstName = 
                $lastName = $gender = $email = $userName = $password = $recoveryEmail = "";
 
        session_start();
        $var = $_SESSION['user'];
        $pass = $_SESSION['password'];


        // $file = fopen("data.txt", "r");
        
        // $data = fread($file, filesize("data.txt"));

        // $data_filter = explode("\n", $data);
        
        // for($i = 0; $i< count($data_filter)-1; $i++) {
            
        //     $json_decode = json_decode($data_filter[$i], true);
            

        //     if($json_decode['userName'] == $var) 
        //     {
        //         $firstName = $json_decode['firstName'];
        //         $lastName = $json_decode['lastName'];
        //         $gender = $json_decode['gender'];
        //         $email = $json_decode['email'];
        //         $userName = $json_decode['userName'];
        //         $password = $json_decode['password'];
        //         $recoveryEmail = $json_decode['recoveryEmail'];
        //     }

        // }
        // fclose($file);

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

                    }
            }

                
            }

            $conn -> close();
        }


    ?>

        <?php

            if(array_key_exists('logoutBtn', $_POST)) {
                logout();
            }
            else if(array_key_exists('updateInfoBtn', $_POST)) {
                updateInfo();
            }

            function logout() {
                unset($_SESSION['user']);
                header('Location: Admin_Registration.php');
                exit;
            }
            function updateInfo() {
                echo "This is updateinfo is selected";
                header('Location: Admin_UpdateInfo.php');
                exit;
            }

        ?>
        

            <fieldset>
                <legend><b>Admin Information:</b></legend>
            
                <label for="firstName"> First Name: </label>
                <?php echo $firstName; ?>

                <br>

                <label for="lastName"> Last Name: </label>
                <?php echo $lastName; ?>

                <br>

                <label for="gender"> Gender: </label>
                <?php echo $gender; ?>

                <br>

                <label for="email"> Email: </label>
                <?php echo $email; ?>

                <br>

                <label for="userName"> User Name: </label>
                <?php echo $userName; ?>

                <br>

                <label for="password"> Password: </label>
                <?php echo $password; ?>

                <br>

                <label for="recoveryEmail"> Recovery Email: </label>
                <?php echo $recoveryEmail; ?>

            </fieldset>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <input type="submit" name="logoutBtn" value="Log Out">

            <input type="submit" name="updateInfoBtn" value="Update Information">
        </form>

    </article>
</section>

    <footer>
        <div class="footer">
        <?php require 'Footer.php';?>
        </div>
        <!-- <p><h2>Footer</h2></p> -->
    </footer>
        
    </body>
</html>