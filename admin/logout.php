<?php
    session_start();
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
        while($founduser = $user_match->fetch(PDO::FETCH_ASSOC)){
            $id = $founduser['user_id'];
            $current_login = $founduser['user_current_login'];
            $check_match_query = 'UPDATE `tbl_user` SET user_last_login = :currentlogin WHERE user_id = :id';
            $user_match = $pdo->prepare($check_match_query);
            $user_match->execute(
                array(
                    ':id'=>$id,
                    ':currentlogin'=>$current_login
                )
            );
        }  
    }

    if(isset($_SESSION['login'])){
        // sets last_login to last current login
        $_SESSION['last_login'] = $_SESSION['login'];
        // Clears login value
        unset($_SESSION['login']);
        // Clears attempts value
        unset($_SESSION['attempts']);
        // Sets attempts value to 0
        // clears user and pass
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        $_SESSION['attempts'] = 0;
    }

    // session_destroy();
    redirect_to('index.php');
    exit;

?>
