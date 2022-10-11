<?php
include '../config/conn.php';

// jika tombol simpan diklik
if (isset($_POST['bsimpan'])) {
    // pengujian apakah data akan diedit atau disimpan baru
    if (isset($_GET['hal']) == "edit") {
        // data akan diedit
        $edit = mysqli_query($conn, "UPDATE tmapel SET
                                               nama_mapel = '$_POST[tnama_mapel]', 
                                               kode = '$_POST[tkode]'
                                        WHERE id = '$_GET[id]'
                                        ");
        //uji jika edit data sukses
        if ($edit) {
            echo "<script>
           alert('edit data Sukses!');
           document.location='index.php';
        </script>";
        } else {
            echo "<script>
            alert('edit data Gagal!');
             document.location='index.php';
         </script>";
        }
    } else {
        // data akan disimpan baru
        $simpan = mysqli_query($conn, " INSERT INTO tmapel (nama_mapel, kode)
                                        VALUE ( '$_POST[tnama_mapel]',
                                                '$_POST[tkode]')  
                                        ");
        //uji jika simpan data sukses
        if ($simpan) {
            echo "<script>
                alert('Simpan data Sukses!');
                document.location='index.php';
                </script>";
        } else {
            echo "<script>
                alert('Simpan data Gagal!');
                document.location='index.php';
                </script>";
        }
    }
}

// deklarasi variabel untuk menampung data yang akan diedit
$vid = "";
$vnama_mapel = "";
$vkode = "";






// pengujian jika tombol edit / hapus diklik
if (isset($_GET['hal'])) {

    // pengujian jika edit data
    if ($_GET['hal'] == "edit") {

        // tampilkan data yang akan diedit
        $tampil = mysqli_query($conn, "SELECT * FROM tmapel WHERE id = '$_GET[id]' ");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            // jika data ditemukan maka, data ditampung ke dalam divariabel
            $vid = $data['id'];
            $vnama_mapel = $data['nama_mapel'];
            $vkode = $data['kode'];
        }
    } else if ($_GET['hal'] == "hapus") {
        // persiapan hapus data
        $hapus = mysqli_query($conn, "DELETE FROM tmapel WHERE id = '$_GET[id]' ");
        //uji jika hapus data sukses
        if ($hapus) {
            echo "<script>
            alert('Hapus data Sukses!');
            document.location='index.php';
            </script>";
        } else {
            echo "<script>
            alert('Hapus data Gagal!');
            document.location='index.php';
            </script>";
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mapel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- navigasi -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">SMK Penerbangan Angkasa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-right" id="navbarText">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/PKL/september2022/web%20sekolah/crud2022/login.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PKL/september2022/web sekolah/mapel/index.php">Mapel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PKL/september2022/web sekolah/crud2022/index.php">Data Guru</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PKL/september2022/web%20sekolah/index.html">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <br>
    <br>

    <!-- awal container -->
    <div class="container">
        <!-- awal row -->
        <div class="row">
            <!-- awal col -->
            <div class="col-md-8 mx-auto">
                <!-- awal card -->
                <div class="card">
                    <div class="card-header bg-dark text-light">
                        Form Input Mapel
                    </div>
                    <div class="card-body">
                        <!-- awal form -->
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Nama Mapel</label>
                                <input type="text" name="tnama_mapel" value="<?= $vnama_mapel ?>" class="form-control" placeholder="Masukan Nama Mapel">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kode Mapel</label>
                                <input type="text" name="tkode" value="<?= $vkode ?>" class="form-control" placeholder="Masukan Kode Mapel">
                            </div>

                            <div class="text-center">
                                <hr>
                                <button class="btn btn-primary" name="bsimpan" type="submit">Simpan</button>
                                <button class="btn btn-danger" name="bkosongkan" type="reset">Kosongkan</button>
                            </div>

                    </div>

                        </form>
                        <!-- akhir form -->
                    </div>
                    <div class="card-footer bg-dark">

                    </div>
                </div>
                <!-- akhir card -->
            </div>
            <!-- akhir col -->
        </div>
        <!-- akhir row -->

        <!-- awal card -->
        <div class="col-md-8 mx-auto">
        <div class="card mt-3">
            <div class="card-header bg-dark text-light">
                Matapelajaran
            </div>
            <div class="card-body">
                <div class="col-md-6 mx-auto">
                    <form method="POST">
                        <div class="input-group mb-3">
                            <input type="text" name="tcari" class="form-control" placeholder="Masukan kata kunci">
                            <button class="btn btn-primary" value="<?= @$_POST['tcari'] ?>" name="bcari" type="submit">Cari</button>
                            <button class="btn btn-danger" name="breset" type="submit">Reset</button>
                        </div>
                    </form>

                </div>
                <table class="table table-striped table-hover table-bordered">
                    <tr>
                        <th>No.</th>
                        <th>Nama Mapel</th>
                        <th>Kode</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    // persiapan menampilkan data
                    $no = 1;
                    // untuk pencarian data
                    // jika tombol cari diklik
                    if (isset($_POST['bcari'])) {
                        // tampilkan data yang dicari
                        $keyword = $_POST['tcari'];
                        $q = "SELECT  * FROM tmapel WHERE nama_mapel like '%$keyword%' or kode like '%$keyword%'  order by
                            id desc ";
                    } else {
                        $q = "SELECT * FROM tmapel order by id desc";
                    }

                    $tampil = mysqli_query($conn, $q);
                    while ($data = mysqli_fetch_array($tampil)) :
                    ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['nama_mapel'] ?></td>
                            <td><?= $data['kode'] ?></td>
                            <td>
                                <a href="index.php?hal=edit&id=<?= $data['id'] ?>" class="btn btn-warning">Edit</a>

                                <a href="index.php?hal=hapus&id=<?= $data['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda Yakin akan Hapus Data ini?')">Hapus</a>
                            </td>
                        </tr>

                    <?php endwhile; ?>

                </table>

            </div>
            <div class="card-footer bg-dark">

            </div>
        </div>
        <!-- akhir card -->

    </div>
    <!-- akhir container -->
    <br>

  <!-- kaki -->
  <div class="container-fluid kaki pt-3 pb-3 bg-dark">
    <div class="container">
      <a href="https://api.whatsapp.com/send?phone=6288989637712&text=Halo%20Admin%20Saya%20Mau%20Bertanya"
      <h5 class="text">All Rights Reserved @dentadhiwangga &copy; 2022</h5>
    </div>
  </div>
  <!-- kaki -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>