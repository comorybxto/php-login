<?php
    session_start();

    include 'connection.php';
    include 'functions.php';

    $user_data = check_login($conn);

    if (!$user_data) {
        header("Location: login.php");
        die;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body> 
    <a href="logout.php">Log out</a>
    <h1>Welcome, <?php echo htmlspecialchars($user_data['username']); ?>!</h1>
    <p>You have successfully logged in.</p>
</body>
</html>