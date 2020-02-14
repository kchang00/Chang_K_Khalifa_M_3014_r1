<?php 
    session_start();
    require_once '../load.php';
    // $_ALLCAPS => format for a built in PHP variable
    $reqtime = date("Y-m-d H:i:s");

    if(isset($_POST['submit'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if(!empty($username) && !empty($password)){
            //Login (login = function)
            // once the user presses submit and the login succeeds, record the time
            $_SESSION['login'] = $reqtime;
            $message = login($username, $password, $reqtime);
        }else{
            $message = 'Please fill out the required fields';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In</title>
</head>
<body>
    <!-- only checked once the message is sent - if empty, display message -->
    <!-- shorthand if else statement -->
    <?php echo !empty($message)?$message:''; ?>
    <form action="index.php" method="post">
        <label>Username</label><br>
        <input type="text" name="username" value=""/><br>
        <label>Password:</label><br>
        <input type="password" name="password" value=""/><br>
        <button name="submit">Submit</button>
    </form>
    <a href="../index.php">Go Back Home</a>
</body>
</html>