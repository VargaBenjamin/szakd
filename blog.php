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
        <title>Blog</title>
        <link href="css/homeStyle.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="home.php">Coact2Client</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
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
							        <div class="card mb-4">
							          <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
							          <div class="card-body">
							            <h2 class="card-title">Post Title</h2>
							            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
							            <a href="post.php" class="btn btn-primary">Read More &rarr;</a>
							          </div>
							          <div class="card-footer text-muted">
							            Posted on January 1, 2017 by
							            <a href="#">Start Bootstrap</a>
							          </div>
							        </div>
											<div class="card mb-4">
							          <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
							          <div class="card-body">
							            <h2 class="card-title">Post Title</h2>
							            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
							            <a href="post.php" class="btn btn-primary">Read More &rarr;</a>
							          </div>
							          <div class="card-footer text-muted">
							            Posted on January 1, 2017 by
							            <a href="#">Start Bootstrap</a>
							          </div>
							        </div>
							        <ul class="pagination justify-content-center mb-4">
							          <li class="page-item">
							            <a class="page-link" href="#">&larr; Older</a>
							          </li>
							          <li class="page-item disabled">
							            <a class="page-link" href="#">Newer &rarr;</a>
							          </li>
							        </ul>
							      </div>
							     </div>
							    </div>
									<?php require 'parts/footer.php'; ?>
							  </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/homeScripts.js"></script>
    </body>
</html>
