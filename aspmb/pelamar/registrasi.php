<?php

    session_start();

    require "../fungsi.php";

    if(!isset($_SESSION['login'])){
        header("Location: ../login.php");
        exit;
    }

    if($_SESSION['peran'] != "pelamar"){
        header("Location: ../login.php");
        exit;
    }

    if(isset($_POST['registrasi'])){

    $hasil = registrasi($_POST);

    if($hasil > 0){
        echo "<script>
        alert('Data berhasil disimpan');
        document.location.href='registrasi.php';
        </script>";
    }else{
        echo "<script>alert('Data gagal disimpan');</script>";
    }
    }

    if(isset($_POST['hapus'])){

    $hasil = hapusPendaftaran($_SESSION['username']);

    if($hasil > 0){
        echo "<script>
            alert('Data pendaftaran berhasil dihapus');
            document.location.href='registrasi.php';
        </script>";
    }else{
        echo "<script>
            alert('Data pendaftaran gagal dihapus');
        </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelamar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">

        <a class="navbar-brand fw-bold" href="index.php">
            ASPMB
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse"
             id="navbarNav">

            <ul class="navbar-nav ms-auto">


                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../logout.php">
                        Logout
                    </a>
                </li>

                

            </ul>

        </div>

    </div>
</nav>

<div>
    <h2>DASHBOARD REGISTRASI</h2>
</div>

<div>
    <?php
        echo "Selamat Datang <strong>" . $_SESSION['username'] . "</strong>";
    ?>
</div>

<div>
    <ul>
        <li>
            <a href="registrasi.php">Registrasi</a>
        </li>
         <li>
            <a href="unggahDok.php">Dokumen</a>
        </li>
         <li>
            <a href="pengumuman.php">Pengumuman</a>
        </li>
        <li>
            <a href="kelulusan.php">Kelulusan</a>
        </li>
    </ul>
</div>


<div>
        <hr>
        <p>Silahkan isi biodata anda</p>
        <?php 
        $username = $_SESSION['username'];
                
        if(cekRegistrasi($username) == 0):
            
        ?>
    <form action="" method="POST">
            <label for="namaDepan">Nama Depan</label>
            <input type="text" name="namaDepan" id="namaDepan" required>

            <label for="namaBelakang">Nama Belakang</label>
            <input type="text" name="namaBelakang" id="namaBelakang" required> <br><br>

            <label for="tempatLahir">Tempat Lahir</label>
            <input type="text" name="tempatLahir" id="tempatLahir" required> <br><br>

            <label for="tglLahir">Tanggal Lahir</label>
            <input type="date" name="tglLahir" id="tglLahir" required> <br><br>

            <label for="jenisKelamin">Jenis Kelamin</label>
            <input type="radio" name="jenisKelamin" id="Laki-laki" value="Laki-laki" required>
            <label for="Laki-laki">Laki-laki</label>
            <input type="radio" name="jenisKelamin" id="Perempuan" value="Perempuan">
            <label for="Perempuan">Perempuan</label> <br><br>

            <label for="nisn">NISN</label>
            <input type="text" name="nisn" id="nisn" maxlength="10" required> <br><br>

            <label for="agama">Agama</label>
            <select name="agama" id="agama">
                <option value="Islam">Islam</option>
                <option value="Hindu">Hindu</option>
                <option value="Protestan">Protestan</option>
                <option value="Katholik">Katholik</option>
                <option value="Budha">Budha</option>
            </select> <br><br>

            <label for="asalSekolah">Asal Sekolah</label>
            <input type="text" name="sekolahAsal" id="asalSekolah" required> <br><br>

            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" required></textarea> <br><br>

            <label for="telepon">Telepon/WA</label>
            <input type="text" name="telepon" id="telepon" required>

           
            

        
        
        
            
    


        <div>
            <fieldset>
                <legend>Data Orang Tua</legend>

                <div class="col-md-4">
                    <label for="namaAyah" class="form-label fw-semibold">Nama Ayah</label>
                    <input type="text" class="form-control form-control-lg" name="namaAyah" id="namaAyah" required>
                </div>
                <div class="col-md-4">
                    <label for="pekerjaanAyah" class="form-label fw-semibold">Pekerjaan Ayah</label>
                    <input type="text" class="form-control form-control-lg" name="pekerjaanAyah" id="pekerjaanAyah" required>
                </div>
                <div class="col-md-4">
                    <label for="penghasilanAyah" class="form-label fw-semibold">Penghasilan Ayah (Rp)</label>
                    <input type="number" class="form-control form-control-lg" name="penghasilanAyah" id="penghasilanAyah" required>
                </div>

                <div class="col-md-4">
                    <label for="namaIbu" class="form-label fw-semibold">Nama Ibu</label>
                    <input type="text" class="form-control form-control-lg" name="namaIbu" id="namaIbu" required>
                </div>
                <div class="col-md-4">
                    <label for="pekerjaanIbu" class="form-label fw-semibold">Pekerjaan Ibu</label>
                    <input type="text" class="form-control form-control-lg" name="pekerjaanIbu" id="pekerjaanIbu" required>
                </div>
                <div class="col-md-4">
                    <label for="penghasilanIbu" class="form-label fw-semibold">Penghasilan Ibu (Rp)</label>
                    <input type="number" class="form-control form-control-lg" name="penghasilanIbu" id="penghasilanIbu" required>
                </div>
                    <br>
                <div>
                    <button type="submit" name="registrasi" id="registrasi">Submit Data</button>
                </div>
            </fieldset>
            
        </div>
        <?php 
            else:
                echo "Anda sudah mengisi formulir";
            
            
        ?>

        <?php
        $dataPendaftar = tampilPendaftar($username);
                //var_dump($dataPendaftar);

                foreach($dataPendaftar as $pendaftar):
            ?>

                <br>
                <br>
                <ul>
                    <li>Nama Depan : <?= $pendaftar['namaDepan']; ?></li>
                
                    <li>Nama Belakang : <?= $pendaftar['namaBelakang']; ?></li>
                
                    <li>TTL : <?= $pendaftar['tempatLahir']; ?>, <?= $pendaftar['tglLahir']; ?></li>
                
                    <li>Jenis Kelamin : <?= $pendaftar['jenisKelamin']; ?></li>
                
                    <li>NISN : <?= $pendaftar['nisn']; ?></li>
                
                    <li>Agama : <?= $pendaftar['agama']; ?></li>
                
                    <li>Sekolah Asal : <?= $pendaftar['sekolahAsal']; ?></li>
                
                    <li>Alamat : <?= $pendaftar['alamat']; ?></li>
                
                    <li>Telepon : <?= $pendaftar['telepon']; ?></li>
                </ul>
                <p> <strong>Data Orang Tua</strong></p>
                <ul>
                    <li>Nama Ayah : <?= $pendaftar['namaAyah']; ?></li>
                    <li>Pekerjaan Ayah : <?= $pendaftar['pekerjaanAyah']; ?></li>
                    <li>Penghasilan Ayah : <?= $pendaftar['penghasilanAyah']; ?></li>
                    <li>Nama Ibu : <?= $pendaftar['namaIbu']; ?></li>
                    <li>Pekerjaan Ibu : <?= $pendaftar['pekerjaanIbu']; ?></li>
                    <li>Penghasilan Ibu : <?= $pendaftar['penghasilanIbu']; ?></li>
                </ul>

            <?php
                endforeach;
                endif;

            
        ?>
        <p>Edit Data <a href="editdatregis.php">Edit</a></p>
    </form>
    <form method="POST" style="display:inline;">
    <button type="submit"
            name="hapus"
            onclick="return confirm('Yakin ingin menghapus data pendaftaran?')">
        Hapus Pendaftaran
    </button>
    </form>
</div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>