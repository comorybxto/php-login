<?php
session_start();

include 'connection.php';
include 'functions.php';

// Check if the user is already logged in
if(isset($_SESSION['username'])){
    header("Location: index.php");
    die;
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST['user'];
    $password = $_POST['pass'];

    if(!empty($username) && !empty($password) && !is_numeric($username))
    {
        // Check if the username already exists
        $stmt = $conn->prepare("SELECT * FROM login WHERE username = ? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result && $result->num_rows > 0) {
            echo '<script>alert("Username already exists. Please choose a different username.");</script>';
        } else {
            // Use prepared statements to prevent SQL injection
            $stmt = $conn->prepare("INSERT INTO login (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $stmt->close();

            header("Location: login.php"); //registered user can now login
            die;
        }
    } else {
        echo '<script>alert("Please enter a valid username and password.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="button.css">
</head>
<body>
    <div id="form">
        <h1>Register Form</h1>
        </br>
        <form name="form" action="signup.php" method="POST">
            <label>Username: </label>
            <input type="text" name="user" id="user"></br></br>
            <label>Password: </label>
            <input type="password" name="pass" id="pass"></br></br>
            <input type="submit" name="submit" id="btn" value="Register">
            </br></br></br>
            <input type="button" class="btn" value="Log in" onclick="window.location.href='login.php'">
        </form>
    </div>
</body>
</html>