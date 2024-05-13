<?php

$conn = mysqli_connect('localhost', 'root', '', 'qrcertificate');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
