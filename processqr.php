<?php
include './resources/connect.php';
header("Content-Type: application/json");

$qrData = $_GET['qrData'];

$sql = "SELECT * FROM student WHERE cert_id = '$qrData';";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) == 1) {
    $row = mysqli_fetch_assoc($query);
    $certid = $row['cert_id'];

    $fname = $row['firstname'];
    $lname = $row['lastname'];
    $matric_no = strtoupper($row['matric_no']);
    $department = $row['department'];
    $email = $row['email'];
    $cert_id = $certid;

    echo json_encode(array(
        "message" => 1,
        "firstname" => $fname,
        "lastname" => $lname,
        "matric_no" => $matric_no,
        "department" => $department,
        "email" => $email,
        "cert_id" => $cert_id
    ));
} else {
    echo json_encode(array(
        "message" => 2,
    ));
}
