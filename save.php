<?php
session_start();
if ($_SESSION["logged_in"] != true){
    Header("Location: login.php");
}
?>
<?php
date_default_timezone_set("Europe/Berlin");
$timestamp = time();
$datum = date("m-d-Y",$timestamp);
$uhrzeit = date("H-i-s",$timestamp);
$time = $datum ."_" .$uhrzeit;

$name = $_POST["name"];
$title = $_POST["title"];
$author = $_POST["author"];

$database = [];
$pusharray = array("name"=>$name, "title"=>$title, "author"=>$author, "time"=>$time);

array_push($database, $pusharray);

$databaseraw = json_encode($database);
file_put_contents("wuensche/" . $time . ".json", $databaseraw);
echo "Wunsch gespeichert!";
?>
<br>
<a href="index.php" style="font-size: 300%;">Zurück</a>