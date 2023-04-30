<?php
$conn = mysqli_connect("localhost", "username", "password", "database_name");


$movie_id = $_GET["id"];
$sql_movie = "SELECT name FROM movies WHERE id = $movie_id";
$result_movie = mysqli_query($conn, $sql_movie);
$row_movie = mysqli_fetch_assoc($result_movie);
$movie_name = $row_movie["name"];

$sql_actors = "SELECT * FROM actors WHERE id IN (SELECT actor_id FROM movie_actor WHERE movie_id = $movie_id)";
$result_actors = mysqli_query($conn, $sql_actors);
?>

<html>
<head>
	<title><?php echo $movie_name; ?> - 演員介紹</title>
</head>
<body>
	<h1><?php echo $movie_name; ?></h1>
	<h2>演員列表</h2>
	<table>
		<tr>
			<th>演員姓名</th>
			<th>演出角色</th>
			<th>個人介紹</th>
		</tr>
		<?php
		while ($row_actor = mysqli_fetch_assoc($result_actors)) {
			$actor_name = $row_actor["name"];
			$character_name = $row_actor["character_name"];
			$bio = $row_actor["bio"];
			echo "<tr>";
			echo "<td>$actor_name</td>";
			echo "<td>$character_name</td>";
			echo "<td>$bio</td>";
			echo "</tr>";
		}
		?>
	</table>
</body>
</html>

<?php
mysqli_close($conn);
?>
