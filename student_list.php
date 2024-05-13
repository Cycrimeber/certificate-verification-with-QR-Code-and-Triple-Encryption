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

        <div class="row bg-secondary p-2 text-dark bg-opacity-10 pt-5 my-3">
            <div class="col-md-12">

                <h1 class="text-primary text-center pt-3 mb-5 fw-bolder m-auto">SYSTEM RECORDS</h1>

                <div class="row justify-content-center mb-5 col-md-10 mx-auto">

                    <table class="table table-striped">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Matric Number</th>
                                <th scope="col">Department</th>
                                <th scope="col">Email</th>
                                <th scope="col">Award</th>
                                <th scope="col">Certificate ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $query = mysqli_query($conn, "SELECT * FROM student");
                            while ($row = mysqli_fetch_assoc($query)) :
                            ?>
                                <tr>
                                    <th scope="row"><?= $count; ?></th>
                                    <td><?= ucwords($row['firstname'] . " " . $row['lastname']); ?></td>
                                    <td><?= strtoupper($row['matric_no']); ?></td>
                                    <td><?= ucwords($row['department']); ?></td>
                                    <td><?= $row['email']; ?></td>
                                    <td><?= $row['award']; ?></td>
                                    <td><?= $row['cert_id']; ?></td>
                                </tr>

                            <?php $count++;
                            endwhile; ?>
                        </tbody>
                    </table>
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