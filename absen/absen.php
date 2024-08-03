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
        $sql = "SELECT * FROM tb_siswa, absen_siswa WHERE tb_siswa.absen_id = absen_siswa.absen_id ";
        $result = $this->conn->query($sql);

        var_dump($result);

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
        return header('location: absensi_guru.php');
    }

    public function hadir($nis, $nama) {
        $sql    = "SELECT * FROM tb_siswa WHERE nis='$nis' AND nama='$nama'";
        $result = $this->conn->query($sql);
    
    
        $data = mysqli_fetch_assoc($result);
    
        if (isset($data['nis'])) {
            session_start();
            $_SESSION['data'] = $data;
            $_SESSION['message'] = "Login berhasil di tabel anggota!";
            $sql1 = "UPDATE `tb_siswa` SET `absen_id`='1' WHERE nis =$nis";
            $result = $this->conn->query($sql1);

            return header("location: absensi_siswa.php");

        } else{
            return header("location: ../absen_siswa.php");
            $_SESSION['message'] = "Login gagal! Password salah di kedua tabel.";
        }
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

class Absen_Guru {
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
        $sql = "SELECT * FROM tb_guru, absen_siswa WHERE tb_siswa.absen_id = absen_siswa.absen_id ";
        $result = $this->conn->query($sql);

        var_dump($result);

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
        return header('location: absensi_guru.php');
    }

    public function hadir($nip, $nama) {
        $sql    = "SELECT * FROM tb_guru WHERE nip='$nip' AND nama='$nama'";
        $result = $this->conn->query($sql);
    
    
        $data = mysqli_fetch_assoc($result);
    
        if (isset($data['nis'])) {
            session_start();
            $_SESSION['data'] = $data;
            $_SESSION['message'] = "Hadir";
            $sql1 = "UPDATE `tb_guru` SET `absen_id`='1' WHERE nip =$nip";
            $result = $this->conn->query($sql1);

            return header("location: absensi_siswa.php");

        } else{
            return header("location: ../absen_siswa.php");
            $_SESSION['message'] = "Login gagal! Password salah di kedua tabel.";
        }
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
