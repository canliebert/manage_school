<?php 
include('absen.php'); 

$absen_siswa = new Absen_siswa();
$absen = $absen_siswa->read();

// Debugging output untuk memastikan data diambil dengan benar
// var_dump($absen);
?>

<?php include('../template/header.php'); ?>

<div id="layoutSidenav_content ms-auto">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tables</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Tables</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                    <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DataTable Example
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach($absen as $data) : ?>
                                <tr>
                                    <td><?= $data['id']; ?></td>
                                    <td><?= $data['nama']; ?></td>
                                    <td><?= $data['kelas']; ?></td>
                                    <td><?= $data['jurusan']; ?></td>
                                    <td><?= $data['tanggal']; ?></td>
                                    <td><?= $data['status']; ?></td>
                                </tr>
                                
                            <?php endforeach; ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include('../template/footer.php'); ?>
