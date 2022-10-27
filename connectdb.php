<?php
####### Local Host #######################
$server     = "localhost";
$user       = "root";
$pwd        = "";
$dbname     = "cscm";
$connection = mysqli_connect($server, $user, $pwd, $dbname);
$connection->set_charset("utf8");
?>