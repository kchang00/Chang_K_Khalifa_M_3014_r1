<?php

require_once '../load.php';
session_start();
if(isset($_SESSION['login'])){
    $_SESSION['last_login'] = $_SESSION['login'];
    unset($_SESSION['login']);
}
// session_destroy();
redirect_to('index.php');
exit;

?>
