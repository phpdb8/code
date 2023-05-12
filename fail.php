<?php ob_start(); ?>
<?php
session_start();

if($_SESSION["login"]=="No"){

}else{
    header("Location:error.php");
}
?>

<html>
<head>
<meta charset="UTF-8">
</head>

<body>
帳號或密碼錯誤!<br/>
網頁將在三秒後跳轉至登入頁面或
<a href="signin.php">點選這裡</a>
<?php
header("Refresh:3;url=signin.php")
?>
</body>

</html>
<?php ob_flush(); ?>
