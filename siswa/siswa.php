<?php
class Siswa {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "db_school";
    private $conn;


    // koneksi
    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function read() {
        $sql = "SELECT * FROM tb_siswa ";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return array(); 
        }     

    }

    public function create($nis, $nama, $kelas, $alamat, $jurusan, $foto)
    {
        // Pengecekan NIS
        $cek_nis = $this->conn->query("SELECT * FROM tb_siswa WHERE nis = '$nis'");
        if (mysqli_num_rows($cek_nis) > 0) {
            $_SESSION['message'] = "NIS sudah ada di dalam database.";
            return header('location: edit_siswa.php');
        }

        $targetDir = "foto_siswa/";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($foto["name"], PATHINFO_EXTENSION));
        $foto_name = hash('sha256', time() . $foto["name"]) . '.' . $imageFileType;  // Membuat nama file unik
        $targetFile = $targetDir . $foto_name;

        if ($foto != null) {
            $check = getimagesize($foto["tmp_name"]);
            if ($check !== false) {
                echo "File adalah foto - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File bukan foto.";
                $uploadOk = 0;
            }
        }

        if ($foto["size"] > 100000) {
            echo "Maaf, ukuran file terlalu besar.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Maaf, hanya file JPG, JPEG, & PNG yang diperbolehkan.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($foto["tmp_name"], $targetFile)) {
                echo "File " . basename($foto["name"]) . " berhasil diunggah.";

                $sql = "INSERT INTO `tb_siswa` (`id`, `nis`, `nama`, `kelas`, `alamat`, `jurusan`, `foto`, `absen_id`) VALUES (NULL, ?, ?, ?, ?, ?, ?, '1')";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param('ssssss', $nis, $nama, $kelas, $alamat, $jurusan, $foto_name);

                if ($stmt->execute()) {
                    $_SESSION['message'] = "Data berhasil ditambahkan.";
                } else {
                    $_SESSION['message'] = "Data gagal ditambahkan: " . $this->conn->error;
                }
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file.";
                return header('location: edit_siswa.php');
            }
        } else {
            echo "Maaf, file tidak diunggah.";
            return header('location: edit_siswa.php');
        }

        return header('location: manage_siswa.php');
    }


    public function search($keyword) {    
        $sql = "SELECT * FROM `user` WHERE `nama` LIKE '%$keyword%' OR `status` LIKE '%$keyword%' OR `username` LIKE '%$keyword%'";
        $result = $this->conn->query($sql);
    
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;   
            } else {
                return array();
            }
        // return header('location: event.php');
    }

    public function get()
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM tb_siswa WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    

    public function edit($id, $nis, $nama, $kelas, $alamat, $jurusan, $foto)
    {
        // Ambil data siswa untuk mendapatkan foto lama
        $sql = "SELECT foto FROM tb_siswa WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $foto_lama = $data['foto'];
            
            $uploadOk = 1;
            $targetDir = "foto_siswa/";
            $foto_name = $foto_lama; // Default to old photo if no new photo uploaded

            if ($foto && $foto['tmp_name']) {
                $imageFileType = strtolower(pathinfo($foto["name"], PATHINFO_EXTENSION));
                $foto_name = hash('sha256', time() . $foto["name"]) . '.' . $imageFileType;  // Membuat nama file unik
                $targetFile = $targetDir . $foto_name;

                $check = getimagesize($foto["tmp_name"]);
                if ($check !== false) {
                    if ($foto["size"] > 1000000) { // Mengubah batas ukuran menjadi 1MB
                        $_SESSION['message'] = "Maaf, ukuran file terlalu besar.";
                        $uploadOk = 0;
                    }

                    if (!in_array($imageFileType, ["jpg", "jpeg", "png"])) {
                        $_SESSION['message'] = "Maaf, hanya file JPG, JPEG, & PNG yang diperbolehkan.";
                        $uploadOk = 0;
                    }

                    if ($uploadOk && move_uploaded_file($foto["tmp_name"], $targetFile)) {
                        // Hapus file foto lama dari direktori jika ada foto baru
                        if ($foto_lama && file_exists($targetDir . $foto_lama)) {
                            unlink($targetDir . $foto_lama);
                        }
                    } else {
                        $_SESSION['message'] = "Maaf, terjadi kesalahan saat mengunggah file.";
                        return header('Location: manage_siswa.php');
                    }
                } else {
                    $_SESSION['message'] = "File bukan foto.";
                    return header('Location: manage_siswa.php');
                }
            }

            // Update data siswa di database
            $sql = "UPDATE `tb_siswa` SET `nis` = ?, `nama` = ?, `kelas` = ?, `alamat` = ?, `jurusan` = ?, `foto` = ? WHERE `id` = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('ssssssi', $nis, $nama, $kelas, $alamat, $jurusan, $foto_name, $id);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Data berhasil diperbarui.";
            } else {
                $_SESSION['message'] = "Data gagal diperbarui: " . $this->conn->error;
            }
        } else {
            $_SESSION['message'] = "Data siswa tidak ditemukan.";
        }

        return header('Location: manage_siswa.php');
    }

    
    

    public function delete($id) {
        // Ambil informasi siswa untuk mendapatkan nama file foto
        $sql_select = "SELECT foto FROM tb_siswa WHERE id = ?";
        $stmt_select = $this->conn->prepare($sql_select);
        $stmt_select->bind_param('i', $id);
        $stmt_select->execute();
        $result_select = $stmt_select->get_result();
        $data = $result_select->fetch_assoc();
    
        if ($data) {
            // Nama file foto
            $foto = $data['foto'];
            $targetFile = "foto_siswa/" . $foto;
    
            // Hapus data siswa dari tabel
            $sql_delete = "DELETE FROM tb_siswa WHERE id = ?";
            $stmt_delete = $this->conn->prepare($sql_delete);
            $stmt_delete->bind_param('i', $id);
            $result_delete = $stmt_delete->execute();
    
            if ($result_delete === true) {
                // Hapus file foto dari direktori
                if (file_exists($targetFile)) {
                    unlink($targetFile);
                }
                $_SESSION['message'] = "Data berhasil dihapus.";
            } else {
                $_SESSION['message'] = "Gagal menghapus data: " . $this->conn->error;
            }
        } else {
            $_SESSION['message'] = "Data siswa tidak ditemukan.";
        }
    
        return header('location: manage_siswa.php');
    }
    
}
?>