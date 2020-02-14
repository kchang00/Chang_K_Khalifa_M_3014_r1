<?php

require_once '../load.php';
session_start();
if(isset($_SESSION['login'])){
    // sets last_login to last current login
    $_SESSION['last_login'] = $_SESSION['login'];
    // Clears login value
    unset($_SESSION['login']);
    // Clears attempts value
    unset($_SESSION['attempts']);
    // Sets attempts value to 0
    $_SESSION['attempts'] = 0;
}
// session_destroy();
redirect_to('index.php');
exit;

?>
