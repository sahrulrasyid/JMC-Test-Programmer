<?php
error_reporting(0);
include 'koneksi.php';

//Simpan  untuk Provinsi
if(isset($_POST['bsimpan']))
{
  //pengujian apakah data akan diedit atau disimpan baru
  if($_GET['hal']== "edit")
  {//data akan diedit

    $edit = mysqli_query($koneksi, "UPDATE tb_provinsi set provinsi = '$_POST[tprovinsi]' where id_provinsi = '$_GET[id]'");

    if($edit) //jika edit sukses
    {
      echo "<script>
      alert('Berhasil di Edit!');
      document.location='index.php';
      </script>";
    }else //jika edit gagal
    {
      echo "<script>
      alert('Gagal di Edit!');
      document.location='index.php';
      </script>";
    }

  }else //data akan disimpan baru
  {
    $simpan = mysqli_query($koneksi, "INSERT into tb_provinsi (provinsi) VALUES ('$_POST[tprovinsi]')");

    if($simpan) //jika simpan sukses
    {
      echo "<script>
      alert('Berhasil di simpan!');
      document.location='index.php';
      </script>";
    }else //jika simpan gagal
    {
      echo "<script>
      alert('Gagal di simpan!');
      document.location='index.php';
      </script>";
    }
  
  }

  }

//Pengujian jika tombol edit diklick

if(isset($_GET['hal']))
{
  // pengujian jika edit data
  if($_GET['hal']== "edit")
  {
// tampilkan data yang akan di edit

$tampil = mysqli_query($koneksi, "SELECT * from tb_provinsi where id_provinsi = '$_GET[id]'");
$data = mysqli_fetch_array($tampil);
if($data)
{
  // jika data ditemukan bakal di tampung
  $vprov = $data['provinsi'];
}
  }
  else if ($_GET['hal'] == "hapus")
  {
    $hapus = mysqli_query($koneksi, "DELETE from tb_provinsi where id_provinsi = '$_GET[id]'");
    if($hapus){
      echo "<script>
      alert('Hapus data sukses!');
      document.location='index.php';
      </script>";
    }
  }
}
// --------------------------------------------------------------------------------------------------------------------------------------------//

//Simpan  untuk Provinsi
if(isset($_POST['bksimpan']))
{
  //pengujian apakah data akan diedit atau disimpan baru
  if($_GET['hal']== "edit")
  {//data akan diedit

    $edit = mysqli_query($koneksi, "UPDATE tb_kabupaten set kabupaten = '$_POST[tkabupaten]', provinsi = '$_POST[tkprovinsi]',penduduk = '$_POST[tpenduduk]' where id_kabupaten = '$_GET[id]'");

    if($edit) //jika edit sukses
    {
      echo "<script>
      alert('Berhasil di Edit!');
      document.location='index.php';
      </script>";
    }else //jika edit gagal
    {
      echo "<script>
      alert('Gagal di Edit!');
      document.location='index.php';
      </script>";
    }

  }else //data akan disimpan baru
  {
    $simpan = mysqli_query($koneksi, "INSERT into tb_kabupaten (kabupaten,provinsi,penduduk) VALUES ('$_POST[tkabupaten]','$_POST[tkprovinsi]','$_POST[tpenduduk]')");

    if($simpan) //jika simpan sukses
    {
      echo "<script>
      alert('Berhasil di simpan!');
      document.location='index.php';
      </script>";
    }else //jika simpan gagal
    {
      echo "<script>
      alert('Gagal di simpan!');
      document.location='index.php';
      </script>";
    }
  
  }

  }

//Pengujian jika tombol edit diklick

if(isset($_GET['hal']))
{
  // pengujian jika edit data
  if($_GET['hal']== "edit")
  {
// tampilkan data yang akan di edit

$tampil = mysqli_query($koneksi, "SELECT * from tb_kabupaten where id_kabupaten = '$_GET[id]'");
$data = mysqli_fetch_array($tampil);
if($data)
{
  // jika data ditemukan bakal di tampung
  $vkab = $data['kabupaten'];
  $vpend = $data['penduduk'];
}
  }
  else if ($_GET['hal'] == "hapus")
  {
    $hapus = mysqli_query($koneksi, "DELETE from tb_kabupaten where id_kabupaten = '$_GET[id]'");
    if($hapus){
      echo "<script>
      alert('Hapus data sukses!');
      document.location='index.php';
      </script>";
    }
  }
}

// --------------------------------------------------------------------------------------------------------------//


?>





