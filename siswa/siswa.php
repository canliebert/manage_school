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

    public function create($nama, $kelas, $alamat, $jurusan, $foto)
    {
        $targetDir = "foto_siswa/";
        $targetFile = $targetDir . basename($foto["name"]);      

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if($foto != null){
            $check = getimagesize($foto["tmp_name"]);
            if($check !== false){
                echo "file adalah foto - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "file bukan foto. ";
                $uploadOk = 1;
            }
        }

        if($foto["size"] > 100000){
            $check = getimagesize($foto["tmp_name"]);
                echo "maaf ukuran file terlalu besar";
                $uploadOk = 0;
        }

        if(
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        ) {
            echo "maaf, hanya folder tertentu yang bisa di upload";
            $uploadOk = 0;
        }

        if(move_uploaded_file($foto["tmp_name"], $targetFile)){
            echo "File" . basename($foto["name"]) . "file berhasil diunggah . ";
        } else{
            echo "maaf terjadi kesalahan ";
 
        }

        $foto_name = basename($foto["name"]);
        
        $sql = "INSERT INTO `tb_siswa` (`id`, `nama`, `kelas`, `alamat`, `jurusan`, `foto`) VALUES (NULL, '$nama', '$kelas', '$alamat', '$jurusan', '$foto_name')";
        $result = $this->conn->query($sql);

        if ($result === true) {
            $_SESSION['message'] = "data added successfully ";
        } else {
            $_SESSION['message'] = "data failed to add" . $this->conn->error;
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
        $sql = "SELECT * FROM tb_siswa WHERE id=$id";
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

    public function edit($id, $nama, $kelas, $alamat, $jurusan, $foto)
    {
        $sql = "UPDATE `tb_siswa` SET nama = '$nama', kelas = '$kelas', alamat = '$alamat',  jurusan = '$jurusan', foto= '$foto' WHERE id=$id";
        $result = $this->conn->query($sql);

        if ($result === true) {
            $_SESSION['message'] = "data updated successfully";
        } else {
            $_SESSION['message'] = "data failed to update" . $this->conn->error;
        }
        return header('location: user.php');

    }

    public function delete($id) {
      
        $id = $_GET['id']; 
 
         $sql = "DELETE FROM tb_siswa WHERE id=$id";
         $result = $this->conn->query($sql);
         if ( $result === true) {
             $_SESSION['message'] = "Data berhasil dihapus";
         } else {
             $_SESSION['message'] = "Gagal menghapus data: " . $this->conn->error;
         }
         return header('location: manage_siswa.php');
     }
}
?>