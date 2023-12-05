<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
</head>
<body>
    <h2>Sign Up</h2>

    <?php
        // Define variables and set to empty values
        $username = $first_name = $last_name = $cpr = $phone_number = $password = $confirm_password = $date_of_birth = $location = '';

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $username = test_input($_POST['username']);
            $first_name = test_input($_POST['first_name']);
            $last_name = test_input($_POST['last_name']);
            $cpr = test_input($_POST['cpr']);
            $phone_number = test_input($_POST['phone_number']);
            $password = test_input($_POST['password']);
            $confirm_password = test_input($_POST['confirm_password']);
            $date_of_birth = test_input($_POST['date_of_birth']);
            $location = test_input($_POST['location']);

            // Validate form data
            if (empty($username) || empty($first_name) || empty($last_name) || empty($cpr) || empty($phone_number) || empty($password) || empty($confirm_password) || empty($date_of_birth) || empty($location)) {
                echo 'All fields are required.';
            } elseif ($password !== $confirm_password) {
                echo 'Passwords do not match.';
            } else {
                // Perform further validation and database operations here
                // For example, you can connect to the database and save the user details

                // Display success message
                echo 'Sign up successful!';
            }
        }

        // Function to sanitize form data
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label for="username">Username:</label><br>
        <input type="text" name="username" id="username" required><br><br>

        <label for="first_name">First Name:</label><br>
        <input type="text" name="first_name" id="first_name" required><br><br>

        <label for="last_name">Last Name:</label><br>
        <input type="text" name="last_name" id="last_name" required><br><br>

        <label for="cpr">CPR:</label><br>
        <input type="text" name="cpr" id="cpr" required><br><br>

        <label for="phone_number">Phone Number:</label><br>
        <input type="text" name="phone_number" id="phone_number" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password" required><br><br>

        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" name="confirm_password" id="confirm_password" required><br><br>

        <label for="date_of_birth">Date of Birth:</label><br>
        <input type="date" name="date_of_birth" id="date_of_birth" required><br><br>

        <label for="location">Location:</label><br>
        <input type="text" name="location" id="location" required><br><br>

        <input type="submit" value="Sign Up">
    </form>
</body>
</html>