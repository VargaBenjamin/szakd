<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">
                    <div class="small">Üdv,</div>
                    <?=$_SESSION['name']?>
                </div>
                <div class="sb-sidenav-menu-heading">Menü</div>
                <a class="nav-link" href="home.php">
                  <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Irányítópult
                </a>
                <a class="nav-link" href="calendar.php">
                  <div class="sb-nav-link-icon"><i class="fas fa-calendar-day"></i></div>
                    Naptár
                </a>
                <a class="nav-link" href="charts.php">
                  <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Fejlődés
                </a>
                <a class="nav-link" href="table.php">
                  <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Napló
                </a>
                <a class="nav-link" href="blog.php">
                  <div class="sb-nav-link-icon"><i class="fas fa-comment-alt"></i></div>
                    Blog
                </a>
                <a class="nav-link collapsed" href="#" id data-toggle="collapse" data-target="#collapseProfile" aria-expanded="false" aria-controls="collapseLayouts">
                  <div class="sb-nav-link-icon"><i class="fas fa-user-cog"></i></div>
                    Profilom
                  <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseProfile" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                      <a class="nav-link" href="profile.php">
                        Adataim
                      </a>
                    </nav>
                </div>
                <div class="collapse" id="collapseProfile" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                      <a class="nav-link" href="settings.php">
                        Beállítások
                      </a>
                    </nav>
                </div>
                <a class="nav-link" href="parts/logout.php">
                  <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                    Kijelentkezés
                </a>
            </div>
        </div>
    </nav>
</div>
