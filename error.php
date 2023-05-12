<html>
<head>
<meta charset="UTF-8">
</head>

<body>
非法進入網頁!<br/>
網頁將在三秒後跳轉至登入頁面或
<a href="signin.php">點選這裡</a>
<?php
header("Refresh:3;url=signin.php")
?>
</body>

</html>
