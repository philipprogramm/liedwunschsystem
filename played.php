<head>
    <title>Gespielte Lieder | LWS</title>
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
      <span class="mdl-layout-title">Alle gespielten Lieder</span>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Menü</span>
    <nav class="mdl-navigation">
    <a class="mdl-navigation__link" href="index.php">--> Liedwünsche abgeben</a>
    <a class="mdl-navigation__link" href="admin.php">--> DJ-Bereich (Privat)</a>
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
                    <th class="mdl-data-table__cell--non-numeric">Uhrzeit</th>
                    <th>Titel</th>
                    <th>Künstler</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $databaseraw = file_get_contents("playing.json");
                    $database = json_decode($databaseraw, true);
                    foreach ($database as $song){
                    ?>
                        <tr>
                            <td><?php echo $song["time"];?></td>
                            <td><?php echo $song["title"];?></td>
                            <td><?php echo $song["author"];?></td>
                        </tr>
                    <?php
                    };
                ?>
            </tbody>
        </table>
    </div>
  </main>
</div>
</body>