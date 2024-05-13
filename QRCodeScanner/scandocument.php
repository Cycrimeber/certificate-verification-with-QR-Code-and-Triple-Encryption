<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header('location: login.php');
}

include "../phpqrcode/qrlib.php";

require '../vendor/autoload.php';

use Zxing\QrReader;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>QR Code Scanner</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../assets/css/scanqrcode.css" />

  <!-- USE SWEET ALERT -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
  </link>

  <!-- Bootstrap offline -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body class="bg-secondary-subtle">
  <?php
  include '../includes/nav_scanner.php';
  ?>

  <div class="container pt-5">

    <h1 class="text-primary text-center fw-bold my-5 pt-5">VERIFY CERTIFICATE</h1>
    <div class="buttons">
      <a href="../index.php" class="btn btn-success">Create Another Certificate</a>

    </div>
    <div id="container" class="d-flex justify-content-between mt-5 bg-light rounded-3 shadow-sm p-3 bg-body">
      <div id="scanDocument" class="col-md-6 h-100 m-auto">
        <!-- Video element for displaying webcam stream -->
        <video id="video" playsinline></video>
        <!-- Image element for displaying scanned QR code -->
        <img id="scannedImage">
        <!-- Div element for displaying QR code data -->
        <div id="qrData"></div>
        <!-- Div element for containing buttons -->
        <div id="buttons">
          <!-- Button for initiating webcam QR code scanning -->
          <button class="button" id="webcamButton">Scan Certificate from Webcam Scanner</button>
          <!-- Label for file input -->
          <label for="fileInput">Scan Certificate from image</label>
          <!-- File input for selecting an image file -->
          <input type="file" accept="image/*" id="fileInput">
        </div>
      </div>

      <div id="viewDetail" class="col-md-6 h-100" style="display:none">
        <h1 class="text-center text-success py-4 fw-bolder">Result Details</h1>

        <?php
        // $imagePath = '../temp/ehi.png';
        // Use Zxing to scan and decode value of qrcode
        // $qrScan = new QrReader($imagePath);
        // $qrCodeData = $qrScan->text();
        // Process the data
        // echo "QR Code Data:" . $qrScan->text();

        ?>

        <div class="card mx-auto my-2" style="width: 30rem;">
          <div class="card-header text-center fs-2 fw-bold text-primary  ">
            Certificate Details
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item fs-4">Student Name: <span class="text-success" id="name"></span></li>
            <li class="list-group-item fs-4">Matric Number: <span class="text-success" id="matric_no"></li>
            <li class="list-group-item fs-4">Department: <span class="text-success" id="department"></li>
            <li class="list-group-item fs-4">Certificate ID: <span class="text-success" id="cert_id"></li>
          </ul>
          <div class="card-footer fs-3 text-success text-center fw-bold" id="message">

          </div>
        </div>

      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
  <script src="../assets/js/scanqrcode.js"></script>
  <script>
    // $(document).ready(function() {
    const name = document.getElementById('name');
    const cert_id = document.getElementById('cert_id');
    const mat_no = document.getElementById('matric_no');
    const department = document.getElementById('department');
    const viewDetail = document.getElementById('viewDetail');
    const message = document.getElementById('message');

    function sendQrData() {
      const qrData = document.getElementById('qrData').innerHTML;
      $.ajax({
        url: '../processqr.php', // the url where we want to send the request
        type: 'GET', // the type of request, either GET or POST
        data: {
          qrData: qrData
        }, // the data we want to send to the server
        dataType: 'json', // the type of data we expect back from the server
        success: function(response) {
          // this function is called if the request is successful
          // 'response' is the data that the server returned
          // console.log(response.message); // logs the response to the console

          if (response.message == 1) {
            swal("Confirmed!", "This certificate is verified!", "success");
            viewDetail.style.display = 'block';
            name.innerHTML = response.firstname + " " + response.lastname;
            mat_no.innerHTML = response.matric_no;
            department.innerHTML = response.department;
            message.innerHTML = 'Certificate Authenticated';
            cert_id.innerHTML = response.cert_id;
          }

          if (response.message == 2) {
            swal("Failed!", "Record not found!", "error");
            viewDetail.style.display = 'block';
            name.innerHTML = '';
            mat_no.innerHTML = '';
            department.innerHTML = '';
            message.innerHTML = '<span class="text-danger">Cannot verify certificate on this system!</span>';
            cert_id.innerHTML = '';
          }


        },
        error: function(xhr, status, error) {


          // this function is called if the request fails
          console.log(xhr.responseText); // logs the error to the console
        }
      });
    }


    // });
  </script>

  <script src="./assets/js/bootstrap.min.js"></script>
</body>

</html>