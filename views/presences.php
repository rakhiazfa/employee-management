<?php

global $connection;

/**
 * Mengambil semua absensi.
 * 
 */

$presences = [];

$result = $connection->execute_query("SELECT presences.*, employees.name, 
shifts.name AS shift_name ,
shifts.start AS shift_start,
shifts.end AS shift_end
FROM presences 
JOIN employees ON presences.employee_id = employees.id 
JOIN shifts ON employees.shift_id = shifts.id
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
                                    <?php foreach ($presences as $presence) { ?>
                                        <tr>
                                            <td rowspan="3"><?php echo $iteration++ ?></td>
                                            <th rowspan="3"><?php echo $presence['name'] ?></th>
                                            <td rowspan="3"><?php echo $presence['date'] ?></td>
                                            <td rowspan="3"><?php echo $presence['presence_time'] ?></td>
                                            <td rowspan="3"><?php echo $presence['late_time'] ?></td>
                                            <td colspan="2" class="text-center"><?php echo $presence['shift_name'] ?></td>
                                            <td rowspan="3">
                                                <div class="badge badge-success"><?php echo $presence['status'] ?></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Start</th>
                                            <th><?php echo $presence['shift_start'] ?></th>
                                        </tr>
                                        <tr>
                                            <th>End</th>
                                            <th><?php echo $presence['shift_end'] ?></th>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>

</div>