<?php 
include_once('absen.php');

$absen = new Absen_siswa();

if (isset($_GET['param'])) {
    switch ($_GET['param']) {
        case 'hadir_siswa':
            $absen->hadir(
                $_POST['nis'],
                $_POST['nama'],

            );
            break;
    }
}
?>
