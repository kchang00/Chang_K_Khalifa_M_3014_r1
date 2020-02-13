<?php

require_once '../load.php';
session_start();
session_destroy();
redirect_to('index.php');
exit;

?>
