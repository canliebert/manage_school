<?php
class User {
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
        ob_start(); 
        if (session_status() == PHP_SESSION_NONE) {
            session_start();

        }
    }

    public function read() {
        $sql = "SELECT * FROM tb_user";
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

    public function create($username, $password, $nama, $alamat, $jabatan, $foto)
    {
        $targetDir = "../user/";
        $targetFile = $targetDir . basename($foto["name"]);      

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if ($foto != null) {
            $check = getimagesize($foto["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $_SESSION['message'] = "File bukan foto.";
                $uploadOk = 0;
            }
        }

        if ($foto["size"] > 100000) {
            $_SESSION['message'] = "Maaf ukuran file terlalu besar.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $_SESSION['message'] = "Maaf, hanya folder tertentu yang bisa di-upload.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($foto["tmp_name"], $targetFile)) {
                $_SESSION['message'] = "File " . basename($foto["name"]) . " berhasil diunggah.";
            } else {
                $_SESSION['message'] = "Maaf terjadi kesalahan.";
                return;
            }
        }

        $foto_name = basename($foto["name"]);
        
        $sql = "INSERT INTO `tb_user` (`id`, `username`, `password`, `nama`, `alamat`, `jabatan`, `foto`) 
                VALUES (NULL, '$username', '$password', '$nama', '$alamat', '$jabatan', '$foto_name')";
        $result = $this->conn->query($sql);

        if ($result === true) {
            $_SESSION['message'] = "Data added successfully.";
        } else {
            $_SESSION['message'] = "Data failed to add: " . $this->conn->error;
        }
        header('Location: ../user/add-user.php');
        exit();
    }

    public function search($keyword) {    
        $stmt = $this->conn->prepare("SELECT * FROM tb_user WHERE nama LIKE ? OR jabatan LIKE ? OR username LIKE ?");
        $keyword = "%$keyword%";
        $stmt->bind_param("sss", $keyword, $keyword, $keyword);
        $stmt->execute();
        $result = $stmt->get_result();
    
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
        $stmt = $this->conn->prepare("SELECT * FROM tb_user WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
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

    public function edit($id, $username, $password, $nama, $alamat, $jabatan, $foto)
    {
        if($foto && $foto["name"]) {
            $targetDir = "user/";
            $targetFile = $targetDir . basename($foto["name"]);      
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            if($foto["size"] <= 100000 && ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")) {
                if(move_uploaded_file($foto["tmp_name"], $targetFile)){
                    $foto_name = $targetFile;
                } else{
                    $_SESSION['message'] = "maaf terjadi kesalahan ";
                    return header('location: user.php');
                }
            } else {
                $_SESSION['message'] = "file bukan foto atau ukuran terlalu besar ";
                return header('location: user.php');
            }
        } else {
            $foto_name = null;
        }

        $stmt = $this->conn->prepare("UPDATE tb_user SET username=?, password=?, nama=?, alamat=?, jabatan=?, foto=? WHERE id=?");
        $stmt->bind_param("ssssssi", $username, $password, $nama, $alamat, $jabatan, $foto_name, $id);

        if ($stmt->execute()) {
            $_SESSION['message'] = "data updated successfully";
        } else {
            $_SESSION['message'] = "data failed to update: " . $this->conn->error;
        }
        $stmt->close();
        header('location: user.php');
        exit();
    }

    public function delete($id) {
        $id = $_GET['id']; 
        $stmt = $this->conn->prepare("DELETE FROM tb_user WHERE id=?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Data berhasil dihapus";
        } else {
            $_SESSION['message'] = "Gagal menghapus data: " . $this->conn->error;
        }
        $stmt->close();
        header('location: siswa.php');
        exit();
    }

    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM login WHERE username=? AND password=?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
    
        if ($data) {
            $_SESSION['data'] = $data;
            $_SESSION['message'] = "Login berhasil di tabel anggota!";
            header("location:index.php");
        } else{
            $_SESSION['message'] = "Login gagal! Password salah di kedua tabel.";
            header("location:login.php");
        }
        exit();
    }
}
?>
