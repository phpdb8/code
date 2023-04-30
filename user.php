<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}


$user_id = $_SESSION['user_id'];
$mysqli = new mysqli("localhost", "使用者名稱", "密碼", "資料庫名稱");
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$query = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = $mysqli->query($query);
$user = $result->fetch_assoc();


$query = "SELECT * FROM comments WHERE user_id = '$user_id'";
$result = $mysqli->query($query);
$comments = array();
while ($row = $result->fetch_assoc()) {
  $comments[] = $row;
}

$query = "SELECT * FROM likes WHERE user_id = '$user_id'";
$result = $mysqli->query($query);
$likes = array();
while ($row = $result->fetch_assoc()) {
  $likes[] = $row;
}

?>

<html>
<head>
  <title>使用者介面</title>
</head>
<body>
  <h1>個人資料</h1>
  <ul>
    <li>使用者名稱：<?php echo $user['username']; ?></li>
    <li>信箱：<?php echo $user['email']; ?></li>
    <li>註冊時間：<?php echo $user['register_time']; ?></li>
  </ul>

  <h1>評論歷史記錄</h1>
  <?php if (count($comments) > 0) { ?>
    <ul>
      <?php foreach ($comments as $comment) { ?>
        <li><?php echo $comment['content']; ?> (電影：<?php echo $comment['movie_name']; ?>)</li>
      <?php } ?>
    </ul>
  <?php } else { ?>
    <p>暫無評論歷史記錄</p>
  <?php } ?>

  <h1>喜歡的電影</h1>
  <?php if (count($likes) > 0) { ?>
    <ul>
      <?php foreach ($likes as $like) { ?>
        <li><?php echo $like['movie_name']; ?></li>
      <?php } ?>
    </ul>
  <?php } else { ?>
    <p>暫無喜歡的電影</p>
  <?php } ?>
</body>
</html>
