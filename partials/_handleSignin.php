<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "wonderweb";

    $conn = new mysqli($servername, $username, $password, $dbname);
}

$useremail = $_POST['signinemail'];
$username = $_POST['signinname'];
$pass= $_POST['password'];
$cpass= $_POST['cpassword'];

$exitsql = "SELECT * FROM `users` WHERE user_email = '$useremail'";
$result = mysqli_query($conn, $exitsql);
$numRows = mysqli_num_rows($result);
if($numRows>0){
    $showError = "Email already in use";
    header("Location: /WonderWeb/index.php?signinsuccess=user");
}
else{
    if($pass == $cpass){
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $sql= "INSERT INTO `users` (`user_name`, `user_email`, `user_pass`) VALUES ('$username', '$useremail', '$hash')";
        $result = mysqli_query($conn, $sql);
        if($result){
            $showAlert = true;
            header("Location: /WonderWeb/index.php?signinsuccess=true");
            exit();
        }

    }
    else{
        $showError = "Passwords do not match";
        header("Location: /WonderWeb/index.php?signinsuccess=false&error=$showError");
    }
}

?>