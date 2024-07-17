<?php
class Absen_Siswa {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "db_school";
    private $conn;

    // Koneksi
    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function read() {
        $sql = "SELECT absen_siswa.id, absen_siswa.tanggal, absen_siswa.status, tb_siswa.nama, tb_siswa.kelas, tb_siswa.jurusan
                FROM absen_siswa
                INNER JOIN tb_siswa ON absen_siswa.siswa_id = tb_siswa.id";
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
    

    public function create($siswa_id, $tanggal, $status) {
        $sql = "INSERT INTO absen_siswa (siswa_id, tanggal, status) VALUES ('$siswa_id', '$tanggal', '$status')";
        $result = $this->conn->query($sql);

        if ($result === TRUE) {
            $_SESSION['message'] = "Data berhasil ditambahkan";
        } else {
            $_SESSION['message'] = "Data gagal ditambahkan: " . $this->conn->error;
        }
        return header('location: manage_absen.php');
    }

    public function update_status($siswa_id, $tanggal, $status) {
        $sql = "UPDATE absen_siswa SET status = '$status' WHERE siswa_id = '$siswa_id' AND tanggal = '$tanggal'";
        $result = $this->conn->query($sql);

        if ($result === TRUE) {
            $_SESSION['message'] = "Status berhasil diperbarui";
        } else {
            $_SESSION['message'] = "Status gagal diperbarui: " . $this->conn->error;
        }
        return header('location: manage_absen.php');
    }

    public function reset() {
        $sql = "UPDATE absen_siswa SET status = 'belum diisi' WHERE tanggal = CURDATE()";
        $result = $this->conn->query($sql);

        if ($result === TRUE) {
            echo "Data berhasil direset";
        } else {
            echo "Data gagal direset: " . $this->conn->error;
        }
    }

    public function telat() {
        $currentTime = date("H:i:s");
        if ($currentTime > "08:00:00") {
            $sql = "UPDATE absen_siswa SET status = 'tidak hadir' WHERE tanggal = CURDATE() AND status = 'belum diisi'";
            $result = $this->conn->query($sql);

            if ($result === TRUE) {
                echo "Status telat berhasil diupdate";
            } else {
                echo "Status telat gagal diupdate: " . $this->conn->error;
            }
        }
    }
}
?>
