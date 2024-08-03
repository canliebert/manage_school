
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion bg-light" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="<?= $main_url ?>index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-house"></i></div>
                        Home
                    </a>
                    <hr class="mb-0">
                    <div class="sb-sidenav-menu-heading">Admin</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Ujian
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?= $main_url ?>layout-static.php">Data Ujian</a>
                            <a class="nav-link" href="<?= $main_url ?>layout-sidenav-light.php">Hasil Ujian</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-check-to-slot"></i></div>
                        Absensi
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?= $main_url ?>absen/absensi_guru.php">Guru</a>
                            <a class="nav-link" href="<?= $main_url ?>absen/absensi_siswa.php">Siswa</a>
                        </nav>
                    </div>
                    <hr class="mb-0">
                    <div class="sb-sidenav-menu-heading">Data</div>
                    <a class="nav-link" href="<?= $main_url ?>guru/manage_guru.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-chalkboard-user"></i></div>
                        Guru
                    </a>
                    <a class="nav-link" href="<?= $main_url ?>siswa/manage_siswa.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Siswa
                    </a>
                    <a class="nav-link" href="<?= $main_url ?>mapel/manage_mapel.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                        Mata pelajaran
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?= "admin"; ?>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">