<?php
// koneksi database
$server = "localhost";
$user = "id19497190_root";
$password = "CnJT85u>v!!z{YSu";
$database = "id19497190_sesi23";

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
    $edit = mysqli_query($koneksi, "UPDATE tguru SET
                                               kode = '$_POST[tkode]',
                                               nama = '$_POST[tnama]',
                                               alamat = '$_POST[talamat]',
                                               asal = '$_POST[tasal]',
                                               usia = '$_POST[tusia]',
                                               bidang = '$_POST[tbidang]',
                                               tanggal_lahir = '$_POST[ttanggal_lahir]'
                                        WHERE id_guru = '$_GET[id]'       
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
    $simpan = mysqli_query($koneksi, " INSERT INTO tguru (kode, nama, alamat, asal, usia, bidang, tanggal_lahir)
                                        VALUE ( '$_POST[tkode]',
                                                '$_POST[tnama]',
                                                '$_POST[talamat]',
                                                '$_POST[tasal]',
                                                '$_POST[tusia]',
                                                '$_POST[tbidang]',
                                                '$_POST[ttanggal_lahir]' )
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
$vkode = "";
$vnama = "";
$valamat = "";
$vasal = "";
$vusia = "";
$vbidang = "";
$vtanggal_lahir = "";





// pengujian jika tombol edit / hapus diklik
if (isset($_GET['hal'])) {

  // pengujian jika edit data
  if ($_GET['hal'] == "edit") {

    // tampilkan data yang akan diedit
    $tampil = mysqli_query($koneksi, "SELECT * FROM tguru WHERE id_guru = '$_GET[id]' ");
    $data = mysqli_fetch_array($tampil);
    if ($data) {
      // jika data ditemukan maka, data ditampung ke dalam divariabel
      $vkode = $data['kode'];
      $vnama = $data['nama'];
      $valamat = $data['alamat'];
      $vasal = $data['asal'];
      $vusia = $data['usia'];
      $vbidang = $data['bidang'];
      $vtanggal_lahir = $data['tanggal_lahir'];
    }
  } else if ($_GET['hal'] == "hapus") {
    // persiapan hapus data
    $hapus = mysqli_query($koneksi, "DELETE FROM tguru WHERE id_guru = '$_GET[id]' ");
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
  <title>Data Guru</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css" />
</head>

<body>
    
    <!-- navigasi -->
<nav
      class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg fixed-top"
    >
      <div class="container">
        <a class="navbar-brand" href="#">SMK Penerbangan Angkasa</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarText"
          aria-controls="navbarText"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-right" id="navbarText">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="/websekolah">Home</a>
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
            Form Input Data Guru
          </div>
          <div class="card-body">
            <!-- awal form -->
            <form method="POST">

              <div class="mb-3">
                <label class="form-label">Kode Guru</label>
                <input type="text" name="tkode" value="<?= $vkode ?>" class="form-control" placeholder="Masukan Kode Guru">
              </div>

              <div class="mb-3">
                <label class="form-label">Nama Guru</label>
                <input type="text" name="tnama" value="<?= $vnama ?>" class="form-control" placeholder="Masukan Nama Guru">
              </div>

              <div class="mb-3">
                <label class="form-label">Alamat</label>
                <input type="text" name="talamat" value="<?= $valamat ?>" class="form-control" placeholder="Masukan Alamat Anda">
              </div>

              <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select class="form-select" name="tasal">
                  <option value="<?= $vasal ?>"><?= $vasal ?></option>
                  <option value="Laki-Laki">Laki-Laki</option>
                  <option value="Perempuan">Perempuan</option>

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
                    <label class="form-label">Bidang</label>
                    <select class="form-select" name="tbidang">
                      <option value="<?= $vbidang ?>"><?= $vbidang ?></option>
                      <option value="Airframe Power Plant">Airframe Power Plant</option>
                      <option value="Aircraft Machining">Aircraft Machining</option>
                      <option value="Aircraft Sheet Metal Forming">Aircraft Sheet Metal Forming</option>
                      <option value="Airframe Mechanic">Airframe Mechanic</option>
                      <option value="Aircraft Electricity">Aircraft Electricity</option>
                      <option value="Aviation Electronics">Aviation Electronics</option>
                    </select>
                  </div>
                </div>

                <div class="col">
                  <div class="mb-3">
                    <label class="form-label">Tanggal Mengisi</label>
                    <input type="date" name="ttanggal_lahir" value="<?= $vtanggal_lahir ?>" class="form-control" placeholder="Masukan Umur Anda">
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
        Data Guru
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
            <th>Kode guru</th>
            <th>Nama Guru</th>
            <th>Alamat</th>
            <th>Jenis kelamin</th>
            <th>Usia</th>
            <th>Bidang</th>
            <th>Tanggal Mengisi</th>
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
            $q = "SELECT  * FROM tguru WHERE kode like '%$keyword%' or nama like '%$keyword%'  or asal like '%$keyword%' order by
                            id_guru desc ";
          } else {
            $q = "SELECT * FROM tguru order by id_guru desc";
          }

          $tampil = mysqli_query($koneksi, $q);
          while ($data = mysqli_fetch_array($tampil)) :
          ?>

            <tr>
              <td><?= $no++ ?></td>
              <td><?= $data['kode'] ?></td>
              <td><?= $data['nama'] ?></td>
              <td><?= $data['alamat'] ?></td>
              <td><?= $data['asal'] ?></td>
              <td><?= $data['usia'] ?></td>
              <td><?= $data['bidang'] ?></td>
              <td><?= $data['tanggal_lahir'] ?></td>
              <td>
                <a href="index.php?hal=edit&id=<?= $data['id_guru'] ?>" class="btn btn-warning">Edit</a>

                <a href="index.php?hal=hapus&id=<?= $data['id_guru'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda Yakin akan Hapus Data ini?')">Hapus</a>
              </td>
            </tr>

          <?php endwhile; ?>

        </table>

      </div>
      <div class="card-footer bg-dark">

      </div>
    </div>
    <!-- akhir card -->
    <br>


  </div>
  <!-- akhir container -->



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>