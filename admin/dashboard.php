<?php
    // must go at very start of file
    // references last session
    session_start();
    require_once '../load.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Welcome</title>
</head>
<body>
    <h1>Welcome!</h1>
    <!-- calls upon current session time -->
    <p>Current Session: <?php echo $_SESSION['login']; ?></p>
    <p>Last Session: <?php echo $_SESSION['last_login']; ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>