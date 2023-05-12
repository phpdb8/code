<?php
    session_start();
    $servername = "127.0.0.1:3306";
    $username = "username";
    $password = "password";
    $dbname = "moviesdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM movies WHERE id = " . $_GET["id"];
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>

<html>
<head>
    <title><?php echo $row["title"]; ?></title>
</head>
<body>
    <h1><?php echo $row["title"]; ?></h1>
    <img src="<?php echo $row["image"]; ?>" alt="<?php echo $row["title"]; ?>">
    <p><?php echo $row["description"]; ?></p>

    <?php
        if (isset($_SESSION["username"])) {
            echo '<form method="POST" action="submit_comment.php">
                    <input type="hidden" name="movie_id" value="' . $_GET["id"] . '">
                    <textarea name="comment"></textarea>
                    <br>
                    <input type="submit" value="Submit">
                  </form>';
        } else {
            echo '<p>Please <a href="login.php">login</a> to leave a comment.</p>';
        }
    ?>

    <h2>Comments:</h2>

    <?php
        $sql = "SELECT * FROM comments WHERE movie_id = " . $_GET["id"];
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div>';
                echo '<p>' . $row["comment"] . '</p>';
                echo '<p>By: ' . $row["username"] . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>No comments yet.</p>';
        }
    ?>

</body>
</html>

<?php
    $conn->close();
?>
