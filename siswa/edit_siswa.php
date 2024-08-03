<?php 
require_once('../template/config.php');
require('siswa.php');
session_start();

// Ambil data siswa berdasarkan ID
$siswa = new Siswa();
$user = $siswa->get();

if (!$user) {
    $_SESSION['message'] = "Data siswa tidak ditemukan.";
    header('Location: user.php');
    exit();
}

require_once('../template/header.php'); 
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Siswa</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="<?= $main_url ?>index.php">Home</a> / Siswa</li>
        </ol>

        <div class="card">
            <form action="pr_siswa.php?param=edit&id=<?= $user['id'] ?>" method="post" enctype="multipart/form-data">
                <div class="card-header">
                    <span class="fw-bold"><i class="fas fa-square-plus"></i> Edit Siswa</span>
                    <button type="submit" class="btn btn-primary float-end" name="save" style="margin-left: 5px;">Save <i class="fas fa-floppy-disk"></i></button>
                    <button type="reset" class="btn btn-danger float-end" name="reset">Reset <i class="fas fa-rotate-right"></i></button>
                </div>
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-info" role="alert">
                        <?= $_SESSION['message'] ?>
                    </div>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="mb-3 row">
                                <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                                <label for="nis" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-6" style="margin-left: -50px;">
                                    <input type="text" class="form-control border-0 border-bottom" id="nis" name="nis" value="<?= $user['nis'] ?>" maxlength="50" required>
                                    <input type="hidden" class="form-control border-0 border-bottom" id="id" name="id" value="<?= $user['id'] ?>" maxlength="50" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <label for="nama" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-6" style="margin-left: -50px;">
                                    <input type="text" class="form-control border-0 border-bottom" id="nama" name="nama" value="<?= $user['nama'] ?>" maxlength="50" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                                <label for="kelas" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-6" style="margin-left: -50px;">
                                    <input type="text" class="form-control border-0 border-bottom" id="kelas" name="kelas" value="<?= $user['kelas'] ?>" maxlength="50" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <label for="alamat" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-6" style="margin-left: -50px;">
                                    <textarea class="form-control border-0 border-bottom" id="alamat" name="alamat" rows="3" required><?= $user['alamat'] ?></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                                <label for="jurusan" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-6" style="margin-left: -50px;">
                                    <select class="form-select border-0 border-bottom" aria-label="Default select example" id="jurusan" name="jurusan" required>
                                        <option selected><?= $user['jurusan']; ?></option>
                                        <option value="Multimedia">Multimedia</option>
                                        <option value="RPL">RPL</option>
                                        <option value="Akutansi">Akutansi</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-center px-5">
                            <img src="foto_siswa/<?= $user['foto'] ?>" alt="Foto Siswa" class="mb-3" width="40%">
                            <input type="file" name="foto" class="form-control form-control-sm">
                            <input type="hidden" name="foto_lama" value="<?= $user['foto'] ?>">
                        </div>
                    </div>
                </div>
            </form>
        </div> 
    </div>
</main>
<?php require_once('../template/footer.php'); ?>
<?php require_once('../template/param/user.php'); ?>
<?php require_once('../template/config.php'); ?>
