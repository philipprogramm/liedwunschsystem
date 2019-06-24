<head>
    <title>Aktuell Spielt...</title>
    <meta http-equiv="refresh" content="10">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <script src="https://code.jquery.com/jquery-latest.js"></script>
</head>
<?php
      //Kiosk-Security
      session_start();
      $_SESSION["logged_in"] = false;
      // Get Playing Song
      try {
      $databaseraw = file_get_contents("playing.json");
      $database = json_decode($databaseraw, true);
      $playing = array_pop($database);
      $title = $playing["title"];
      $author = $playing["author"];
      if ($title == ""){
        if ($author == ""){
          throw new Exception("Keine Songinfos vorhanden.");
        } else {
          throw new Exception("Kein Titel vorhanden.");
        }
      }
      if ($author == ""){
        throw new Exception("Kein Kuenstler vorhanden.");
      }
      } catch (Exception $e){
        if (strpos($e,"Kein Titel vorhanden.")!==false){
          $title = "NICHT VERFÜGBAR";
        } else if (strpos($e,"Kein Kuenstler vorhanden.")!==false){
          $author = "NICHT VERFÜGBAR";
        } else {
          $title = "NICHT VERFÜGBAR";
          $author = "NICHT VERFÜGBAR";
        }
      }
?>
<script>
/* Get the documentElement (<html>) to display the page in fullscreen */
var elem = document.documentElement;

/* View in fullscreen */
function openFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.mozRequestFullScreen) { /* Firefox */
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE/Edge */
    elem.msRequestFullscreen();
  }
}
</script>
<div style="margin-left: -8px; margin-top: -8px; width: 100%; height: 97%; border: none; background-image: linear-gradient(to top, white 0%, black 50%); position:fixed;">
      <div style="color:white;"><center><h1 style="font-size: 350%; margin-top: 50px; font-family: Roboto;">Aktuell läuft:</h1></center></div>
      <div style="color:white;"><center><h2 style="font-size: 250%; margin-top: 50px; font-family: Roboto;"><?php echo $title; ?></h2></center></div>
      <div style="color:white;"><center><h2 style="font-size: 250%; margin-top: 20px; font-family: Roboto;">von <?php echo $author; ?></h2></center></div>
      <center><p style="color: red; font-size: 17px; font-family: Roboto; margin-top: 50px;">Musikwünsche? Hier abgeben: <?php echo $_SERVER["SERVER_NAME"];?></p></center>
      <center><img src="https://api.qrserver.com/v1/create-qr-code/?data=<?php echo $_SERVER["SERVER_NAME"];?>&amp;size=80x80" alt="" title="HELLO" /></center>
      <center><p style="color: black; font-size: 10px;">Liedwunschsystem von Philipp Stappert</p></center>
</div>
<script>
openFullscreen();
</script>