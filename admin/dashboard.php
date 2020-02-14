<?php
    // must go at very start of file
    // references last session
    session_start();
    date_default_timezone_set("EST");
    require_once '../load.php';

    $pdo = Database::getInstance()->getConnection();

    //Check existence
    // with the username = $username => direct user input
    // :username = placeholder
    // need $user_set to count table rows, so that check_match_query works
    $check_exist_query = 'SELECT COUNT(*) FROM `tbl_user` WHERE user_name =:username';
    $user_set = $pdo->prepare($check_exist_query);
    $user_set->execute(
        array(
            ':username'=>$_SESSION['username']
        )
    );

    if($user_set->fetchColumn()>0){
        //Check if user and password match
        //problems: no-encryption, people could have same user and pass, SQL injection
        $check_match_query = 'SELECT * FROM `tbl_user` WHERE user_name =:username AND user_pass =:password';
        $user_match = $pdo->prepare($check_match_query);
        $user_match->execute(
            array(
                ':username'=>$_SESSION['username'],
                ':password'=>$_SESSION['password']
            )
        );

        // if($user_match->fetchColumn()>0){ => if fetched result is larger than 0 (use if using COUNT(*))
        // FETCH_ASSOC returns each row as an array
        $founduser = $user_match->fetch(PDO::FETCH_ASSOC);
        // $id = $founduser['user_id'];
        $last_login = $founduser['user_last_login'];
    }

    if(isset($_SESSION['last_login'])){
        $_SESSION['last_login'] = $_SESSION['last_login'];
    }else{
        $_SESSION['last_login'] = $last_login;
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
    <!-- <p>Current Session: < ?php echo $_SESSION['login']; ?></p>
    <p>Last Session: < ?php echo $_SESSION['last_login']; ?></p> -->
        <p>Current Session: <?php echo $_SESSION['login']; ?></p>
        <p>Last Session: <?php echo $_SESSION['last_login']; ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>