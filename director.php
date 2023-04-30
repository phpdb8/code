<?php
    $director_id = $_GET['director_id'];
    $db = new mysqli('localhost', 'username', 'password', 'database_name');
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // 取得導演的資訊
    $director_query = "SELECT * FROM directors WHERE id = $director_id";
    $director_result = $db->query($director_query);
    $director_row = $director_result->fetch_assoc();

    // 取得導演指導過的作品
    $movies_query = "SELECT * FROM movies WHERE director_id = $director_id";
    $movies_result = $db->query($movies_query);
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $director_row['name']; ?> 的導演頁面</title>
    </head>
    <body>
        <h1><?php echo $director_row['name']; ?></h1>
        <p>年齡：<?php echo $director_row['age']; ?></p>
        <p>指導過的作品：</p>
        <ul>
            <?php while ($movies_row = $movies_result->fetch_assoc()): ?>
                <li><a href="movie.php?movie_id=<?php echo $movies_row['id']; ?>"><?php echo $movies_row['title']; ?></a></li>
            <?php endwhile; ?>
        </ul>
    </body>
</html>
