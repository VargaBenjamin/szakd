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
        <title>Post</title>
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
							        <!-- Title -->
							        <h1 class="mt-4">Post Title</h1>
							        <!-- Author -->
							        <p class="lead">
							          by
							          <a href="#">Start Bootstrap</a>
							        </p>
							        <hr>
							        <!-- Date/Time -->
							        <p>Posted on January 1, 2019 at 12:00 PM</p>
							        <hr>
							        <!-- Preview Image -->
							        <img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">
							        <hr>

							        <!-- Post Content -->
							        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p>
							        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>
							        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p>
							        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>
							        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p>
							        <hr>

							        <!-- Comments Form -->
							        <div class="card my-4">
							          <h5 class="card-header">Leave a Comment:</h5>
							          <div class="card-body">
							            <form>
							              <div class="form-group">
							                <textarea class="form-control" rows="3"></textarea>
							              </div>
							              <button type="submit" class="btn btn-primary">Submit</button>
							            </form>
							          </div>
							        </div>

							        <!-- Single Comment -->
							        <div class="media mb-4">
							          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
							          <div class="media-body">
							            <h5 class="mt-0">Commenter Name</h5>
							            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
							          </div>
							        </div>

							        <!-- Comment with nested comments -->
							        <div class="media mb-4">
							          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
							          <div class="media-body">
							            <h5 class="mt-0">Commenter Name</h5>
							            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

							            <div class="media mt-4">
							              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
							              <div class="media-body">
							                <h5 class="mt-0">Commenter Name</h5>
							                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
							              </div>
							            </div>

							            <div class="media mt-4">
							              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
							              <div class="media-body">
							                <h5 class="mt-0">Commenter Name</h5>
							                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
							              </div>
							            </div>
							          </div>
							        </div>
							      </div>
							    </div>
							  </div>
								<?php require 'parts/footer.php'; ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/homeScripts.js"></script>
    </body>
</html>
