<?php
    // must go at very start of file
    // references last session
    session_start();
    date_default_timezone_set("EST");
    require_once '../load.php';

    if(isset($_SESSION['last_login'])){
        $_SESSION['last_login'] = $_SESSION['last_login']; 
    }else{
        $_SESSION['last_login'] = 'This is your first login';
    }
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
    <?php
        echo time();
    ?>
    <!-- calls upon current session time -->
    <p>Current Session: <?php echo $_SESSION['login']; ?></p>
    <p>Last Session: <?php echo $_SESSION['last_login']; ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>