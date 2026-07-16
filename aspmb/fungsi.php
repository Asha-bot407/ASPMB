<?php

//fungsi buat akun
require "koneksi.php";

function buatAkun($data){
    global $koneksi;
    $username = strtolower(mysqli_real_escape_string($koneksi, $data['username']));
    $email = strtolower(mysqli_real_escape_string($koneksi, $data['email']));
    $password = mysqli_real_escape_string($koneksi, $data['password']);
    $peran = "pelamar";

    $hasilCek = mysqli_query(
                $koneksi,
                "SELECT username FROM tbl_user WHERE username='$username'"
            );

    if(mysqli_num_rows($hasilCek) != 0){
        return -1;
    }else{
        $password = password_hash($password, PASSWORD_DEFAULT);

        $queryBuatAkun = "INSERT INTO tbl_user (username, password, email, peran)
        VALUES('$username', '$password', '$email', '$peran')";

        mysqli_query($koneksi, $queryBuatAkun);
        
        $hasil = mysqli_affected_rows($koneksi);

        if($hasil > 0){
            return 1;
        }else{
            return 0;
        }
    }
}


//fungsi login
function login($akunlogin){
    global $koneksi;
    $username = strtolower(mysqli_real_escape_string($koneksi, $akunlogin['username']));
    $password = mysqli_real_escape_string($koneksi, $akunlogin['password']);


    $cekLoginUser = "SELECT * FROM tbl_user WHERE username = '$username'";
    $hasilCekLoginUser = mysqli_query($koneksi, $cekLoginUser);

    if(mysqli_num_rows($hasilCekLoginUser)!= 1){
          return -1;
    }else{
        $cekPassword = mysqli_fetch_assoc($hasilCekLoginUser);  
        if(password_verify($password, $cekPassword['password'])){
             if($cekPassword['peran'] == 'pelamar'){
                return 1;
            }else{
                return 2;
            }
        }else{
            return 0;
        }
    }
}


//fungsi cekregistrasi
function cekRegistrasi($username){
    global $koneksi;

    $queryCekRegistrasi = "SELECT * FROM tbl_registrasi WHERE username = '$username'";
    $hasilCekRegistrasi = mysqli_query($koneksi, $queryCekRegistrasi);

    if(mysqli_num_rows($hasilCekRegistrasi)!=0){
        return 1;
    }else{
        return 0;
    }
}


function registrasi($datareg){
    global $koneksi;

    // Mengambil username dari session
    $username = $_SESSION['username'];

    // Mengambil data dari form
    $namaDepan = mysqli_real_escape_string($koneksi, $datareg['namaDepan']);
    $namaBelakang = mysqli_real_escape_string($koneksi, $datareg['namaBelakang']);
    $tempatLahir = mysqli_real_escape_string($koneksi, $datareg['tempatLahir']);
    $tglLahir = mysqli_real_escape_string($koneksi, $datareg['tglLahir']);
    $jenisKelamin = mysqli_real_escape_string($koneksi, $datareg['jenisKelamin']);
    $nisn = mysqli_real_escape_string($koneksi, $datareg['nisn']);
    $agama = mysqli_real_escape_string($koneksi, $datareg['agama']);
    $sekolahAsal = mysqli_real_escape_string($koneksi, $datareg['sekolahAsal']);
    $alamat = mysqli_real_escape_string($koneksi, $datareg['alamat']);
    $telepon = mysqli_real_escape_string($koneksi, $datareg['telepon']);

    //tangkap data orangtua
    $namaAyah = mysqli_real_escape_string($koneksi, $datareg['namaAyah']);
    $pekerjaanAyah = mysqli_real_escape_string($koneksi, $datareg['pekerjaanAyah']);
    $penghasilanAyah = mysqli_real_escape_string($koneksi, $datareg['penghasilanAyah']);
    $namaIbu = mysqli_real_escape_string($koneksi, $datareg['namaIbu']);
    $pekerjaanIbu = mysqli_real_escape_string($koneksi, $datareg['pekerjaanIbu']);
    $penghasilanIbu = mysqli_real_escape_string($koneksi, $datareg['penghasilanIbu']);

    // Query simpan data
    $queryRegistrasi = "INSERT INTO tbl_registrasi
                        (username, namaDepan, namaBelakang, tempatLahir, tglLahir, jenisKelamin, nisn, agama, sekolahAsal, alamat, telepon)
                        VALUES
                        ('$username', '$namaDepan', '$namaBelakang', '$tempatLahir', '$tglLahir', '$jenisKelamin', '$nisn', '$agama', '$sekolahAsal', '$alamat', '$telepon')";

    mysqli_query($koneksi, $queryRegistrasi);

     $hasilRegistrasi = mysqli_affected_rows($koneksi);

    if($hasilRegistrasi == 1){
        //cek data registrasi
        $cekDtRegistrasi = "SELECT idRegis FROM tbl_registrasi WHERE username = '$username'";
        $hasilCekDtRegistrasi = mysqli_query($koneksi, $cekDtRegistrasi);

    $ambilDtIdRegistrasi = mysqli_fetch_assoc($hasilCekDtRegistrasi);
        $idRegistrasi = $ambilDtIdRegistrasi['idRegis'];

        //simpan data pada database
        $inputDtOrtu = "INSERT INTO tbl_orangtua (idRegis, namaAyah, pekerjaanAyah, penghasilanAyah, namaIbu, pekerjaanIbu, penghasilanIbu)
                        VALUES ('$idRegistrasi', '$namaAyah', '$pekerjaanAyah', '$penghasilanAyah', '$namaIbu', '$pekerjaanIbu', '$penghasilanIbu')";
        $queryInputDtOrtu = mysqli_query($koneksi, $inputDtOrtu);

    return mysqli_affected_rows($koneksi);

    /* cara alternatif
    $hasilRegis = mysqli_affected_rows($koneksi);

     if($hasilRegis != 0){
            return 1;
        }else{
            return 0;
        }*/
    }
}

