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

    if(isset($_POST['editregistrasi'])){

    $hasil = editregistrasi($_POST);

    if($hasil > 0){
        echo "<script>
        alert('Data berhasil disimpan');
        document.location.href='registrasi.php';
        </script>";
    }else{
        echo "<script>alert('Data gagal disimpan');</script>";
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
    <h2>EDIT DATA</h2>
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
         <p>Silahkan ubah data anda!!</p>
        <?php 
            $username = $_SESSION['username'];
            //var_dump(cekRegistrasi($username));

            $dtPendaftar = tampilPendaftar($username);
            foreach($dtPendaftar as $pendaftar):
                      
        ?>
        <form action="" method="POST">
           
            <input type="hidden" name="idRegis" value="<?= $pendaftar['idRegis']; ?>">

            <fieldset>
                <legend>Biodata Calon Siswa</legend>

                <label for="namaDepan">Nama Depan</label>
                <input type="text" name="namaDepan" id="namaDepan" value="<?=  $pendaftar['namaDepan']; ?>">

                <label for="namaBelakang">Nama Belakang</label>
                <input type="text" name="namaBelakang" id="namaBelakang" value="<?=  $pendaftar['namaBelakang']; ?>"> <br><br>

                <label for="tempatLahir">Tempat Lahir</label>
                <input type="text" name="tempatLahir" id="tempatLahir" value="<?=  $pendaftar['tempatLahir']; ?>"> <br><br>

                <label for="tglLahir">Tanggal Lahir</label>
                <input type="date" name="tglLahir" id="tglLahir" value="<?=  $pendaftar['tglLahir']; ?>"> <br><br>

                <label for="jenisKelamin">Jenis Kelamin</label>
                <input type="radio" name="jenisKelamin" id="Laki-laki" value="Laki-laki" <?= $pendaftar['jenisKelamin'] == 'Laki-laki' ? 'checked': ''; ?>>
                <label for="Laki-laki">Laki-laki</label>
                <input type="radio" name="jenisKelamin" id="Perempuan" value="Perempuan" <?= $pendaftar['jenisKelamin'] == 'Perempuan' ? 'checked': ''; ?>>
                <label for="Perempuan">Perempuan</label> <br><br>

                <label for="nisn">NISN</label>
                <input type="text" name="nisn" id="nisn" maxlength="10" value="<?=  $pendaftar['nisn']; ?>"> <br><br>

                <label for="agama">Agama</label>
                <select name="agama" id="agama">
                    <option value="">Pilih salah Satu</option>
                    <option value="Islam" <?= $pendaftar['agama'] == 'Islam' ? 'selected': ''; ?>>Islam</option>
                    <option value="Hindu"<?= $pendaftar['agama'] == 'Hindu' ? 'selected': ''; ?>>Hindu</option>
                    <option value="Protestan" <?= $pendaftar['agama'] == 'Protestan' ? 'selected': ''; ?>>Protestan</option>
                    <option value="Katholik" <?= $pendaftar['agama'] == 'Katholik' ? 'selected': ''; ?>>Katholik</option>
                    <option value="Budha" <?= $pendaftar['agama'] == 'Budha' ? 'selected': ''; ?>>Budha</option>
                </select> <br><br>

                <label for="asalSekolah">Asal Sekolah</label>
                <input type="text" name="sekolahAsal" id="asalSekolah" value="<?=  $pendaftar['sekolahAsal']; ?>"> <br><br>

                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat"><?=  $pendaftar['alamat']; ?></textarea> <br><br>

                <label for="telpon">Telpon/WA</label>
                <input type="text" name="telepon" id="telepon" value="<?=  $pendaftar['telepon']; ?>">
            </fieldset>

            <fieldset>
                <legend>Data Orang Tua</legend>

                <label for="namaAyah">Nama Ayah </label>
                <input type="text" name="namaAyah" id="namaAyah" value="<?=  $pendaftar['namaAyah']; ?>"> <br><br>

                <label for="pekerjaanAyah">Pekerjaan Ayah </label>
                <input type="text" name="pekerjaanAyah" id="pekerjaanAyah" value="<?=  $pendaftar['pekerjaanAyah']; ?>"> <br><br>

                <label for="penghasilanAyah">Penghasilan Ayah </label>
                <input type="number" name="penghasilanAyah" id="penghasilanAyah" value="<?=  $pendaftar['penghasilanAyah']; ?>"><br><br>

                <label for="namaIbu">Nama Ibu </label>
                <input type="text" name="namaIbu" id="namaIbu" value="<?=  $pendaftar['namaIbu']; ?>"> <br><br>

                <label for="pekerjaanIbu">Pekerjaan Ibu </label>
                <input type="text" name="pekerjaanIbu" id="pekerjaanIbu" value="<?=  $pendaftar['pekerjaanIbu']; ?>"> <br><br>

                <label for="penghasilanIbu">Penghasilan Ibu </label>
                <input type="number" name="penghasilanIbu" id="penghasilanIbu" value="<?=  $pendaftar['penghasilanIbu']; ?>"> <br><br>

            </fieldset>

            <input type="submit" name="editregistrasi" value="Edit Data">
            <input
                    type="button"
                    value="Batal"
                    onclick="location.href='registrasi.php'">
            

        </form>

        <?php
        endforeach;
        ?>
        
        
        
            
    
    </div>
        

    
</div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>