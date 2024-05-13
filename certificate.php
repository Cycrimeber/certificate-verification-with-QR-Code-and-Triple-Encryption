<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location: login.php');
}
include './resources/connect.php';

$mat_no = $_GET['mat_no'];

$sql = "SELECT * FROM student WHERE matric_no = '$mat_no';";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);
$qrcode = $row['qrcode'];
$firstname = $row['firstname'];
$lastname = $row['lastname'];
$cert_id = $row['cert_id'];
$department = $row['department'];
$award = $row['award'];
?>
<html>

<head>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap offline -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <style type='text/css'>
        body,
        html {
            margin: 0;
            padding: 0;
            margin: auto;
        }

        .myfs-1 {
            font-size: 40px;
        }

        .myfs-2 {
            font-size: 30px;
        }

        /* body {
            color: black;
            display: table;
            font-family: Georgia, serif;
            font-size: 24px;
            text-align: center;
        }

        .container {
            border: 20px solid tan;
            width: 750px;
            height: 563px;
            margin: auto;
            display: table-cell;
            vertical-align: middle;
        }

        .logo {
            color: tan;
        }

        .marquee {
            color: tan;
            font-size: 48px;
            margin: 20px;
        }

      */
        .person {
            border-bottom: 2px solid black;
            font-size: 32px;
            font-style: italic;
            margin: 20px auto;
            width: 400px;
        }

        .assignment {
            margin: 10px;
        }


        .reason {
            margin: 10px;
        }
    </style>
</head>

<body>
    <div class="container-fluid w-100">
        <div class="card text-center">
            <div class="card-header">
                <img src="./assets/images/logo.jpg" alt="School Logo" class="text-center" style="border-radius:25%; width:100px;">
                <h1 class="text-primary fw-bolder">Eagle Tech Institute</h1>
            </div>
            <div class="card-body">
                <p class="text-primary fw-bold text-right">CERT NO: <span class="text-success fs-4"><?= $cert_id; ?></span></p>

                <div class="fw-bold text-danger fs-1 mb-3">
                    STATEMENT OF RESULT
                </div>



                <h5 class="card-title fs-3">This is to certify that <span class="person fw-bold"><?= ucfirst($firstname) . ' ' . ucfirst($lastname); ?></span> <br><br> with Matriculation Number <span class="person fw-bold"><?= strtoupper($mat_no); ?></span></h5>

                <br>
                <p class="card-text fs-3">has satisfied the condition for the award of <span class="person fw-bold"><?= $award; ?></span> <br> <br> in <span class="person fw-bold"><?= $department; ?></span></p>
                <br>
                <div class="reason">
                    Please accept my congratulations
                </div>

                <div class="qrcode">
                    <?php echo '<img src="' . $qrcode . '" /><hr/>';
                    ?>
                </div>
            </div>
            <div class="card-footer text-muted">
                <button onclick="window.print()" class="btn btn-primary">Save Certificate</button>
                <a href="./index.php" class="btn btn-success">Create Another Certificate</a>
                <a href="./QRCodeScanner/scandocument.php" class="btn btn-success">Verify Certificate</a>

            </div>
        </div>
    </div>

    <script src="./assets/js/bootstrap.min.js"></script>
</body>

</html>