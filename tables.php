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
        <title>Lista</title>
				<link href="css/homeStyle.css" type="text/css" rel="stylesheet" />
				<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
				<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"> <!--alap-->
				<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css"><!--responsive-->
				<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css"><!--fixhead-->
				<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"><!--custombutton-->
				<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css"><!--select-->
				<!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">-->
				<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="home.php">Coach2Client</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        </nav>
				<div id="layoutSidenav">
					<?php require 'parts/sideNav.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Tables</h1>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Felvitt adatok</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
																			<thead>
														            <tr>
																					<th>ID</th>
														                <th>author</th>
														                <th>maintext</th>
														                <th>reply</th>
														                <th>article</th>
														                <th>commentdate</th>
														            </tr>
														        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
								<!-- Modal -->
								<div id="creatModal" class="modal fade">
									<div class="modal-dialog">
											<div class="modal-content">
												<form class="form-addExEv" action="tableCreat.php" method="post">
														<div class="modal-header">
																<h4 class="modal-title">Eredmények felírása</h4>
																<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
														</div>
														<div class="modal-body">
															<div class="form-group">
																<label for="">Szerő</label>
																<input id="authorC" type="text" name="author" placeholder="Gipsz">
															</div>
															<div class="form-group">
																<label for="">szöveg</label>
																<input id="maintextC" type="text" name="maintext" placeholder="blbabla">
															</div>
															<div class="form-group">
																<label for="">válasz</label>
																<input id="replyC" type="text" name="reply" placeholder="0">
															</div>
															<div class="form-group">
																<label for="">cikk</label>
																<input id="articleC" type="text" name="article" placeholder="színes">
															</div>
														</div>
														<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Bezárás</button>
																<button id="creatSumbit" type="submit" name="creatSumbit" class="btn btn-primary">Létrehozás</button>
														</div>
													</form>
											</div>
									</div>
								</div>
								<!-- Modal -->
								<div id="updateModal" class="modal fade">
									<div class="modal-dialog">
											<div class="modal-content">
												<form class="form-addExEv" action="tableCreat.php" method="post">
														<div class="modal-header">
																<h4 class="modal-title">Eredmények frissítése</h4>
																<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
														</div>
														<div class="modal-body">
															<div class="form-group">
																<label for="">Szerő</label>
																<input id="authorU" type="text" name="author" value="">
															</div>
															<div class="form-group">
																<label for="">szöveg</label>
																<input id="maintextU" type="text" name="maintext" value="">
															</div>
															<div class="form-group">
																<label for="">válasz</label>
																<input id="replyU" type="text" name="reply" value="">
															</div>
															<div class="form-group">
																<label for="">cikk</label>
																<input id="articleU" type="text" name="article" value="">
															</div>
														</div>
														<div class="modal-footer">
																<input id="idU" type="hidden" name="idU" value="">
																<button type="button" class="btn btn-default" data-dismiss="modal">Bezárás</button>
																<button id="updateSubmit" type="submit" name="updateSubmit" class="btn btn-primary">Frissítés</button>
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
				<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="js/homeScripts.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script><!--alap-->
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js" charset="utf-8"></script><!--responsive-->
				<script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js" charset="utf-8"></script><!--fixhead-->
				<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js" charset="utf-8"></script><!--custombutton-->
				<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js" charset="utf-8"></script><!--colVisibility-->
				<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" charset="utf-8"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" charset="utf-8"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" charset="utf-8"></script>
				<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js" charset="utf-8"></script>
				<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js" charset="utf-8"></script>
				<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js" charset="utf-8"></script><!--select-->
				<!--<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js" charset="utf-8"></script>-->
				<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js" charset="utf-8"></script>
        <script src="js/datatables.js"></script>
    </body>
</html>
