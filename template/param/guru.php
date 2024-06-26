<?php
include('../config.php');

$classfunction = new Guru();

// if (isset($_GET['param'])) {
    if ($_GET['param'] == 'createGuru') {
        return $classfunction->create(
            $_POST['nip'],
            $_POST['nama'],
            $_POST['alamat'],
            $_POST['telpon'],
            $_POST['jurusan'],
            $_FILES['foto']
        );

    }
    if ($_GET['param'] == 'editGuru') {
        return $classfunction->edit(
            $_POST['id'],
            $_POST['nip'],
            $_POST['nama'],
            $_POST['alamat'],
            $_POST['telpon'],
            $_POST['jurusan'],
            $_FILES['foto']
        );

    }

    if($_GET['param'] == 'deleteGuru') {
        return $classfunction->delete($_POST['id']);
    }

