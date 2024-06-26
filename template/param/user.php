<?php
require_once('../template/function/user.php');

$classfunction = new User();

if (isset($_GET['param'])) {
    switch ($_GET['param']) {
        case 'createUser':
            $classfunction->create(
                $_POST['username'],
                $_POST['password'],
                $_POST['nama'],
                $_POST['alamat'],
                $_POST['jabatan'],
                $_FILES['foto']
            );
            break;
        case 'editUser':
            $classfunction->edit(
                $_POST['id'],
                $_POST['username'],
                $_POST['password'],
                $_POST['nama'],
                $_POST['alamat'],
                $_POST['jabatan'],
                $_FILES['foto']
            );
            break;
        case 'deleteUser':
            $classfunction->delete($_POST['id']);
            break;
        case 'login':
            $classfunction->login($_POST['username'], $_POST['password']);
            break;
    }
}
?>
