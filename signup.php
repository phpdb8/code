<html>
<head>
	<title>註冊</title>
</head>
<body>
	<h1>註冊</h1>
	<form method="post">
		<label>使用者帳號：</label>
		<input type="text" name="username" required>
		<br><br>
		<label>密碼：</label>
		<input type="password" name="password" required>
		<br><br>
		<label>確認密碼：</label>
		<input type="password" name="confirm_password" required>
		<br><br>
		<input type="submit" name="register" value="註冊">
	</form>

	<?php
		if(isset($_POST['register'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$confirm_password = $_POST['confirm_password'];

			if($password != $confirm_password){
				echo "密碼不一致，請重新輸入。";
			} else {
				echo "註冊成功！";
			}
		}
	?>
</body>
</html>
