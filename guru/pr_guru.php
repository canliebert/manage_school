<?php
require_once('Guru.php');

$classfunction = new Guru();

if (isset($_GET['param'])) {
    switch ($_GET['param']) {
        case 'create':
            $classfunction->create(
                $_POST['nip'],
                $_POST['nama'],
                $_POST['alamat'],
                $_POST['telepon'],
                $_POST['agama'],
                $_FILES['foto']
            );
            break;
        case 'editGuru':
            $classfunction->edit(
                $_POST['id'],
                $_POST['nip'],
                $_POST['nama'],
                $_POST['alamat'],
                $_POST['telepon'],
                $_POST['agama'],
                $_FILES['foto']
            );
            break;
        case 'deleteGuru':
            $classfunction->delete($_POST['id']);
            break;
        case 'searchGuru':
            $result = $classfunction->search($_POST['keyword']);
            // Handle the result
            break;
    }
}
?>
