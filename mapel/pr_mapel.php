<?php
require_once('Pelajaran.php');

$classfunction = new Pelajaran();

if (isset($_GET['param'])) {
    switch ($_GET['param']) {
        case 'create':
            $classfunction->create(
                $_POST['pelajaran'],
                $_POST['jurusan'],
                $_POST['guru_id']
            );
            break;
        case 'editPelajaran':
            $classfunction->edit(
                $_POST['id'],
                $_POST['pelajaran'],
                $_POST['jurusan'],
                $_POST['guru_id']
            );
            break;
        case 'deletePelajaran':
            $classfunction->delete($_POST['id']);
            break;
        case 'searchPelajaran':
            $result = $classfunction->search($_POST['keyword']);
            // Handle the result (for example, display it or store it in a session)
            break;
    }
}
?>