<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <title>JMC Provinsi</title>
  </head>
  <body>
    <h1 class="text-center mt-4">DATA PROVINSI</h1>
    <!-- Awal Card Profisi -->
    <div class="container">
      <div class="card mt-3">
        <div class="card-header bg-primary text-white">
          <h3>Form Input Provinsi</h3>
        </div>
        <div class="card-body">

          <form method="post" action="">
            <div class="form-group">
              <label >Provinsi</label>
              <input type="text" name="tprovinsi" value="<?=@$vprov ?>" class="form-control" id="provinsi" placeholder="Masukan Nama Provinsi" required>
            </div>

            <button type="submit" class="btn btn-success mt-3" name="bsimpan">Simpan</button>
            <button type="reset" class="btn btn-danger mt-3" name="breset">Kosogkan</button>

          </form>
        </div>
      </div>
      </div>
    </div>
    <!-- Akhir Card Profinsi -->

    <!-- Awal Table Provinsi -->
    <div class="container">
      <div class="card mt-3">
        <div class="card-header bg-success text-white">
          <h3>Daftar Provinsi</h3>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped">
            <tr>
              <th>No</th>
              <th>Provinsi</th>
              <th>Opsi</th>
            </tr>

            <?php
            $no = 1;
            $tampil = mysqli_query($koneksi, "SELECT * from tb_provinsi");
            while($data = mysqli_fetch_array($tampil)) :
            ?>

           <tr>
            <td><?= $no++ ?></td>
            <td><?=  $data ['provinsi']?></td>
            <td>
              <a href="index.php?hal=edit&id=<?= $data['id_provinsi']?>" class="btn btn-warning">Edit</a>
              <a href="index.php?hal=hapus&id=<?= $data['id_provinsi']?>" 
              onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger" >Hapus</a>
            </td>
          </tr>
          <?php endwhile; //penutup perulangan ?>

          </table>

         
        </div>
      </div>
      </div>
    </div>
    <!-- Akhit Table Provinsin-->

<!-- Card Form Kabupaten -->
    <div class="container">
      <div class="card mt-3">
        <div class="card-header bg-primary text-white">
          <h3>Form Input Kabupaten</h3>
        </div>
        <div class="card-body">

          <form method="post" action="">
            <div class="form-group">
              <label >Kabupaten</label>
              <input type="text" name="tkabupaten" value="<?=@$vkab ?>" class="form-control" id="kabupaten" placeholder="Masukan Nama Kabupaten" required>
            </div>

            <div class="form-group">
              <label >Provinsi</label>
              <select name = "tkprovinsi" id="provinsi" class="form-control" >
              <option value="">--select--</option>
                <?php
              $tampil = mysqli_query($koneksi, "SELECT * from tb_provinsi");
            while($data = mysqli_fetch_array($tampil)) :?>
                <option  value ="<?= $data ['provinsi']?>"><?=  $data ['provinsi']?></option>
                <?php endwhile; ?>
              </select>
            </div>

            <div class="form-group">
              <label >Jumlah Penduduk</label>
              <input type="text" name="tpenduduk" value="<?= @$vpend ?>" class="form-control" id="Penduduk" placeholder="Masukan Jumlah Penduduk" required>
            </div>

            <button type="submit" class="btn btn-success mt-3" name="bksimpan">Simpan</button>
            <button type="reset" class="btn btn-danger mt-3" name="bkreset">Kosogkan</button>

          </form>
        </div>
      </div>
      </div>
    </div>
    <!-- Akhir Card Kabupaten -->

<!-- Awal Table Kabupaten -->
    <div class="container">
      <div class="card mt-3">
        <div class="card-header bg-success text-white">
          <h3>Data Penduduk Perkabupaten</h3>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped">
            <tr>
              <th>No</th>
              <th>Provinsi</th>
              <th>Kabupaten</th>
              <th>Penduduk</th>
              <th>Opsi</th>
            </tr>
            <?php
            $no = 1;
            $tampil = mysqli_query($koneksi, "SELECT * FROM tb_kabupaten");
            while($data = mysqli_fetch_array($tampil)) :      
            ?>
            <tr>
            <td><?= $no++ ?></td>
            <td><?= $data ['provinsi']; ?></td>
            <td><?= $data ['kabupaten']; ?></td>
            <td><?= $data ['penduduk']; ?></td>

            

            <td>
              <a href="index.php?hal=edit&id=<?= $data['id_kabupaten']?>" class="btn btn-warning">Edit</a>
              <a href="index.php?hal=hapus&id=<?= $data['id_kabupaten']?>" 
              onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger" >Hapus</a>
            </td>
            </tr>
            <?php endwhile; ?>
          </table>

        </div>
      </div>
      </div>
    </div>
    <!-- Akhit Table kabupaten-->

    <!-- Awal Menjumlahkan Penduduk Pervinsi -->
    <div class="container">
      <div class="card mt-3">
        <div class="card-header bg-success text-white">
          <h3>Perhitungan Total Penduduk  Dalam Satu Provinsi</h3>
        </div>
        <div class="card-body">

        <form action="" method="POST">
      
        <input type="text" name="query" placeholder="Cari Data" value="<?php  $query = $_POST['query'];?>">
        <input type="submit" name="cari" value="Search">
     
            </form><br>
            
            <?php  

            $query = $_POST['query'];

            echo "Provinsi  ".$query."<br />";
      

            if($query !=''){
              $tampil = mysqli_query($koneksi, "SELECT * from tb_kabupaten where  provinsi LIKE '".$query."'");
            }else{
              $tampil = mysqli_query($koneksi, "SELECT * from tb_kabupaten");
              $jumlah = mysqli_num_rows($tampil);
            }
           if(mysqli_num_rows($tampil)){
          
           while($data = mysqli_fetch_array($tampil)) {
           
          
          $i++;
          $total[$i] = $data['penduduk']; 

          echo $data['kabupaten']." dengan jumlah penduduk ".$data['penduduk']."<br />";

          
            }
          // Penjumlahan
            echo "Total Penduduk di  ".$query." sebanyak  ".array_sum($total);
          }else{
              echo  "Tidak ada data";
            }
              ?>
          </table>
            
        </div>
      </div>
      </div>
    </div>
   

    <script src="js/bootstrap.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
