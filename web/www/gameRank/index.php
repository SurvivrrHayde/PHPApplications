<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

spl_autoload_register(function ($classname) {
    include "/opt/src/gameRank/$classname.php";
});

$controller = new GameRankController($_GET);
$_SESSION['controller'] = $controller;

$_SESSION['controller']->run();

?>