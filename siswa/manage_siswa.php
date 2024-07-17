<?php 
include('siswa.php'); 

$siswa = new Siswa();
$datasiswa = $siswa->read();
include('../template/header.php'); 
?>
 
<div id="layoutSidenav_content ms-auto">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data siswa</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= $main_url;?>index.php">Home</a></li>
                <li class="breadcrumb-item active">Data siswa</li>
                <a type="button" class="btn btn-primary ms-auto tambah" data-bs-toggle="modal" data-bs-target="#formtambah">Tambah User <i class="fa fa-user-plus"></i></a>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    When scrolling, the navigation stays at the top of the page. This is the end of the static navigation demo.
                </div>
            </div>
        </div>
        <div class="row text-center">
            <?php foreach($datasiswa as $siswa): ?>
                <div class="col-xl-3 col-lg-3 col-sm-4 mb-5">
                    <div class="bg-white rounded shadow-sm py-5 px-4">
                        <img src="<?= 'foto_siswa/' . $siswa['foto']; ?>" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                        <h5 class="mb-0"><?= $siswa['nama']; ?></h5>
                        <span class="small text-uppercase text-muted"><?= $siswa['jurusan']; ?></span>
                        <ul class="social mb-0 list-inline mt-3">
                            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-circle-info"></i></a></li>
                            <li class="list-inline-item"><a href="index.php?id=<?= $siswa['id']; ?>" class="social-link ubah" data-bs-toggle="modal" data-bs-target="#formUbah"><i class="fa fa-pen-to-square"></i></a></li>
                            <li class="list-inline-item"><a href="pr_siswa.php?param=delete&id=<?= $siswa['id']; ?>" class="social-link"><i class="fa fa-trash"></i></a></li>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Modal Tambah -->
    <div class="modal fade" id="formtambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Tambah data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="pr_siswa.php?param=create" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="id" name="id">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" id="nama" class="form-control" name="nama" placeholder="input">
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input type="text" id="kelas" class="form-control" name="kelas" placeholder="input">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" id="alamat" class="form-control" name="alamat" placeholder="input">
                        </div>
                        <div class="mb-3">
                            <select class="form-select border-0 border-bottom" aria-label="Default select example" id="jurusan" name="jurusan" required>
                                <option selected>Pilih Jurusan</option>
                                <option value="Multimedia">Multimedia</option>
                                <option value="RPL">RPL</option>
                                <option value="Akutansi">Akutansi</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" id="foto" class="form-control" name="foto">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ubah -->
    <div class="modal fade" id="formUbah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Ubah data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if (isset($_GET['id'])): ?>
                        <?php $detail = $siswa->get($_GET['id']); ?>
                        <form action="pr_siswa.php?param=update" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="id" name="id" value="<?= $detail['id']; ?>">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" id="nama" class="form-control" name="nama" value="<?= $detail['nama']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <input type="text" id="kelas" class="form-control" name="kelas" value="<?= $detail['kelas']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" id="alamat" class="form-control" name="alamat" value="<?= $detail['alamat']; ?>">
                            </div>
                            <div class="mb-3">
                                <select class="form-select border-0 border-bottom" aria-label="Default select example" id="jurusan" name="jurusan" required>
                                    <option selected><?= $detail['jurusan']; ?></option>
                                    <option value="Multimedia">Multimedia</option>
                                    <option value="RPL">RPL</option>
                                    <option value="Akutansi">Akutansi</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" id="foto" class="form-control" name="foto">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../template/footer.php'); ?>
