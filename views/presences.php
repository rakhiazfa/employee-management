<?php

global $connection;

/**
 * Mengambil semua absensi.
 * 
 */

$presences = [];

$result = $connection->execute_query("SELECT presences.*, employees.name FROM presences 
JOIN employees ON presences.employee_id = employees.id 
ORDER BY presences.id DESC");

while ($row = $result->fetch_assoc()) {

    array_push($presences, $row);
}

$iteration = 1;

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
                        <h4>Kehadiran Karyawan</h4>
                    </div>
                    <div class="card-body">

                        <?php if (hasFlash('success')) { ?>
                            <div class="alert alert-success">
                                <?php echo flash('success') ?>
                            </div>
                        <?php } ?>

                        <div class="table-responsive">
                            <table class="table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Employee</th>
                                        <th>Date</th>
                                        <th>Presence Time</th>
                                        <th>Late Time</th>
                                        <th colspan="2">Shift</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="3">1</td>
                                        <th rowspan="3">Rakhi Azfa Rifansya</th>
                                        <td rowspan="3">20 July 2004</td>
                                        <td rowspan="3">08:00</td>
                                        <td rowspan="3">0 Minutes</td>
                                        <td colspan="2" class="text-center">Shift Pagi</td>
                                        <td rowspan="3">
                                            <div class="badge badge-success">Present</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Start</th>
                                        <th>08:00</th>
                                    </tr>
                                    <tr>
                                        <th>End</th>
                                        <th>10:00</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>

</div>