<?php
session_start();

if (isset($_SESSION["login"])) {
    header("Location:index.php");
    exit;
}

include 'koneksi.php';

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($con, "SELECT * FROM user WHERE username = '$username'");

    //cek username
    if (mysqli_num_rows($result) === 1) {
        //cek pass
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            //set session
            $_SESSION["login"] = true;

            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>


<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-7">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login SPK KELULUSAN PRAKERIN TKJ </h1>
                                    </div>


                                    <form class="" method="POST" action="">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Enter Username..." value="" required>
                                            <?php
                                            if (isset($error)) : ?>
                                                <p style="color :red ">username salah</p>
                                            <?php endif; ?>

                                        </div>
                                        <div class="form-group">
                                            <input type="password" required class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                            <?php
                                            if (isset($error)) : ?>
                                                <p style="color :red ">password salah</p>
                                            <?php endif; ?>

                                        </div>
                                        <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="registrasi.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>

    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

</body>

</html>