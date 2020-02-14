<?php
function login($username, $password, $reqtime){
    // sprint = like print, but returns a string
    // return sprintf('You are trying username=>%s, password=>%s', $username, $password);

    $pdo = Database::getInstance()->getConnection();

    //Check existence
    // with the username = $username => direct user input
    // :username = placeholder
    // need $user_set to count table rows, so that check_match_query works
    $check_exist_query = 'SELECT COUNT(*) FROM `tbl_user` WHERE user_name =:username';
    $user_set = $pdo->prepare($check_exist_query);
    $user_set->execute(
        array(
            ':username'=>$username
        )
    );

    if($user_set->fetchColumn()>0){
        //Check if user and password match
        //problems: no-encryption, people could have same user and pass, SQL injection
        $check_match_query = 'SELECT * FROM `tbl_user` WHERE user_name =:username AND user_pass =:password';
        $user_match = $pdo->prepare($check_match_query);
        $user_match->execute(
            array(
                ':username'=>$username,
                ':password'=>$password
            )
        );

        // if($user_match->fetchColumn()>0){ => if fetched result is larger than 0 (use if using COUNT(*))
        // FETCH_ASSOC returns each row as an array
       while($founduser = $user_match->fetch(PDO::FETCH_ASSOC)){
           $id = $founduser['user_id'];
            // before update, keep the value of the last current login from sessions
           // TODO Update user_tbl and set the user_last_login column to be :lastlogin
            $check_match_query = 'UPDATE `tbl_user` SET user_current_login = :currentlogin WHERE user_id = :id';

            $user_match = $pdo->prepare($check_match_query);
            $user_match->execute(
                array(
                    ':id'=>$id,
                    ':currentlogin'=>$reqtime
                )
            );
       }

       if(isset($id)){
            // calling upon redirect function in scripts/functions.php
            redirect_to('dashboard.php');
            return 'Logged in yay';
        }else{
            // return values being passed into $messages in signup.php
            $_SESSION['attempts']++;
            $_SESSION['attempts_left'] = (4 - $_SESSION['attempts']);
            if ($_SESSION['attempts_left'] > 0) {
                return 'Incorrect password. Attempts left: '. $_SESSION['attempts_left'];
            }else{
                redirect_to('blocked.php');
            }
        }
     }else{
        return 'User does not exist.';
     }      
}