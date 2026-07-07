<?php 

    session_start();

    if(isset($_SESSION['login'])){

        if($_SESSION['peran'] == "pelamar"){
            header("Location: pelamar/index.php");
            exit;
        }else{
            header("Location: panitia/index.php");
            exit;
        }
    }

    require "fungsi.php";

    if(isset($_POST['login'])){

    $hasil = login($_POST);

    if($hasil == 1){
        $_SESSION['login'] = true;
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['peran'] = "pelamar";
        echo "<script>
            alert('Login Berhasil!');
            document.location.href='pelamar/index.php';
        </script>";

    }else if($hasil == 2){
        $_SESSION['login'] = true;
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['peran'] = "panitia";
        echo "<script>
            alert('Login Berhasil!');
            document.location.href='panitia/index.php';
        </script>";

    }else if($hasil == -1){
        echo "<script>
            alert('Username tidak terdaftar');
        </script>";

    }else{
        echo "<script>
            alert('Password anda salah!!!');
        </script>";
    }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penerimaan Siswa Baru</title>

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
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="buat_akun.php">
                        Register
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="login.php">
                        Login
                    </a>
                </li>

                

            </ul>

        </div>

    </div>
</nav>

<div>
        <hr>LOGIN</hr>
        <p>silahkan masukkan username dan password!</p>
        <form action="" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username">

            <label for="password">Password: </label>
            <input type="password" name="password" id="password">

            <input type="submit" name="login" value="Login">
        </form>
</div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>