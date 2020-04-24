<?php

session_start();
if (!isset($_SESSION['loggedin'])) {
	 header("Location: index.php?error=out");
	 exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Cikk írása</title>
				<link href="css/homeStyle.css" type="text/css" rel="stylesheet" />
				<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
				<script src="vendor/fontAwesome/js/all.min.js" charset="utf-8"></script>
    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="home.php">Coach2Client</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        </nav>
				<div id="layoutSidenav">
						<?php require 'parts/sideNav.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Cikk írása</h1>
                    </div>
                </main>
								<div class="container">
							    <div class="row">
										<div class="col-md-8">
											<form action="parts/postSend.php" method="post" role="form" class="form-horizontal">
												<div class="form-group">
											    <label for="title">Cím</label>
											    <input type="text" class="form-control" name="title" required>
											  </div>
												<div class="form-group">
											    <label for="preview">Előnézeti szöveg</label>
											    <textarea class="form-control" name="preview" rows="3" required></textarea>
											  </div>
												<div class="form-group">
											    <label for="maintext">Szöveg</label>
											    <textarea class="form-control" name="maintext" rows="16" required></textarea>
											  </div>
												<div class="form-group">
											    <label for="picture">Kép URL címe</label>
											    <textarea class="form-control" name="picture" rows="1"></textarea>
											  </div>
												<div class="form-group">
											    <div class="col-sm-offset-2 col-sm-10">
														<input type="submit" class="btn btn-primary" value="Cikk megosztása">
											    </div>
											  </div>
											</form>
										</div>
									</div>
								</div>
		                <?php require 'parts/footer.php'; ?>
            </div>
        </div>
				<script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="js/homeScripts.js"></script>
    </body>
</html>
