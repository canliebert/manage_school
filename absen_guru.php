<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Daftar Hadir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        h1 {
            color: #343a40;
            margin-bottom: 20px;
        }
        .form-label {
            color: #495057;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s, border-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Form Daftar Hadir</h1>
        <form action="absensi.php" method="POST">
        <p class="">masukkan no nip untuk isi kehadiran</p>
            <div class="col-lg-4 text-center mb-3">
                <label for="nip" class="form-label text-center">NIP Guru</label>
                
                <input type="text" class="form-control text-center" id="nip" name="nip" required>
            </div>
            <button type="submit" class="btn btn-primary text-center">Submit</button>
        </form>
    </div>
</body>
</html>
