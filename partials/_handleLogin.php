<?php

$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "wonderweb";

    $conn = new mysqli($servername, $username, $password, $dbname);
}
$email = $_POST['loginemail'];
$pass= $_POST['loginpassword'];
$name= $_POST['loginname'];

$sql = "SELECT * FROM users WHERE user_email = ?";
$stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    if (password_verify($pass, $row['user_pass'])) {
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['userid'] = $row['user_id'];
        $_SESSION['userpass'] = $row['user_pass'];
        $_SESSION['useremail'] = $email;
        $_SESSION['username'] = $name; 
        echo'logged in '. $name;
        header("Location: /WonderWeb/index.php?loginsuccess=true");

    } else {
        echo 'Unable to login';
        header("Location: /WonderWeb/index.php?loginsuccess=false");
    }
} else {
    echo 'User not found';
    header("Location: /WonderWeb/index.php?loginsuccess=user");
}


?>