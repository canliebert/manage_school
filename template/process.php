<?php
class user {
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
     
    // Read data
    public function readData_event() {
        $sql = "SELECT * FROM acara ";
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
    public function readData_user() {
        $sql = "SELECT * FROM anggota";
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
    public function readData_product() {
        $sql = "SELECT * FROM produk";
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
    public function read_album() {
        $sql = "SELECT * FROM album";
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
 
    public function register_user($name, $email, $job, $phone, $date, $gambar, $password)
    {
        
        $targetDir = "upload_user/";
        $targetFile = $targetDir . basename($gambar["name"]);
 
    

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if($gambar != null){
            $check = getimagesize($gambar["tmp_name"]);
            if($check !== false){
                echo "file adalah gambar - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "file bukan gambar. ";
                $uploadOk = 1;
            }
        }
        if($gambar["size"] > 100000){
            $check = getimagesize($gambar["tmp_name"]);
                echo "maaf ukuran file terlalu besar";
                $uploadOk = 0;
        }

        if(
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        ) {
            echo "maaf, hanya folder tertentu yang bisa di upload";
            $uploadOk = 0;
        }



        if(move_uploaded_file($gambar["tmp_name"], $targetFile)){
            echo "File" . basename($gambar["name"]) . "file berhasil diunggah . ";
        } else{
            echo "maaf terjadi kesalahan ";

        }

       $sql = "INSERT INTO `anggota` (`id`, `name`, `email`, `job`, `phone`, `date`, `password) VALUES (NULL, '$name', '$email', '$job', '$phone', '$date', '$password')";
        $result = $this->conn->query($sql);
        

        if ($result === true) {
            $_SESSION['message'] = "data added successfully ";
        } else {
            $_SESSION['message'] = "data failed to add" . $this->conn->error;
        }

        return header('location: login.php');

    
    }    // Create data
    public function create_event($nama, $waktu, $gambar, $keterangan, $gambar_name)
    {
        $targetDir = "upload_event/";
        $targetFile = $targetDir . basename($gambar["name"]);

      

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if($gambar != null){
            $check = getimagesize($gambar["tmp_name"]);
            if($check !== false){
                echo "file adalah gambar - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "file bukan gambar. ";
                $uploadOk = 1;
            }
        }
        if($gambar["size"] > 100000){
            $check = getimagesize($gambar["tmp_name"]);
                echo "maaf ukuran file terlalu besar";
                $uploadOk = 0;
        }

        if(
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        ) {
            echo "maaf, hanya folder tertentu yang bisa di upload";
            $uploadOk = 0;
        }



        if(move_uploaded_file($gambar["tmp_name"], $targetFile)){
            echo "File" . basename($gambar["name"]) . "file berhasil diunggah . ";
        } else{
            echo "maaf terjadi kesalahan ";
 
        }

        $gambar_name = $targetFile;


        
        $sql = "INSERT INTO `acara` (`id`, `nama`, `waktu`, `keterangan`, `gambar_name`) VALUES (NULL, '$nama', '$waktu', '$keterangan', '$gambar_name')";
        $result = $this->conn->query($sql);


        if ($result === true) {
            $_SESSION['message'] = "data added successfully ";
        } else {
            $_SESSION['message'] = "data failed to add" . $this->conn->error;
        }
        return header('location: event.php');
    }
    public function create_produk($nama_produk, $desain, $gambar, $about, $jumlah)
    {
        $targetDir = "desain/";
        $targetFile = $targetDir . basename($gambar["name"]);

      

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if($gambar != null){
            $check = getimagesize($gambar["tmp_name"]);
            if($check !== false){
                echo "file adalah gambar - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "file bukan gambar. ";
                $uploadOk = 1;
            }
        }
        if($gambar["size"] > 100000){
            $check = getimagesize($gambar["tmp_name"]);
                echo "maaf ukuran file terlalu besar";
                $uploadOk = 0;
        }

        if(
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        ) {
            echo "maaf, hanya folder tertentu yang bisa di upload";
            $uploadOk = 0;
        }



        if(move_uploaded_file($gambar["tmp_name"], $targetFile)){
            echo "File" . basename($gambar["name"]) . "file berhasil diunggah . ";
        } else{
            echo "maaf terjadi kesalahan ";
 
        }

        $desain = $targetFile;


        
        $sql = "INSERT INTO `produk` (`id`, `nama_produk`, `desain`, `about`, `jumlah`) VALUES (NULL, '$nama_produk', '$desain', '$about', '$jumlah')";
        $result = $this->conn->query($sql);


        if ($result === true) {
            $_SESSION['message'] = "data added successfully ";
        } else {
            $_SESSION['message'] = "data failed to add" . $this->conn->error;
        }
        return header('location: produk.php');
    }


    public function create_user($name, $email, $job, $phone, $date,  $gambar, $password, $data_gambar)
    {
        
        $targetDir = "upload_user/";
        $targetFile = $targetDir . basename($gambar["name"]);

    

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if($gambar != null){
            $check = getimagesize($gambar["tmp_name"]);
            if($check !== false){
                echo "file adalah gambar - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "file bukan gambar. ";
                $uploadOk = 1;
            }
        }
        if($gambar["size"] > 100000){
            $check = getimagesize($gambar["tmp_name"]);
                echo "maaf ukuran file terlalu besar";
                $uploadOk = 0;
        }

        if(
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        ) {
            echo "maaf, hanya folder tertentu yang bisa di upload";
            $uploadOk = 0;
        }



        if(move_uploaded_file($gambar["tmp_name"], $targetFile)){
            echo "File" . basename($gambar["name"]) . "file berhasil diunggah . ";
        } else{
            echo "maaf terjadi kesalahan ";

        }
        $data_gambar = $targetFile;

        $sql = "INSERT INTO `anggota` (`id`, `name`, `email`, `job`, `phone`, `date`, `password`, `data_gambar`) VALUES (NULL, '$name', '$email', '$job', '$phone', '$date', '$password', '$data_gambar')";
        $result = $this->conn->query($sql);

        

        if ($result === true) {
            $_SESSION['message'] = "data added successfully ";
        } else {
            $_SESSION['message'] = "data failed to add" . $this->conn->error;
        }

        return header('location: user.php');

    
    }

    public function add_album($gambar, $path)
    {
        
        $targetDir = "album/";
        $targetFile = $targetDir . basename($gambar["name"]);

    

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if($gambar != null){
            $check = getimagesize($gambar["tmp_name"]);
            if($check !== false){
                echo "file adalah gambar - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "file bukan gambar. ";
                $uploadOk = 1;
            }
        }
        if($gambar["size"] > 100000){
            $check = getimagesize($gambar["tmp_name"]);
                echo "maaf ukuran file terlalu besar";
                $uploadOk = 0;
        }

        if(
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        ) {
            echo "maaf, hanya folder tertentu yang bisa di upload";
            $uploadOk = 0;
        }



        if(move_uploaded_file($gambar["tmp_name"], $targetFile)){
            echo "File" . basename($gambar["name"]) . "file berhasil diunggah . ";
        } else{
            echo "maaf terjadi kesalahan ";

        }

        $path = $targetFile;

        $sql = "INSERT INTO `album` (`id`, `path`) VALUES (NULL, '$path')";
        $result = $this->conn->query($sql);

        

        if ($result === true) {
            $_SESSION['message'] = "data added successfully ";
        } else {
            $_SESSION['message'] = "data failed to add" . $this->conn->error;
        }

        return header('location: album.php');

    
    }
    
    // Search data
    public function search_event($keyword) {    
        $sql = "SELECT * FROM `acara` WHERE `nama` LIKE '%$keyword%' OR `keterangan` LIKE '%$keyword%'";
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
 
    public function search_user($keyword) {    
        $sql = "SELECT * FROM `anggota` WHERE `name` LIKE '%$keyword%' OR `email` LIKE '%$keyword%' OR `job` LIKE '%$keyword%' OR `phone` LIKE '%$keyword%'";
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
    public function search_produk($keyword) {    
        $sql = "SELECT * FROM `produk` WHERE `nama_produk` LIKE '%$keyword%' OR `desain` LIKE '%$keyword%' OR `about` LIKE '%$keyword%'";
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

    // Edit data
    public function getdata_event()
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM acara WHERE id=$id";
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
    public function getdata_produk()
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM produk WHERE id=$id";
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
    public function getdata_user()
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM anggota WHERE id=$id";
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

       public function detail_event()
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM acara WHERE id=$id";
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

    public function edit_event($id, $nama_produk, $desain, $about, $jumlah)
    {
      
        $sql = "UPDATE `acara` SET nama= '$nama_produk', waktu= '$desain', keterangan= '$about', gini='$jumlah' WHERE id=$id";
        $result = $this->conn->query($sql);
        if ($result === true) {
            $_SESSION['message'] = "data updated successfully";
        } else {
            $_SESSION['message'] = "data failed to update" . $this->conn->error;
        }
        return header('location: event.php');

    }
    public function edit_produk($id, $nama_produk, $desain, $about)
    {
      
        $sql = "UPDATE `produk` SET nama_produk= '$nama_produk', desain= '$desain', about= '$about' WHERE id=$id";
        $result = $this->conn->query($sql);
        if ($result === true) {
            $_SESSION['message'] = "data updated successfully";
        } else {
            $_SESSION['message'] = "data failed to update" . $this->conn->error;
        }
        return header('location: produk.php');

    }
    public function edit_user($id, $name, $email, $job, $phone, $date)
    {
        $sql = "UPDATE `anggota` SET name= '$name', email= '$email', job='$job', phone= '$phone', date= '$date' WHERE id=$id";
        $result = $this->conn->query($sql);

        if ($result === true) {
            $_SESSION['message'] = "data updated successfully";
        } else {
            $_SESSION['message'] = "data failed to update" . $this->conn->error;
        }
        return header('location: user.php');

    }

    // Delete data
    public function delete_event($id) {
      
       $id = $_GET['id']; 

        $sql = "DELETE FROM acara WHERE id=$id";
        $result = $this->conn->query($sql);
        if ( $result === true) {
            $_SESSION['message'] = "Data berhasil dihapus";
        } else {
            $_SESSION['message'] = "Gagal menghapus data: " . $this->conn->error;
        }
        return header('location: event.php');
    }
    public function delete_user($id) {
      
        $id = $_GET['id'];

        $sql = "DELETE FROM anggota WHERE id=$id";
        $result = $this->conn->query($sql);
        if ( $result === true) {
            $_SESSION['message'] = "Data berhasil dihapus";
        } else {
            $_SESSION['message'] = "Gagal menghapus data: " . $this->conn->error;
        }
        return header('location: user.php');

    }
    public function delete_produk($id) {
      
        $id = $_GET['id'];

        $sql = "DELETE FROM produk WHERE id=$id";
        $result = $this->conn->query($sql);
        if ( $result === true) {
            $_SESSION['message'] = "Data berhasil dihapus";
        } else {
            $_SESSION['message'] = "Gagal menghapus data: " . $this->conn->error;
        }
        return header('location: produk.php');

    }
    public function delete_album($id) {
      
        $id = $_GET['id'];

        $sql = "DELETE FROM album WHERE id=$id";
        $result = $this->conn->query($sql);
        if ( $result === true) {
            $_SESSION['message'] = "Data berhasil dihapus";
        } else {
            $_SESSION['message'] = "Gagal menghapus data: " . $this->conn->error;
        }
        return header('location: album.php');

    }


    // Login  
    public function login($user, $pass) {
        $sql    = "SELECT * FROM login WHERE user='$user' AND pass='$pass'";
        $result = $this->conn->query($sql);
    
    
        $data = mysqli_fetch_assoc($result);
    
        if (isset($data['pass'])) {
            session_start();
            $_SESSION['data'] = $data;
            $_SESSION['message'] = "Login berhasil di tabel anggota!";
            return header("location:index.php");
        } else{
            return header("location:login.php");
            $_SESSION['message'] = "Login gagal! Password salah di kedua tabel.";
        }
    }

    // Login user
   


 



}
