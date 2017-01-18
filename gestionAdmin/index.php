<!doctype html>
  <html>
    <head>
      <title>Admin Lapin</title>
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <link rel='stylesheet' href='style/style.css'>
    </head>
    <body>
      <nav>
        <div class='title'>Lapin.org</div>
        <div class='nav'>
          <ul>
            <li>Accueil</li>
            <li>Nouveau</li>
          </ul>
        </div>

      </nav>
      <div class='principal'>
        <?php $data = file_get_contents('http://localhost/lapin.org/api/infoGeneral','r');
        echo var_dump(json_decode($data));?>
      </div>
    </body>
  </html>
