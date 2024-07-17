<?php
class Pelajaran {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "db_school";
    private $conn;

    // Koneksi
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
        $sql = "SELECT tb_mapel
        .*, tb_guru.nama as nama_guru FROM tb_mapel
         JOIN tb_guru ON tb_mapel
        .guru_id = tb_guru.id";
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

    public function create($pelajaran, $jurusan, $guru_id)
    {
        $sql = "INSERT INTO `tb_mapel
        ` (`id`, `pelajaran`, `jurusan`, `guru_id`) VALUES (NULL, '$pelajaran', '$jurusan', '$guru_id')";
        $result = $this->conn->query($sql);

        if ($result === true) {
            $_SESSION['message'] = "Data added successfully";
        } else {
            $_SESSION['message'] = "Data failed to add: " . $this->conn->error;
        }
        return header('location: manage_mapel.php');
    }

    public function search($keyword) {
        $sql = "SELECT tb_mapel
        .*, tb_guru.nama as nama_guru FROM tb_mapel
         JOIN tb_guru ON tb_mapel
        .guru_id = tb_guru.id WHERE tb_mapel
        .pelajaran LIKE '%$keyword%' OR tb_mapel
        .jurusan LIKE '%$keyword%' OR tb_guru.nama LIKE '%$keyword%'";
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

    public function get()
    {
        $id = $_GET['id'];
        $sql = "SELECT tb_mapel
        .*, tb_guru.nama as nama_guru FROM tb_mapel
         JOIN tb_guru ON tb_mapel
        .guru_id = tb_guru.id WHERE tb_mapel
        .id=$id";
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

    public function edit($id, $pelajaran, $jurusan, $guru_id)
    {
        $sql = "UPDATE `tb_mapel
        ` SET pelajaran = '$pelajaran', jurusan = '$jurusan', guru_id = '$guru_id' WHERE id=$id";
        $result = $this->conn->query($sql);

        if ($result === true) {
            $_SESSION['message'] = "Data updated successfully";
        } else {
            $_SESSION['message'] = "Data failed to update: " . $this->conn->error;
        }
        return header('location: manage_mapel.php');
    }

    public function delete($id) {
        $id = $_GET['id'];

        $sql = "DELETE FROM tb_mapel
         WHERE id=$id";
        $result = $this->conn->query($sql);
        if ($result === true) {
            $_SESSION['message'] = "Data berhasil dihapus";
        } else {
            $_SESSION['message'] = "Gagal menghapus data: " . $this->conn->error;
        }
        return header('location: manage_mapel.php');
    }
}
?>
