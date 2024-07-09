<?php 
$mysql = new mysqli("MySQL-8.0", "root", "", "dbkin"); 
$mysql->query("SET NAMES 'utf8'");

session_start();
if(isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
}

$ids = $_REQUEST['ids'];
$ids = explode(",", $ids);
$ids = "'" . implode("','", $ids) . "'";
$mysql->query("UPDATE film SET email = '$email' WHERE id IN ($ids)");
