<?php
//blog.php
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
        <title>Blog</title>
				<link href="css/homeStyle.css" type="text/css" rel="stylesheet" />
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
                        <h1 class="mt-4">Blog</h1>
                    </div>
                </main>
							  <div class="container">
							    <div class="row">
							      <div class="col-md-8">
											<?php require 'parts/postLoads.php'; ?>
							        <ul class="pagination justify-content-center mb-4">
							          <li class="page-item">
							            <a class="page-link" href="#">&larr; Older</a>
							          </li>
							          <li class="page-item disabled">
							            <a class="page-link" href="#">Newer &rarr;</a>
							          </li>
							        </ul>
							      </div>
										<div id="createPost" class="col-md-4">
							        <div class="card md-4">
							          <button class="btn btn-secondary" onclick="window.location.href='postCreate.php'" style="position: sticky;">Cikk írása!</button>
							        </div>
							     </div>
							    </div>
									<?php require 'parts/footer.php'; ?>
							  </div>
            </div>
        </div>
				<script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="js/homeScripts.js"></script>
    </body>
</html>
