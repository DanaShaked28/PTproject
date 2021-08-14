<?php

    require_once('Include/init.php');
    global $session;

    $session->logout();
    header('Location: index.php');

?>