<?php include('../template/header.php'); ?>
<div id="layoutSidenav_content ms-auto">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tables</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrum-item active">Tables</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                    <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DataTable Example
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Pelajaran</th>
                                <th>Jurusan</th>
                                <th>Guru</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Pelajaran</th>
                                <th>Jurusan</th>
                                <th>Guru</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $pelajaran = ["Matematika", "Fisika", "Kimia", "Biologi"];
                            $jurusan = ["IPA", "IPS", "Bahasa"];
                            $guru = ["Budi", "Ani", "Susi", "Agus"];

                            foreach ($pelajaran as $key => $value) {
                                echo "<tr>";
                                echo "<td>{$value}</td>";
                                echo "<td>{$jurusan[$key]}</td>";
                                echo "<td>{$guru[$key]}</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <a type="button" class="btn btn-primary tambah" data-bs-toggle="modal" data-bs-target="#formtambah">Create new</a>
    <!-- Modal -->
    <div class="modal fade" id="formtambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="formModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
        <form action="<?= $main_url; ?>blog/tambah" method="post" enctype="multipart/form-data">
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
                <label for="jurusan" class="form-label">Jurusan</label>
                <input type="text" id="jurusan" class="form-control" name="jurusan" placeholder="input">
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" id="foto" class="form-control" name="foto">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Create</button>
          </div>
        </div>
      </div>
    </div>
</div>
<?php include('../template/footer.php'); ?>
