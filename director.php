<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$director_id = $_GET['id'];
$sql = "SELECT * FROM directors WHERE id = $director_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$sql_movies = "SELECT movies.id, movies.title, movies.poster, movies.release_date FROM movies 
               JOIN movie_director ON movies.id = movie_director.movie_id 
               JOIN directors ON movie_director.director_id = directors.id 
               WHERE directors.id = $director_id";
$result_movies = mysqli_query($conn, $sql_movies);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $row['name']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">首頁</a></li>
                <li><a href="logout.php">登出</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1><?php echo $row['name']; ?></h1>
        <div class="director-info">
            <img src="<?php echo $row['photo']; ?>" alt="<?php echo $row['name']; ?>的照片">
            <p><?php echo $row['bio']; ?></p>
        </div>
        <h2>執導作品</h2>
        <div class="movie-grid">
            <?php while ($row_movies = mysqli_fetch_assoc($result_movies)) { ?>
                <div class="movie">
                    <a href="movie.php?id=<?php echo $row_movies['id']; ?>"><img src="<?php echo $row_movies['poster']; ?>" alt="<?php echo $row_movies['title']; ?>"></a>
                    <h3><?php echo $row_movies['title']; ?></h3>
                    <p><?php echo $row_movies['release_date']; ?></p>
                </div>
            <?php } ?>
        </div>
    </main>
</body>
</html>
