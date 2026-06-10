<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">

        <a class="navbar-brand fw-bold" href="#">
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
                    <a class="nav-link" href="#">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Register
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Login
                    </a>
                </li>

                

            </ul>

        </div>

    </div>
</nav>

<h2 class="text-center">REGISTRASI AKUN MURIB BARU</h2>

<section>
    <div class="container">
            <form method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" class="form-control" id="InputUsername1" aria-describedby="emailHelp" name="username">
                    
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp" name="email">
                    
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="InputPassword1" name="password">
                </div>
                
                <button type="submit" class="btn btn-primary" name="buatakun">Submit</button>
            </form>

    </div>

    <?php

require('koneksi.php');

if(isset($_POST['buatakun'])){

    $username = strtolower(trim($_POST['username']));
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    // cek username
    $hasilCek = mysqli_query(
        $koneksi,
        "SELECT username FROM tbl_user WHERE username='$username'"
    );

    if(mysqli_fetch_assoc($hasilCek)){

        echo "<script>
                alert('Username sudah terdaftar');
              </script>";

    }else{

        $passwordHash =
            password_hash($password, PASSWORD_DEFAULT);

        $query = mysqli_query(
            $koneksi,
            "INSERT INTO tbl_user(username,password,email)
             VALUES(
                '$username',
                '$passwordHash',
                '$email'
             )"
        );

        if($query){

            echo "<script>
                    alert('Registrasi berhasil');
                  </script>";

        }else{

            echo mysqli_error($koneksi);

        }
    }
}
?>

</section>


   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>