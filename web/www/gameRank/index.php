<?php
// https://cs4640.cs.virginia.edu/wsd6vn/gameRank/

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

spl_autoload_register(function ($classname) {
    include "/opt/src/gameRank/$classname.php";
});

$controller = new GameRankController($_GET);

$controller->run();

?>