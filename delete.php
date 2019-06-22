<?php
session_start();
if ($_SESSION["logged_in"] != true){
    Header("Location: login.php");
}
?>
<?php
$delid = $_GET["id"];
unlink("wuensche/" . $delid);
echo $delid;
Header("Location: admin.php");
?>