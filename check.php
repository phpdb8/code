<?php

    $servername = "127.0.0.1:3306";
    $username = "localhost";
    $password = "Yes";
    $dbname = "phpdb8";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("連線失敗：" . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
  
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    
if ($result->num_rows === 1) {
        header("Location: home.php");
    } else {
        echo "帳號或密碼錯誤！";
        header("Location: signin.php");
    }
}

$conn->close();
?>
