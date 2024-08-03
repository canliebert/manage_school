<?php
class Guru {
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
        $sql = "SELECT * FROM tb_guru ";
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

    public function create($nip, $nama, $alamat, $telepon, $agama, $foto)
    {
        // Pengecekan NIS
        $cek_nip = $this->conn->query("SELECT * FROM tb_siswa WHERE nip = '$nip'");
        if (mysqli_num_rows($cek_nip) > 0) {
            $_SESSION['message'] = "NIS sudah ada di dalam database.";
            return header('location: edit_guru.php');
        }

        $targetDir = "foto_guru/";
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

                $sql = "INSERT INTO `tb_siswa` (`id`, `nip`, `nama`, `alamat`, `telepon`, `agama`, `foto`, `absen_id`) VALUES (NULL, ?, ?, ?, ?, ?, ?, '1')";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param('ssssss', $nip, $nama, $alamat, $telepon, $agama, $foto_name);

                if ($stmt->execute()) {
                    $_SESSION['message'] = "Data berhasil ditambahkan.";
                } else {
                    $_SESSION['message'] = "Data gagal ditambahkan: " . $this->conn->error;
                }
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file.";
            }
        } else {
            echo "Maaf, file tidak diunggah.";
        }

        return header('location: manage_guru.php');
    }

    public function search($keyword) {    
        $sql = "SELECT * FROM `tb_guru` WHERE `nama` LIKE '%$keyword%' OR `status` LIKE '%$keyword%' OR `nip` LIKE '%$keyword%'";
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
        $sql = "SELECT * FROM tb_guru WHERE id=$id";
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
        return header('location: event.php');

    }

    public function edit($id, $nip, $nama, $alamat, $telepon, $agama, $foto)
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
            $targetDir = "foto_guru/";
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
                        return header('Location: edit_guru.php');
                    }
                } else {
                    $_SESSION['message'] = "File bukan foto.";
                    return header('Location: edit_guru.php');
                }
            }

            // Update data siswa di database
            $sql = "UPDATE `tb_siswa` SET `nip` = ?, `nama` = ?, `alamat` = ?, `telepon` = ?, `agama` = ?, `foto` = ? WHERE `id` = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('ssssssi', $nip, $nama, $alamat, $telepon, $agama, $foto_name, $id);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Data berhasil diperbarui.";
            } else {
                $_SESSION['message'] = "Data gagal diperbarui: " . $this->conn->error;
            }
        } else {
            $_SESSION['message'] = "Data siswa tidak ditemukan.";
        }

        return header('Location: manage_guru.php');
    }

    public function delete($id) {
    
        $id = $_GET['id']; 

        $sql = "DELETE FROM tb_guru WHERE id=$id";
        $result = $this->conn->query($sql);
        if ( $result === true) {
            $_SESSION['message'] = "Data berhasil dihapus";
        } else {
            $_SESSION['message'] = "Gagal menghapus data: " . $this->conn->error;
        }
        return header('location: manage_guru.php');
    }
}

?>