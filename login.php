<?php
session_start();
include './resources/connect.php';


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM login WHERE email='$email' AND password='$password'";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query)) {
        $row = mysqli_fetch_assoc($query);
        $_SESSION['admin'] = $row['role'];
        header('location: index.php');
    } else {
        $message = "Admin login details incorrect";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login | QR Code Generator</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- Bootstrap offline -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="./assets/fontawesome-free-6.2.0-web/css/all.css">
</head>

<body>
    <div class="container py-3">

        <section class="vh-100">
            <div class="container-fluid h-custom">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-9 col-lg-6 col-xl-5">
                        <h1 class="text-primary">ONLINE CERTIFICATE VERIFICATION SYSTEM</h1>
                    </div>
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">

                        <form action="" method="POST">

                            <div class="divider d-flex align-items-center my-4">
                                <h1 class="text-center fw-bold mx-3 mb-0">Login</h1>
                            </div>
                            <?php
                            if (isset($message))
                                echo '<p class="alert alert-danger">' . $message . '</p>';
                            ?>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" id="form3Example3" class="form-control form-control-lg" name="email" placeholder="Enter a valid email address" required />
                                <label class="form-label" for="form3Example3">Email address</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-3">
                                <input type="password" id="form3Example4" class="form-control form-control-lg" name="password" placeholder="Enter password" required />
                                <label class="form-label" for="form3Example4">Password</label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">

                            </div>

                            <div class="text-center text-lg-start mt-4 pt-2">

                                <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;" name="submit">Login</button>

                            </div>

                        </form>
                        <br><br><br><br><br>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
                <!-- Copyright -->
                <div class="text-white mb-3 mb-md-0">
                    Copyright © Ehi 2024. All rights reserved.
                </div>
                <!-- Copyright -->

                <!-- Right -->
                <!-- <div>
                    <a href="#!" class="text-white me-4">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#!" class="text-white me-4">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#!" class="text-white me-4">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#!" class="text-white">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div> -->
                <!-- Right -->
            </div>
        </section>
    </div><!--/container-->

</body>

</html>