<?php
// koneksi database
$server = "localhost";
$user = "root";
$password = "";
$database = "dbcrud2022";

// buat koneksi
$koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi));

// // kode otomatis
// $q = mysqli_query ($koneksi, "SELECT kode FROM tguru order by kode desc limit 1");
// $datax = mysqli_fetch_array($q);
// if($datax) {
//     $no_terakhir = substr($datax['kode'], -3);
//     $no = $no_terakhir + 1;

//     if ($no > 0 and $no < 10) {
//         $kode = "00". $no;
//     } else if ($no > 10 and $no < 100) {
//         $kode = "0". $no;
//     } else if ($no > 100) {
//         $kode = $no;
//     }
// } else {
//     $kode = "001";
// }

// $tahun = date('Y');
// $vkode = "IVN-" . $tahun .'-' . $kode;
// // INV-2022-001


// jika tombol simpan diklik
if (isset($_POST['bsimpan'])) {

  // pengujian apakah data akan diedit atau disimpan baru
  if (isset($_GET['hal']) == "edit") {
    // data akan diedit
    $edit = mysqli_query($koneksi, "UPDATE tsiswa SET
                                               nama_siswa = '$_POST[tnama_siswa]',
                                               alamat = '$_POST[talamat]',
                                               jeniskelamin = '$_POST[tjeniskelamin]',
                                               usia = '$_POST[tusia]',
                                               walikelas = '$_POST[twalikelas]',
                                               tanggalmengisi = '$_POST[ttanggalmengisi]'
                                        WHERE id_siswa = '$_GET[id]'       
");


    //uji jika edit data sukses
    if ($edit) {
      echo "<script>
           alert('edit data Sukses!');
           document.location='absen.php';
        </script>";
    } else {
      echo "<script>
            alert('edit data Gagal!');
             document.location='absen.php';
         </script>";
    }
  } else {
    // data akan disimpan baru
    $simpan = mysqli_query($koneksi, " INSERT INTO tsiswa (nama_siswa, alamat, jeniskelamin, usia, walikelas, tanggalmengisi)
                                        VALUE ( '$_POST[tnama_siswa]',
                                                '$_POST[talamat]',
                                                '$_POST[tjeniskelamin]',
                                                '$_POST[tusia]',
                                                '$_POST[twalikelas]',
                                                '$_POST[ttanggalmengisi]' )
                                                ");
                                                
    //uji jika simpan data sukses
    if ($simpan) {
      echo "<script>
                alert('Simpan data Sukses!');
                document.location='absen.php';
                </script>";
    } else {
      echo "<script>
                alert('Simpan data Gagal!');
                document.location='absen.php';
                </script>";
    }
  }
}

// deklarasi variabel untuk menampung data yang akan diedit
$vnama_siswa = "";
$valamat = "";
$vjeniskelamin = "";
$vusia = "";
$vwalikelas = "";
$vtanggalmengisi = "";





// pengujian jika tombol edit / hapus diklik
if (isset($_GET['hal'])) {

  // pengujian jika edit data
  if ($_GET['hal'] == "edit") {

    // tampilkan data yang akan diedit
    $tampil = mysqli_query($koneksi, "SELECT * FROM tsiswa WHERE id_siswa = '$_GET[id]' ");
    $data = mysqli_fetch_array($tampil);
    if ($data) {
      // jika data ditemukan maka, data ditampung ke dalam divariabel
      $vnama_siswa = $data['nama_siswa'];
      $valamat = $data['alamat'];
      $vjeniskelamin = $data['jeniskelamin'];
      $vusia = $data['usia'];
      $vwalikelas = $data['walikelas'];
      $vtanggalmengisi = $data['tanggalmengisi'];
    }
  } else if ($_GET['hal'] == "hapus") {
    // persiapan hapus data
    $hapus = mysqli_query($koneksi, "DELETE FROM tsiswa WHERE id_siswa = '$_GET[id]' ");
    //uji jika hapus data sukses
    if ($hapus) {
      echo "<script>
            alert('Hapus data Sukses!');
            document.location='absen.php';
            </script>";
    } else {
      echo "<script>
            alert('Hapus data Gagal!');
            document.location='absen.php';
            </script>";
    }
  }
}
if (isset($_POST['bcari'])) {
  // tampilkan data yang dicari
  $keyword = $_POST['tcari'];
  $q = "SELECT  * FROM tsiswa WHERE nama_siswa like '%$keyword%' or alamat like '%$keyword%'  or jeniskelamin like '%$keyword%' order by
                  id_siswa desc ";
} else {
  $q = "SELECT tsiswa.* , tguru.nama FROM tsiswa LEFT JOIN tguru ON tsiswa.walikelas = tguru.id_guru order by id_siswa desc";
}
$tampil = mysqli_query($koneksi, $q);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Siswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
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
              <a class="nav-link" href="/PKL/september2022/web%20sekolah/crud2022/absen.php">Absen Siswa</a>
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
            Form Absen Siswa
          </div>
          <div class="card-body">
            <!-- awal form -->
            <form method="POST">

              <div class="mb-3">
                <label class="form-label">Nama Siswa</label>
                <input type="text" name="tnama_siswa" value="<?= $vnama_siswa ?>" class="form-control" placeholder="Masukan Nama Anda">
              </div>

              <div class="mb-3">
                <label class="form-label">Alamat</label>
                <input type="text" name="talamat" value="<?= $valamat ?>" class="form-control" placeholder="Masukan Alamat Anda">
              </div>

              <div class="mb-3">
                <label class="form-label">Jenis kelamin</label>
                <select class="form-select" name="tjeniskelamin">
                  <option value="">Pilih Jenis Kelamin</option>
                  <option value="Laki-Laki" <?php if($vjeniskelamin == 'Laki-Laki'){echo 'selected';} ?>>Laki-Laki</option>
                  <option value="Perempuan" <?php if($vjeniskelamin == 'Perempuan'){echo 'selected';} ?>>Perempuan</option>

                </select>
              </div>

              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label class="form-label">Usia</label>
                    <input type="number" name="tusia" value="<?= $vusia ?>" class="form-control" placeholder="Masukan Usia Anda">
                  </div>
                </div>

                <div class="col">
                  <div class="mb-3">
                    <label class="form-label">Wali Kelas</label>
                    <select name="twalikelas" class="form-control">
                      <?php
                      $sql = 'SELECT * FROM `tguru`';
                      $query = mysqli_query($koneksi, $sql);
                      while ($obj = mysqli_fetch_object($query)) {
                        // print_r($obj);die();
                      ?>
                        <option value="<?= $obj->id_guru ?>" <?= $vwalikelas == $obj->id_guru ? 'selected' : null;  ?>><?= $obj->nama ?></option>
                      <?php

                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col">
                  <div class="mb-3">
                    <label class="form-label">Tanggal Mengisi</label>
                    <input type="date" name="ttanggalmengisi" value="<?= $vtanggalmengisi ?>" class="form-control" placeholder="Masukan Umur Anda">
                  </div>
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
    <div class="card mt-3">
      <div class="card-header bg-dark text-light">
        Data Siswa
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
            <th>Nama Siswa</th>
            <th>Alamat</th>
            <th>Jenis kelamin</th>
            <th>Usia</th>
            <th>Wali Kelas</th>
            <th>Tanggal Mengisi</th>
            <th>Aksi</th>
          </tr>
          <?php
          // persiapan menampilkan data
          $no = 1;
          // untuk pencarian data
          // jika tombol cari diklik

          while ($data = mysqli_fetch_array($tampil)) :
          ?>

            <tr>
              <td><?= $no++ ?></td>
              <td><?= $data['nama_siswa'] ?></td>
              <td><?= $data['alamat'] ?></td>
              <td><?= $data['jeniskelamin'] ?></td>
              <td><?= $data['usia'] ?></td>
              <td><?= $data['nama'] ?? 'Data Belum Terdaftar' ?></td>
              <td><?= $data['tanggalmengisi'] ?></td>
              <td>
                <a href="absen.php?hal=edit&id=<?= $data['id_siswa'] ?>" class="btn btn-warning">Edit</a>

                <a href="absen.php?hal=hapus&id=<?= $data['id_siswa'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda Yakin akan Hapus Data ini?')">Hapus</a>
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
      <a href="https://api.whatsapp.com/send?phone=6288989637712&text=Halo%20Admin%20Saya%20Mau%20Bertanya" <h5 class="text">All Rights Reserved @dentadhiwangga &copy; 2022</h5>
    </div>
  </div>
  <!-- kaki -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>