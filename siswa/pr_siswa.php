<?php
require_once('siswa.php');

$classfunction = new Siswa();

if (isset($_GET['param'])) {
    switch ($_GET['param']) {
        case 'create':
            $classfunction->create(
                $_POST['nis'],
                $_POST['nama'],
                $_POST['kelas'],
                $_POST['alamat'],
                $_POST['jurusan'],
                $_FILES['foto']
            );
            break;
        case 'edit':
            $classfunction->edit(
                $_POST['id'],
                $_POST['nis'],
                $_POST['nama'],
                $_POST['kelas'],
                $_POST['alamat'],
                $_POST['jurusan'],
                $_FILES['foto']
            );
            break;
        case 'delete':
            $classfunction->delete($_POST['id']);
            break;
        case 'search':
            $result = $classfunction->search($_POST['keyword']);
            // Handle the result
            break;
    }
}
?>
