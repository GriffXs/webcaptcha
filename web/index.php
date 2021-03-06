<?php require_once('environment.php');
  $site_key = $_ENV['SITE_KEY'];
  $secret_key = $_ENV['SECRET_KEY'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Junte-se à comunidade brasileira num jogo online de estratégia. Conquiste o topo do rank com suas habilidades e dotes de sobrevivência. Tente se tornar a maior célula da sala e dispute com os restantes jogadores brasileiros. Bem-vindo(a) ao Agar.io Brasil">
    <meta name="keywords" content="agario, agar, io, cell, Brasil, brasil, jogar, agar.io, cells, virus, bacteria, blob, game, games, web game, html5, fun, flash">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="minimal-ui, width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <title>Agario Brasil</title>

    <link id="favicon" rel="icon" type="image/png" href="assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:700" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/index.css" rel="stylesheet">
    <link href="assets/css/gallery.css" rel="stylesheet">

    <script src="assets/js/quadtree.js"></script>
    <script src="assets/js/main_out.js"></script>
</head>

<body>
    <div id="gallery" onclick="if (event.target == this) this.hide()" style="display: none;">
        <div id="gallery-content">
            <div id="gallery-header">Skins</div>
            <div id="gallery-body"></div>
        </div>
    </div>
    <div id="overlays" style="display: none;">
        <div id="helloDialog">
            <div class="form-group">
                <h1 id="title">Agario Brasil</h1>
            </div>

            <div class="form-group">
                <input id="nick" class="form-control" placeholder="Nickname" maxlength="15">
                <input id="skin" class="form-control"  placeholder="Skin Name">
                <select id="gamemode" class="form-control" onchange="setserver(this.value)" required>
                    <option value="34.125.7.192:4443" selected>FFA </option>
					<option value="34.125.7.192:443" selected>Crazy </option>
                </select>
            </div>

            <button id="play-btn" class="btn btn-play btn-primary btn-needs-server" disabled>Jogar</button>
            <button id="spectate-btn" onclick="spectate()" class="btn btn-warning btn-spectate btn-needs-server glyphicon glyphicon-eye-open"></button>
            <button id="gallery-btn" onclick="openSkinsList()" class="btn btn-play btn-primary btn-needs-server btn-info">Skins Gallery</button>
    <?php
      if (isset($_POST['play-btn'])) {
          $response = $_POST['g-recaptcha-response'];
          $payload = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$response);
          $res = json_decode($payload, true);
          if ($res['success'] != 1):
            $error = '✖ Oops! Missing reCAPTCHA validation.'; else:
            $success = '✔ Your message was sent successfully. Thank you!';
          endif;
      }
    ?>
            <html>
            <head>
            <title>reCAPTCHA demo: Simple page</title>
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
            </head>
                <body>
                <form action="?" method="POST">
                    <div class="g-recaptcha" data-sitekey=<?php exho $site_key; ?>
                                             data-callback="recaptcha_callback"></div>
                </form>
                </body>
            </html>

            <script>
            function recaptcha_callback() {
              var playBtn = document.querySelector('#play-btn');
              playBtn.removeAttribute('disabled');
              playBtn.style.cursor = 'pointer';
            }
            </script>

            <div id="settings" class="checkbox">
                <div style="margin: 6px;">
                    <label><input id="showSkins" type="checkbox">Skins</label>
                    <label><input id="showNames" type="checkbox">Names</label>
                    <label><input id="darkTheme" type="checkbox">Dark</label>
                    <label><input id="showColor" type="checkbox">Color</label>
                    <label><input id="showMass" type="checkbox">Mass</label>
                    <label><input id="showChat" type="checkbox">Chat</label>
                    <label><input id="showMinimap" type="checkbox">Minimap</label>
                    <label><input id="showPosition" type="checkbox">Position</label>
                    <label><input id="showBorder" type="checkbox">Border</label>
                    <label><input id="showGrid" type="checkbox">Grid</label>
                    <label><input id="moreZoom" type="checkbox">Zoomout</label>
                    <label><input id="fillSkin" type="checkbox">Fill Skin</label>
                    <label><input id="backgroundSectors" type="checkbox">Background Sectors</label>
                    <label><input id="jellyPhysics" type="checkbox">Jelly Physics</label>
                    <label>
                        <input id="playSounds" type="checkbox">Sounds
                        <input id="soundsVolume" type="range" min="0" max="1" step="any">
                    </label>
                </div>
            </div>

            <div id="instructions">
                <hr>
                <center>
                    <span class="text-muted">
                        Mova o mouse para controlar sua célula<br>
                        Pressione <b>espaço</b> para dividir<br>
                        Pressione <b>W</b> para ejetar alguma massa<br>
                    </span>
                </center>
            </div>

            <hr>
            <div id="footer">
				<a href="https://discord.gg/4j7TzyhgXY"><button style="background: #678ade; border-radius: 6px; padding: 10px; cursor: pointer; color: #fff; border: none; font-size: 16px;">Discord</button></a>
				<a href="https://www.youtube.com/channel/UCj1vhPkXKMUBAh-DkD8-sDg"><button style="background: #ff0000; border-radius: 6px; padding: 10px; cursor: pointer; color: #fff; border: none; font-size: 16px;">Youtube</button></a>
            </div>

        </div>
    </div>

    <div id="connecting">
        <div id="connecting-content">
            <h2>Conectando...</h2>
            <p> Se você não conseguir se conectar aos servidores, verifique se há algum antivírus ou firewall bloqueando a conexão.</p>
        </div>
    </div>

    <div id="mobileStuff" style="display: none;">
        <div id="touchpad"></div>
        <div id="touchCircle" style="display: none;"></div>
        <img src="/assets/img/split.png" id="splitBtn">
        <img src="/assets/img/eject.png" id="ejectBtn">
    </div>

    <canvas id="canvas" width="800" height="600"></canvas>
    <input type="text" id="chat_textbox" placeholder="Press enter to chat" maxlength="200">
    <div style="font-family:'Ubuntu'">&nbsp;</div>
</body>
</html>
