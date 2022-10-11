<?php
    include 'koneksi.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Mapel</title>
</head>
<body>
    <div class="w-50 mx-auto border p-3 mt-5">
    <a href="index.php">Kembali ke Home</a>
   <form action="add.php" method="post">
    <label for="no">No</label>
    <input type="text" id="no" name="no" class="form-control" required>

    <label for="mapel">Mata Pelajaran</label>
    <select name="mapel" id="mapel" class="form-select" required>
    <option>Pilih Mapel</option>
        <option value="photosop">Photoshop</option>
        <option value="pai">PAI</option>
        <option value="b.imdo">B.Indo</option>
        <option value="matematika">Matematika</option>
        <option value="b.ing">B.Ing</option>
        <option value="senibudaya">Seni Budaya</option>
        <option value="prakarya">Prakarya</option>
        <option value="pjok">Pjok</option>
    </select>

    <label for="no">Semester</label>
    <input type="text" id="semester" name="semester" class="form-control" required>

    <label for="no">Kelas</label>
    <input type="text" id="kelas" name="kelas" class="form-control" required>

    <label for="no">Alokasi Waktu</label>
    <input type="text" id="alokasiwaktu" name="alokasiwaktu" class="form-control" required>

    <input class="btn btn-success mt-3" type="submit" name="tambah" value="Tambah Data">
   </form>
   </div>

<?php

    if (isset($_POST['tambah'])) {

        $no = $_POST['no'];
        $mapel = $_POST['mapel'];
        $semester = $_POST['semester'];
        $kelas = $_POST['kelas'];
        $alokasiwaktu = $_POST['alokasiwaktu'];
    
        $sqlInsert = "INSERT INTO tmapel (no, mapel, semester, kelas, alokasiwaktu)
                      VALUES ('$no','$mapel','$semester','$kelas','$alokasiwaktu')";

        mysqli_query($conn, $sqlInsert);    
        
        header("location: index.php");
    }
?>

</body>
</html>