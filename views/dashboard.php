<?php
global $connection;

$result = $connection->execute_query("SELECT * FROM employees");
$result1 = $connection->execute_query("SELECT * FROM presences");
$result2 = $connection->execute_query("SELECT * FROM presence_histories");

$totalEmployee = mysqli_num_rows($result);
$totalPresence = mysqli_num_rows($result1);
$totalReport = mysqli_num_rows($result2);
?>

<div class="navbar-bg"></div>

<!-- Topbar -->

<?php topbar() ?>

<!-- Sidebar -->
<?php sidebar() ?>

<!-- Main Content -->
<div class="main-content">

    <section class="section">

        <div class="row">

            <div class="col-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h4>Dashboard</h4>
                    </div>
                    <div class="card-body">
                        <p>Selamat datang kembali, <?php echo $_SESSION['user']['name'] ?>.</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Karyawan</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $totalEmployee; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Kehadiran Karyawan</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $totalPresence; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-file-signature"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Laporan Kehadiran</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $totalReport; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
</div>