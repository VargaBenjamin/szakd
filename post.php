<?php
//post.php
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
        <title>Post</title>
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
                        <h1 class="mt-4">Post</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="blog.php">Blog</a></li>
                            <li class="breadcrumb-item active">Post</li>
                        </ol>
                    </div>
                </main>
								<!-- Page Content -->
							  <div class="container">
							    <div class="row">
							      <!-- Post Content Column -->
							      <div class="col-lg-8">
											<?php require 'parts/postLoad.php'; ?>
							        <!-- Comments Form -->
                      <span id="alert"></span>
							        <div class="card my-4">
							          <h5 class="card-header">Hozzászólás írása:</h5>
							          <div class="card-body">
							            <form method="post" id="commentForm">
							              <div class="form-group">
							                <textarea class="form-control" rows="3" name="commentText" id="commentText" required></textarea>
							              </div>
                            <input type="hidden" name="parent" id="parent" value="0" />
                            <input type="hidden" name="title" id="title" value="<?php echo $title; ?>" />
							              <input type="submit" class="btn btn-primary" id="submit" value="Küldés">
							            </form>
							          </div>
							        </div>
							        <div id="display"></div>
							      </div>
							    </div>
							  </div>
								<?php require 'parts/footer.php'; ?>
            </div>
        </div>
				<script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="js/homeScripts.js"></script>
				<script src="js/commentScripts.js"></script>
    </body>
</html>
