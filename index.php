<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Coatch2Client</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/indexStyle.css" type="text/css" rel="stylesheet" />

</head>
<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">Coatch2Client</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="login.php">Bejelentkezés</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">Rólunk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#services">Szolgáltatások</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Kapcsolat</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <header class="bg-primary text-white">
    <div class="container text-center">
      <h1>Üdvözöllek a Coatch2Client-en</h1>
      <p class="lead">Egyedi webalkalmazás személyi edzők és vendégei részére</p>
    </div>
  </header>

  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Rólunk</h2>
          <p class="lead">Az alkalmazás segítségével lehetőség nyílik az edző és vendége közötti fal áttörésére:</p>
          <ul>
            <li>Saját felület kialakítása, ahol naplózni tudod eredményeidet, amiket a saját magad személyreszabott felütén tudsz többféle ábrákkal könnyen átlátni,</li>
            <li>Közös naptár az edződdel, ahol egyszerűen tudsz időpontot foglalni hozzá, amit mind a ketten könnyedén átláthattok,</li>
            <li>Modern, szép felületen,</li>
            <li>Telefonon is könnyedén használható.</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section id="services" class="bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Mit ajánlunk?</h2>
          <p class="lead">Ingyenes regisztrálási lehetőséget mindkettőtök számára.</p>
        </div>
      </div>
    </div>
  </section>

  <section id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Lépj kapcsolatba velünk!</h2>
          <p class="lead">Ha bármi kérdésed merül fel, írj nyugodtan, és kollégáink hamarosan jelentkeznek.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-5 bg-dark">
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="js/indexScripts.js"></script>

  <?php
    if (isset($_GET['error']))
    {
      if ($_GET['error'] == 'socialError')
      {
        echo '<div class="alert alert-danger alert-dismissible fixed-top">';
        echo  '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo  '<strong>Figyelem!</strong> Ehhez a közösségi profilhoz nem tartozik felhasználó.';
        echo '</div>';
      }
      if ($_GET['error'] == 'out')
      {
        echo '<div class="alert alert-danger alert-dismissible fixed-top">';
        echo  '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo  '<strong>Figyelem!</strong> Nem vagy bejelentkezve! Kérjük Jelentkezz be!';
        echo '</div>';
      }
    }
  ?>
</body>

</html>
