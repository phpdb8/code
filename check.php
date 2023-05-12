    session_start();
    $servername = "127.0.0.1:3306";
    $username = "username";
    $password = "password";
    $dbname = "moviesdb";

    $conn = new mysqli($servername, $username, $password, $dbname);


<?php
if(){
    header("Location:home.php");
}else
