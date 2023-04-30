<html>
<head>
	<title>導演介面</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<h1>導演介面</h1>
	</header>

	<nav>
		<ul>
			<li><a href="home.php">首頁</a></li>
			<li><a href="movie.php">電影介面</a></li>
			<li><a href="user.php">用戶介面</a></li>
		</ul>
	</nav>

	<main>
		<?php
			// 連接資料庫
			$db_server = "localhost";
			$db_username = "root";
			$db_password = "";
			$db_name = "movie_database";

			$conn = mysqli_connect($db_server, $db_username, $db_password, $db_name);

			if (!$conn) {
				die("連接資料庫失敗: " . mysqli_connect_error());
			}


			$director_id = $_GET['id'];

			$sql = "SELECT * FROM directors WHERE director_id=$director_id";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
				$row = mysqli_fetch_assoc($result);
				echo "<h2>" . $row["director_name"] . "</h2>";
				echo "<p>" . $row["director_info"] . "</p>";
			} else {
				echo "找不到該導演";
			}

			$sql = "SELECT * FROM movies WHERE director_id=$director_id";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
				echo "<h2>電影列表</h2>";
				echo "<ul>";
				while($row = mysqli_fetch_assoc($result)) {
					echo "<li><a href='movie.php?id=" . $row["movie_id"] . "'>" . $row["movie_name"] . "</a></li>";
				}
				echo "</ul>";
			} else {
				echo "找不到該導演的電影";
			}

			mysqli_close($conn);
		?>
	</main>

</body>
</html>
