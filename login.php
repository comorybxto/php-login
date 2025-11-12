<?php
session_start();
include 'connection.php';
include 'functions.php';

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['user']) && isset($_POST['pass'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    if(!empty($username) && !empty($password)) {
        $query = "SELECT * FROM login WHERE username = ? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result && $result->num_rows > 0) {
            $user_data = $result->fetch_assoc();

            if($password != $user_data['password']) {
                echo '<script>alert("Login failed. Wrong password.");</script>';
            } else {
                $_SESSION['username'] = $user_data['username'];
                header("Location: index.php");
                die;
            }
        } else {
            echo '<script>alert("Login failed. Invalid username or password.");</script>';
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
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="form">
        <h1>Login Form</h1>
        </br>
        <form name="form" action="login.php" method="POST">
            <label>Username: </label>
            <input type="text" name="user" id="user"></br></br>
            <label>Password: </label>
            <input type="password" name="pass" id="pass"></br></br>
            <input type="submit" name="submit" id="btn" value="Login">
            </br></br></br>
            <input type="button" value="Sign up" onclick="window.location.href='signup.php'">
        </form>
    </div>
</body>
</html>