<?php 
session_start();
?>
<?php require_once('../template/header.php'); ?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Add User</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="<?= $main_url ?>index.php">Home</a> / User</li>
            </ol>

            <div class="card">
                <form action="add-user.php?param=createUser" method="post" enctype="multipart/form-data">
                <div class="card-header">
                    <span class="fw-bold"><i class="fas fa-square-plus"></i> Add User</span>
                    <button type="submit" class="btn btn-primary float-end " name="save" style="margin-left: 5px;">save <i class="fas fa-floppy-disk"></i></button>
                    <button type="reset" class="btn btn-danger float-end " name="reset" >reset <i class="fas fa-rotate-right"></i></button>
                </div>
                <?php if (isset($_SESSION['message'])) {
                        echo '<div class="alert alert-info" role="alert">';
                        echo $_SESSION['message'];
                        echo '</div>';
                        unset($_SESSION['message']); // Hapus pesan setelah ditampilkan
                        }
                    ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="mb-3 row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <label for="name" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-6" style="margin-left: -50px;">
                                    <input type="text" class="form-control border-0 border-bottom" id="name" name="nama" maxlength="20" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <label for="username" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-6" style="margin-left: -50px;">
                                    <input type="text" class="form-control border-0 border-bottom" id="username" name="username" maxlength="20" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <label for="password" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-6" style="margin-left: -50px;">
                                    <input type="password" class="form-control border-0 border-bottom" id="password" name="password" maxlength="20" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jabatan" class="col-sm-2 col-form-label">Status</label>
                                <label for="jabatan" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-6" style="margin-left: -50px;">
                                    <select class="form-select border-0 border-bottom" aria-label="Default select example" name="jabatan" required>
                                        <option selected>Pilih Jabatan</option>
                                        <option value="Guru">Guru</option>
                                        <option value="Siswa">Siswa</option>
                                        <option value="Staff">Staff</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="alamat" class="col-sm-2 col-form-label">Address</label>
                                <label for="alamat" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-6" style="margin-left: -50px;">
                                    <textarea name="alamat" id="alamat" cols="30" rows="3" placeholder="Domisili" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-center px-5">
                            <img src="" alt="" class="mb-3" width="40%">
                            <input type="file" name="foto" class="form-control form-control-sm"> 
                        </div>
                    </div>
                </div>
            </form>
            </div> 
    </div>
</main>
<?php require_once('../template/footer.php');?>
<?php require_once('../template/param/user.php');?>
<?php require_once('../template/config.php');?>
