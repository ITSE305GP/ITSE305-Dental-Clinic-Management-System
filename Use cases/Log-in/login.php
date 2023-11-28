<?php

        // Start the session to manage user session data
        session_start(); 

        try {

            // Include the file with the database connection details
            require("connection.php"); 

            // Retrieve the entered username and password from the form
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Prepare a SQL statement to select the user with the given username
            $sql = "SELECT * FROM users WHERE Username='$username'";

            
            // Execute the SQL statement
            $rs = $db->query($sql); 

            // Initialize a variable to hold the fetched row
            $row = null; 

        } catch (PDOException $e) {

            // If there's an error, display the error message and stop execution
            die($e->getMessage()); 
        }

        // Check if a row is fetched from the result set
        if ($row = $rs->fetch()) {

            // Verify the password using the password_verify function
            if (password_verify($password, $row['Password'])) {
                
  
                // Set the 'Active' session variable to the username
                $_SESSION['Active'] = $username; 

                // Redirect the user to the home.php page
                header("location:home.php"); 
            }
        } else {

            // If the username or password is incorrect, display an error message and redirect to the login page
            echo "<script>";
            echo "alert('Wrong username or password');";
            echo "window.location.href = 'login.php';";
            echo "</script>";

        }
?>

//The Login form that the user must fill
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
        //using method post because the form contain sensitive data (password)
        //didnt write action because the form must resend to the same page(Log-in.php)
        <form method='post'>
            Username:
            <input type='text' name='username'><br>
            Password:
            <input type='password' name='password'><br>
            <button type='submit'>Log-in</button>
        </form>

    
</body>
</html>