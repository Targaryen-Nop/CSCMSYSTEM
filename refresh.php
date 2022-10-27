<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
$current = date("d/m/Y H:i", strtotime("now"));

$output = array();

$output["login_return"] = " " . $current;

echo json_encode($output);

?>