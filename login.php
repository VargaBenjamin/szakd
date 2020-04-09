<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Bejelentkezés</title>
  <link href="css/loginStyle.css" rel="stylesheet">
</head>
<body onload="bejReg()">

    <div id="login-box">
      <div class="left-box">
        <div class="login">
          <h1> Belépés</h1>
          <form action="parts/authenticate.php" method="post">
            <input type="text" name="username" placeholder="Felhasználónév" id="username" required>
            <input type="password" name="password" placeholder="Jelszó" id="password" required>
            <input type="submit" value="Belépek!">
          </form>
          <p>Nincs még felhasználód?</p> <a href="#">Regisztrálj!</a>
        </div>
        <div class="register">
          <h1> Regisztrálás</h1>
          <form action="register.php" method="post" autocomplete="off">
            <input type="text" name="username" placeholder="Felhasználónév" id="username" required>
            <input type="email" name="email" placeholder="Email cím" id="email" required>
            <input type="password" name="password" placeholder="Jelszó" id="password" required>
            <input type="password" name="passwordRe" placeholder="Jelszó újra" id="passwordRe" required>
            <input type="submit" value="Regisztrálok!">
          </form>
          <a href="#">Vissza</a>
        </div>
      </div>
      <div class="right-box" style="background-image: url(img/loginImg.jpg);">
        <span class="signinwith">Belépés<br/>közösségi fiókjával</span>
        <button class="social google" onclick="window.location.href='callback.php?provider=Google'">Belépés Google-lel</button>
        <button class="social facebook" onclick="window.location.href='callback.php?provider=Facebook'">Belépés Facebookkal</button>
        <button class="social twitter" onclick="window.location.href='callback.php?provider=Twitter'">Belépés Twitterrel</button>
      </div>
      <div class="or">VAGY</div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="js/loginScripts.js"></script>
</body>
</html>
