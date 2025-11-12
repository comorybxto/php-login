<?php

function check_login($conn) {
    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $query = "SELECT * FROM login WHERE username = ? LIMIT 1";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result && $result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            return $user_data;
        }
    }
    //redirect to login
    header("Location:login.php");
    die;
}

?>