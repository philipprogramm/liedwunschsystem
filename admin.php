<?php
session_start();
if ($_SESSION["logged_in"] != true){
    Header("Location: login.php");
}
?>
<head>
    <title>Musikwünsche | Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="30">
    <style>
        body{
            font-family: Roboto;
        }
        .demo-list-item {
        width: 300px;
        }
    </style>



</head>

<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title">DJ-Bereich</span>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Menü</span>
    <nav class="mdl-navigation">
    <a class="mdl-navigation__link" href="index.php">--> Liedwünsche abgeben</a>
    <a class="mdl-navigation__link" href="played.php">--> Gespielte Lieder</a>
    <a class="mdl-navigation__link" href="act_playing.php" target="_blank">--> Jetzt-Spielt-Fenster</a>
    <p class="mdl-navigation__link">Liedwunschsystem v2.0 by Philipp Stappert</p>
    </nav>
  </div>
  <main class="mdl-layout__content">
    <div class="page-content">
        <!-- Your content goes here -->
        <br>
        <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp">
            <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">Titel</th>
                    <th class="mdl-data-table__cell--non-numeric">Künstler</th>
                    <th class="mdl-data-table__cell--non-numeric">Gewünscht von</th>
                    <th class="mdl-data-table__cell--non-numeric">Optionen</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $dateien = scandir("wuensche");
                    array_splice($dateien, 0, 2);
                    foreach($dateien as $datei){
                        $datenbankraw = file_get_contents("wuensche/" . $datei);
                        $value = json_decode($datenbankraw, true);
                ?>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric"><?php echo $value[0]["title"];?></td>
                    <td><?php echo $value[0]["author"];?></td>
                    <td><?php echo $value[0]["name"];?></td>
                    <td><a class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" title="Diesen Titel als jetzt spielend setzen" href="playing.php?title=<?php echo $value[0]["title"];?>&author=<?php echo $value[0]["author"];?>"><i class="material-icons">playlist_add_check</i></a><a class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" title="Diesen Titel aus der Wunschliste löschen" href="delete.php?id=<?php echo $datei; ?>"><i class="material-icons">delete_outline</i></a></td>
                </tr>
                <?php
                    };
                ?>
            </tbody>
        </table>
        <br>
        <form action="playing.php" method="get" style="margin-left: 10px;">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="title" name="title" required>
                <label class="mdl-textfield__label" for="title">Aktuell läuft dieser Titel...</label>
            </div><br>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="author" name="author" required>
                <label class="mdl-textfield__label" for="author">Von diesem Künstler...</label>
            </div><br>
            <input type="submit" value="Anzeigen" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" title="Als aktuell spielendes Stück setzen">
        </form>
        <br>
        <button style="margin-left: 10px;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" title="Alle gespielten Lieder aus der Liste löschen" onclick="document.location='playing.php?delete=true'"><i class="material-icons">delete_outline</i> Zurücksetzen</button>
        
    </div>
  </main>
</div>
</body>