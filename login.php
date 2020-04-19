<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Bejelentkezés</title>
 <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css">
 <link rel="stylesheet" type="text/css" href="loginStyle.css">

</head>
<body onload="bejReg()">

    <div id="login-box" class="container-fluid">
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
          <form action="parts/register.php" method="post" autocomplete="off">
            <input type="text" name="username" placeholder="Felhasználónév" id="username" required>
            <input type="email" name="email" placeholder="Email cím" id="email" required>
            <input type="password" name="password" placeholder="Jelszó" id="password" required>
            <input type="password" name="passwordRe" placeholder="Jelszó újra" id="passwordRe" required>
            <input type="checkbox" checked name="role" data-toggle="toggle" data-on="Vendég" data-off="Edző" data-onstyle="info" data-offstyle="warning" data-width="220">
            <input type="submit" value="Regisztrálok!">
          </form>
          <a href="#">Vissza</a>
        </div>
      </div>
      <div class="right-box" >
        <span class="signinwith">Belépés<br/>közösségi fiókjával</span>
        <button class="social google" onclick="window.location.href='callback.php?provider=Google'">Belépés Google-lel</button>
        <button class="social facebook" onclick="window.location.href='callback.php?provider=Facebook'">Belépés Facebookkal</button>
        <button class="social twitter" onclick="window.location.href='callback.php?provider=Twitter'">Belépés Twitterrel</button>
      </div>
      <div class="or">VAGY</div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/loginScripts.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

</body>
</html>
