<?php 
session_start();
?>
<?php require_once('../template/header.php'); ?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Add Data School</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="<?= $main_url ?>index.php">Home</a> / School</li>
            </ol>

            <div class="card">
                <form action="add-user.php?param=createUser" method="post" enctype="multipart/form-data">
                <div class="card-header p-3">
                    <span class="fw-bold"><i class="fas fa-square-plus"></i> Add School</span>
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
                        <div class="col-4 text-center px-5">
                            <img src="" alt="" class="mb-3" width="40%">
                            <input type="file" name="foto" class="form-control form-control-sm"> 
                        </div>
                        <div class="col-8">
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 col-form-label">nama</label>
                                <label for="nama" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-6" style="margin-left: -50px;">
                                    <input type="text" class="form-control border-0 border-bottom" id="nama" name="nama" maxlength="20" required>
                                </div>
                            </div>  
                            <div class="mb-3 row">
                                <label for="email" class="col-sm-2 col-form-label">email</label>
                                <label for="email" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-6" style="margin-left: -50px;">
                                    <input type="text" class="form-control border-0 border-bottom" id="email" name="email" maxlength="20" required>
                                </div>
                            </div>  
                            <div class="mb-3 row">
                                <label for="status" class="col-sm-2 col-form-label">Status</label>
                                <label for="status" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-6" style="margin-left: -50px;">
                                    <select class="form-select border-0 border-bottom" aria-label="Default select example" name="Akrditasi" required>
                                        <option selected>Pilih status</option>
                                        <option value="Negeri">Negeri</option>
                                        <option value="Swasta">Swasta</option>
                                        <option value="Staff">C</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="Akreditasi" class="col-sm-2 col-form-label">Akreditasi</label>
                                <label for="Akreditasi" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-6" style="margin-left: -50px;">
                                    <select class="form-select border-0 border-bottom" aria-label="Default select example" name="Akrditasi" required>
                                        <option selected>Pilih Akreditasi</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="V">C</option>
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
                            <div class="mb-3 row">
                                <label for="visimisi" class="col-sm-2 col-form-label">Visi dan Misi</label>
                                <label for="visimisi" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-6" style="margin-left: -50px;">
                                    <textarea name="visimisi" id="visimisi" cols="30" rows="3" placeholder="Domisili" required></textarea>
                                </div>
                            </div>
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
