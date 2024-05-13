<?php
session_start();
include './resources/connect.php';

if (!isset($_SESSION['admin'])) {
	header('location: login.php');
}

include './includes/header.php';
?>

<body>
	<!-- Navigation -->
	<?php
	include './includes/nav.php';
	?>
	<div class="container-fluid py-3">

		<div class="row bg-secondary p-2 text-dark bg-opacity-10">
			<div class="col-md-12">


				<h1 class="text-primary text-center pt-5 my-3 fw-bolder ">GENERATE CERTIFICATE</h1>

				<div class="row justify-content-center mt-3">

					<div class="col-md-6">
						<!-- form user info -->
						<div class="card card-outline-success">
							<div class="card-header">

								<h3 class="mb-0 text-success text-center">Student Information </h3>
							</div>

							<div class="card-body col-md-12">


								<?php
								include "phpqrcode/qrlib.php";
								$PNG_TEMP_DIR = 'temp/';
								if (!file_exists($PNG_TEMP_DIR))
									mkdir($PNG_TEMP_DIR);

								$filename = $PNG_TEMP_DIR . 'test.png';
								$matric_number = "";
								$cert_id = "";
								if (isset($_POST["btnsubmit"])) {

									$first_name = $_POST["first_name"];
									$last_name = $_POST["last_name"];
									$email = $_POST["email"];
									$matric_number = $_POST["mat_no"];
									$department = $_POST["department"];
									$cert_id = $_POST["cert_id"];
									$award = $_POST["award"];

									$sql_mat = "SELECT * FROM student WHERE matric_no='$matric_number'";

									$sql_certid = "SELECT * FROM student WHERE cert_id='$cert_id'";

									$res_mat = mysqli_query($conn, $sql_mat);
									$res_certid = mysqli_query($conn, $sql_certid);

									if (mysqli_num_rows($res_mat) > 0) {
										$matric_error = "Sorry... Matric Number already exists!";
									} else if (mysqli_num_rows($res_certid) > 0) {
										$cert_error = "Sorry... certificate ID already assigned";
									} else {
										$codeString = $cert_id;
										// $codeString = 'This is the data to be encrypted.';
										$key = 'deagletechsolutions';
										// $iv = 'This is the initialization vector.';
										$iv = 'deagle06';
										// $iv = openssl_random_pseudo_bytes();
										$encryptedData = openssl_encrypt($codeString, 'DES-EDE3-CBC', $key, 0, $iv);
										// echo $encryptedData;

										// $filename = $PNG_TEMP_DIR . 'test' . md5($codeString) . '.png';
										$filename = $PNG_TEMP_DIR . 'test' . base64_encode($encryptedData) . '.png';

										QRcode::png($codeString, $filename);

										$sql = "INSERT INTO student (firstname, lastname, matric_no, email, department, qrcode, cert_id, award) VALUES ('$first_name', '$last_name', '$matric_number', '$email', '$department', '$filename', $cert_id, '$award');";
										$query = mysqli_query($conn, $sql);
										if ($query) {
											echo '<img src="' . $PNG_TEMP_DIR . basename($filename) . '" /><hr/>';

											header("Location: ./certificate.php?mat_no=" . $matric_number);
										}
										exit();
									}
								}
								?>


								<form autocomplete="off" class="form" role="form" action="index.php" method="post">
									<div class="form-group row mb-3">
										<label class="col-lg-4 col-form-label form-control-label text-primary fs-5">First name</label>
										<div class="col-lg-8">
											<input class="form-control" type="text" name="first_name" placeholder="Enter Student Firstname..." value="<?= @$first_name;
																																						?>">
										</div>
									</div>
									<div class="form-group row mb-3">
										<label class="col-lg-4 col-form-label form-control-label text-primary fs-5">Last name</label>
										<div class="col-lg-8">
											<input class="form-control" type="text" required value="<?php echo @$last_name;
																									?>" name="last_name" placeholder="Enter Student Surname...">
										</div>
									</div>
									<div class="form-group row mb-3">
										<label class="col-lg-4 col-form-label form-control-label text-primary fs-5">Email</label>
										<div class="col-lg-8">
											<input class="form-control" type="email" required value="<?php echo @$email;
																										?>" name="email" placeholder="Enter Student Valid Email...">
										</div>
									</div>
									<div class="form-group row mb-4">
										<label class="col-lg-4 col-form-label form-control-label text-primary fs-5">Matric Number</label>
										<div class="col-lg-8">
											<input class="form-control" type="text" required value="<?php echo @$matric_number;
																									?>" name="mat_no" placeholder="Enter Student Matriculation Number...">
											<?php if (isset($matric_error)) : ?>
												<span class="text-danger"><?php echo $matric_error; ?></span>
											<?php endif ?>
										</div>
									</div>
									<div class="form-group row mb-4">
										<label class="col-lg-4 col-form-label form-control-label text-primary fs-5">Department</label>
										<div class="col-lg-8">
											<input class="form-control" type="text" required value="<?php echo @$department;
																									?>" name="department" placeholder="Enter Student Department...">
										</div>
									</div>
									<div class="form-group row mb-3">
										<label class="col-lg-4 col-form-label form-control-label text-primary fs-5">Award</label>
										<div class="col-lg-8">
											<input class="form-control" type="text" required value="<?php echo @$award; ?>" name="award" placeholder="Enter Result Awarded...">
										</div>
									</div>


									<div class="form-group row mb-3">
										<label class="col-lg-4 col-form-label form-control-label text-primary fs-5">Certificate ID</label>
										<div class="col-lg-8">
											<input class="form-control" type="text" required value="<?php echo @$cert_id;
																									?>" name="cert_id" placeholder="Enter Certificate Number...">
											<?php if (isset($cert_error)) : ?>
												<span class="text-danger"><?= $cert_error; ?></span>
											<?php endif ?>
										</div>
									</div>
									<div class="form-group row mb-3">
										<label class="col-lg-4 col-form-label form-control-label text-primary fs-5"></label>
										<div class="col-lg-8">
											<input class="btn btn-primary" type="submit" name="btnsubmit" value="Generate Certificate">
											<a href="./QRCodeScanner/scandocument.php" class="btn btn-secondary">Verify Certificate</a>
										</div>
										<div class="col-md">

										</div>
									</div>
								</form>

							</div>
						</div><!-- /form user info -->
					</div>
				</div>

			</div><!--/col-->
		</div><!--/row-->

	</div><!--/container-->
	<?php
	include "./includes/footer.php";
	?>

	<!-- bootstrap offline JS -->
	<script src="./assets/js/bootstrap.min.js"></script>
</body>

</html>