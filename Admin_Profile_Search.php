    <?php
    $firstName = 
                $lastName = $gender = $email = $userName = $password = $recoveryEmail = "";

    $q = $_GET['uname'];

    if (empty($q)) {
        echo "empty searchbox.";
    }

    $conn = new mysqli("localhost", "automs_user_1", "123", "automs");

    if ($conn-> connect_error) {

        echo "Cannot connect to database";
    }
    else{
        $sql = "SELECT * FROM customer WHERE username= '".$q."' UNION SELECT * FROM accountant WHERE username= '".$q."' UNION SELECT * FROM mechanic WHERE username= '".$q."'";
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

    ?>