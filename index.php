<head>
    <title>Musikwünsche | LWS</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <meta http-equiv="refresh" content="60">
    <style>
        body{
            font-family: Roboto;
        }
        .demo-list-item {
        width: 300px;
        }
    </style>
    <?php
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
</head>

<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title">Liedwünsche abgeben</span>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Menü</span>
    <nav class="mdl-navigation">
    <a class="mdl-navigation__link" href="played.php">--> Gespielte Lieder</a>
    <a class="mdl-navigation__link" href="admin.php">--> DJ-Bereich (Privat)</a>
    <p class="mdl-navigation__link">Liedwunschsystem v2.0 by Philipp Stappert</p>
    </nav>
  </div>
  <main class="mdl-layout__content">
    <div class="page-content">
        <br>
        <center>
        
        <!-- Aktuell Spielt -->
        <style>
        .demo-card-event{
          margin-left: 10px;
          margin-right: 20px;
        }
        .demo-card-event.mdl-card {
          width: 215px;
          height: 100px;
          background: #3E4EB8;
        }
        .demo-card-event > .mdl-card__actions {
          border-color: rgba(255, 255, 255, 0.2);
        }
        .demo-card-event > .mdl-card__title {
          align-items: flex-start;
        }
        .demo-card-event > .mdl-card__title > h4 {
          margin-top: 0;
        }
        .demo-card-event > .mdl-card__actions {
          display: flex;
          box-sizing:border-box;
          align-items: center;
        }
        .demo-card-event > .mdl-card__actions > .material-icons {
          padding-right: 10px;
        }
        .demo-card-event > .mdl-card__title,
        .demo-card-event > .mdl-card__actions,
        .demo-card-event > .mdl-card__actions > .mdl-button {
          color: #fff;
        }
        </style>

        <div class="demo-card-event mdl-card mdl-shadow--2dp">
          <div class="mdl-card__title mdl-card--expand">
            <h4>
              <i class="material-icons">headset</i> Aktuell spielt:<br>
              <?php echo $title;?><br>
              von <?php echo $author; ?>
            </h4>
          </div>
        </div>
        <br>


        <!-- Liedwunsch -->
        <p style="margin-left: 10px;">Lust auf ein ganz spezielles Stück? Dann trage es hier ein! Dabei bitte folgendes beachten, dann wird es ganz bestimmt gespielt:</p>
        <ul class="demo-list-item mdl-list" style="margin-left: 10px;">
            <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content">
                    ⦿ Keinen Song doppelt innerhalb von 3 Stunden
                </span>
                <br>
            </li>
            <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content">
                    ⦿ Der Song darf keinen der Anwesenden beleidigen
                </span>
            </li>
        </ul>
        <form action="save.php" method="post" style="margin-left: 10px;">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="name" name="name" required>
            <label class="mdl-textfield__label" for="name">Dein Name...</label>
          </div><br>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="title" name="title" required>
            <label class="mdl-textfield__label" for="title">Titel des Liedes...</label>
          </div><br>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="author" name="author" required>
            <label class="mdl-textfield__label" for="author">Künstler...</label>
          </div><br>
          <input type="submit" value="Wünschen" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
        </form>


      </center>
    </div>
  </main>
</div>
</body>