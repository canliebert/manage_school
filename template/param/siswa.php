<?php
include('../config.php');

$classfunction = new Siswa();

// if (isset($_GET['param'])) {
    if ($_GET['param'] == 'createSiswa') {
        return $classfunction->create(
            $_POST['nama'],
            $_POST['kelas'],
            $_POST['alamat'],
            $_POST['jurusan'],
            $_FILES['foto']
        );

    }
    if ($_GET['param'] == 'editSiswa') {
        return $classfunction->edit(
            $_POST['id'],
            $_POST['nama'],
            $_POST['kelas'],
            $_POST['alamat'],
            $_POST['jurusan'],
            $_FILES['foto']
        );

    }

    if($_GET['param'] == 'deleteSiswa') {
        return $classfunction->delete($_POST['id']);
    }