function tampilPendaftar($pendaftar){
    global $koneksi;
    $username = $pendaftar;
 $tampilDtPendaftar = "SELECT * FROM tbl_registrasi AS r
                        INNER JOIN tbl_orangtua AS o
                        ON r.idRegis = o.idRegis 
                        WHERE r.username = '$username'";
    $queryTampilDtPendaftar = mysqli_query($koneksi, $tampilDtPendaftar);
    

    $rows = [];
    while($row = mysqli_fetch_assoc($queryTampilDtPendaftar)){
        $rows[] = $row;
    }
    return $rows;
}

// editregistrasi

function editregistrasi($dataedit){
    global $koneksi;

    // Mengambil username dari session
    $username = $_SESSION['username'];
    $idRegis = $dataedit['idRegis'];

    // Mengambil data dari form
    $namaDepan = mysqli_real_escape_string($koneksi, $dataedit['namaDepan']);
    $namaBelakang = mysqli_real_escape_string($koneksi, $dataedit['namaBelakang']);
    $tempatLahir = mysqli_real_escape_string($koneksi, $dataedit['tempatLahir']);
    $tglLahir = mysqli_real_escape_string($koneksi, $dataedit['tglLahir']);
    $jenisKelamin = mysqli_real_escape_string($koneksi, $dataedit['jenisKelamin']);
    $nisn = mysqli_real_escape_string($koneksi, $dataedit['nisn']);
    $agama = mysqli_real_escape_string($koneksi, $dataedit['agama']);
    $sekolahAsal = mysqli_real_escape_string($koneksi, $dataedit['sekolahAsal']);
    $alamat = mysqli_real_escape_string($koneksi, $dataedit['alamat']);
    $telepon = mysqli_real_escape_string($koneksi, $dataedit['telepon']);

    //tangkap data orangtua
    $namaAyah = mysqli_real_escape_string($koneksi, $dataedit['namaAyah']);
    $pekerjaanAyah = mysqli_real_escape_string($koneksi, $dataedit['pekerjaanAyah']);
    $penghasilanAyah = mysqli_real_escape_string($koneksi, $dataedit['penghasilanAyah']);
    $namaIbu = mysqli_real_escape_string($koneksi, $dataedit['namaIbu']);
    $pekerjaanIbu = mysqli_real_escape_string($koneksi, $dataedit['pekerjaanIbu']);
    $penghasilanIbu = mysqli_real_escape_string($koneksi, $dataedit['penghasilanIbu']);

    //query edit

    $queryedit = "UPDATE tbl_registrasi
                  SET namaDepan = '$namaDepan',
                      namaBelakang = '$namaBelakang',
                      tempatLahir = '$tempatLahir',
                      tglLahir = '$tglLahir',
                      jenisKelamin = '$jenisKelamin',
                      nisn = '$nisn',
                      agama = '$agama',
                      sekolahAsal = '$sekolahAsal',
                      alamat = '$alamat',
                      telepon = '$telepon'
                  WHERE username = '$username'";


    $queryEditOrtu = "UPDATE tbl_orangtua
                  SET namaAyah = '$namaAyah',
                      pekerjaanAyah = '$pekerjaanAyah',
                      penghasilanAyah = '$penghasilanAyah',
                      namaIbu = '$namaIbu',
                      pekerjaanIbu = '$pekerjaanIbu',
                      penghasilanIbu = '$penghasilanIbu'
                  WHERE idRegis = '$idRegis'";

    mysqli_query($koneksi, $queryedit);
    mysqli_query($koneksi, $queryEditOrtu);

    return mysqli_affected_rows($koneksi);
}

// hapus data registrasi
function hapusPendaftaran($username){
    global $koneksi;

    $username = mysqli_real_escape_string($koneksi, $username);

    $hapusReg = "DELETE FROM tbl_registrasi WHERE username = '$username'";
    mysqli_query($koneksi, $hapusReg);

    return mysqli_affected_rows($koneksi);
}
?>