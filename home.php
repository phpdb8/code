<html>
<head>
    <meta charset="utf-8">
    <title>電影評論網站</title>
</head>
<body>
    <header>
        <h1>電影評論網站</h1>
        <?php
        session_start();
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $user_name = $_SESSION['user_name'];
            echo '<p>歡迎您登入，一起享受電影吧，' . $user_name . '</p>';
            echo '<form action="logout.php" method="post">
                      <button type="submit" name="logout">登出</button>
                  </form>';
        } else {
            echo '<a href="login.php">登入</a> 或 <a href="register.php">註冊</a>';
        }
        ?>
    </header>
    <main>
        <h2>所有電影</h2>
        <div class="movies">
            <?php
            // 連接數據庫，獲取所有電影記錄
            $conn = new mysqli('localhost', 'username', 'password', 'dbname');
            if ($conn->connect_error) {
                die('數據庫連接錯誤：' . $conn->connect_error);
            }
            $sql = "SELECT * FROM movies";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // 顯示每部電影的縮略圖和標題
                    echo '<div class="movie">
                              <a href="movie.php?id=' . $row['id'] . '">
                                  <img src="' . $row['image'] . '">
                                  <h3>' . $row['title'] . '</h3>
                              </a>
                          </div>';
                }
            } else {
                echo '沒有電影記錄';
            }
            $conn->close();
            ?>
        </div>
    </main>
</body>
</html>
