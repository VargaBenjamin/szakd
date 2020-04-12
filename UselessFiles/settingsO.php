<?php

session_start();
if (!isset($_SESSION['loggedin'])) {
	 header("Location: http://localhost/ownfcv/index.php?error=out");
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
        <title>Beállítások</title>
        <link href="css/homeStyle.css" rel="stylesheet" />
				<link href="css/profileStyle.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="home.php">Beállítások</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        </nav>
				<div id="layoutSidenav">
						<?php require 'parts/sideNav.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Beállítások</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="home.php">Profilom</a></li>
                            <li class="breadcrumb-item active">Beállítások</li>
                        </ol>
                    </div>
                </main>
								<div class="container bootstrap snippets">
								<div class="row">
								  <div class="col-xs-12 col-sm-9">
								    <form class="form-horizontal">
								      <div class="panel panel-default">
								        <div class="panel-heading">
								        <h4 class="panel-title">User info</h4>
								        </div>
								        <div class="panel-body">
								          <div class="form-group">
								            <label class="col-sm-2 control-label">Location</label>
								            <div class="col-sm-10">
								              <select class="form-control">
								                <option selected="">Select country</option>
								                <option>Belgium</option>
								                <option>Canada</option>
								                <option>Denmark</option>
								                <option>Estonia</option>
								                <option>France</option>
								              </select>
								            </div>
								          </div>
								          <div class="form-group">
								            <label class="col-sm-2 control-label">Company name</label>
								            <div class="col-sm-10">
								              <input type="text" class="form-control">
								            </div>
								          </div>
								          <div class="form-group">
								            <label class="col-sm-2 control-label">Position</label>
								            <div class="col-sm-10">
								              <input type="text" class="form-control">
								            </div>
								          </div>
								        </div>
								      </div>

								      <div class="panel panel-default">
								        <div class="panel-heading">
								        <h4 class="panel-title">Contact info</h4>
								        </div>
								        <div class="panel-body">
								          <div class="form-group">
								            <label class="col-sm-2 control-label">Work number</label>
								            <div class="col-sm-10">ownfcv
								              <input type="tel" class="form-control">
								            </div>
								          </div>
								          <div class="form-group">
								            <label class="col-sm-2 control-label">Mobile number</label>
								            <div class="col-sm-10">
								              <input type="tel" class="form-control">
								            </div>
								          </div>
								          <div class="form-group">
								            <label class="col-sm-2 control-label">E-mail address</label>
								            <div class="col-sm-10">
								              <input type="email" class="form-control">
								            </div>
								          </div>
								          <div class="form-group">
								            <label class="col-sm-2 control-label">Work address</label>
								            <div class="col-sm-10">
								              <textarea rows="3" class="form-control"></textarea>
								            </div>
								          </div>
								        </div>
								      </div>

								      <div class="panel panel-default">
								        <div class="panel-heading">
								        <h4 class="panel-title">Security</h4>
								        </div>
								        <div class="panel-body">
								          <div class="form-group">
								            <label class="col-sm-2 control-label">Current password</label>
								            <div class="col-sm-10">
								              <input type="password" class="form-control">
								            </div>
								          </div>
								          <div class="form-group">
								            <label class="col-sm-2 control-label">New password</label>
								            <div class="col-sm-10">
								              <input type="password" class="form-control">
								            </div>
								          </div>
								          <div class="form-group">
								            <div class="col-sm-10 col-sm-offset-2">
								              <div class="checkbox">
								                <input type="checkbox" id="checkbox_1">
								                <label for="checkbox_1">Make this account public</label>
								              </div>
								            </div>
								          </div>
								          <div class="form-group">
								            <div class="col-sm-10 col-sm-offset-2">
								              <button type="submit" class="btn btn-primary">Submit</button>
								              <button type="reset" class="btn btn-default">Cancel</button>
								            </div>
								          </div>
								        </div>
								      </div>
								    </form>
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
