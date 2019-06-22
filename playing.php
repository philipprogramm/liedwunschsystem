<?php
session_start();
if ($_SESSION["logged_in"] != true){
    Header("Location: login.php");
}
//GET
$title = $_GET["title"];
$author = $_GET["author"];

if ($_GET["delete"] == "true"){
    file_put_contents("playing.json", "[]");
    die("Alle gespielten Lieder gelöscht.");
    Header("Location: admin.php");
}
//Time
date_default_timezone_set("Europe/Berlin");
$timestamp = time();
$datum = date("d.m.Y",$timestamp);
$uhrzeit = date("H:i",$timestamp);
$time = $uhrzeit . " Uhr";

$databaseraw = file_get_contents("playing.json");
$database = json_decode($databaseraw);
if ($databaseraw != "[]"){
    $pusharray = array("title"=>$title, "author"=>$author, "time"=>$time);
    array_push($database, $pusharray);
    $databaseraw = json_encode($database);
} else {
    $databaseraw = '[{"title":"' . $title . '", "author":"' . $author . '", "time":"' . $time . '"}]';
}

file_put_contents("playing.json", $databaseraw);
Header("Location: admin.php");