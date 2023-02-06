<?php

global $connection;

/**
 * Mengambil semua absensi.
 * 
 */

$presences = [];

$result = $connection->execute_query("SELECT 
presences.*, 
employees.name AS employee_name, 
shifts.name AS shift_name, 
shifts.start AS shift_start, 
shifts.end AS shift_end, 
presence_histories.*, 
presence_histories.id AS  presence_history_id 
FROM presences 
LEFT JOIN employees ON presences.employee_id = employees.id 
LEFT JOIN shifts ON employees.shift_id = shifts.id 
LEFT JOIN presence_histories ON presence_histories.presence_id = presences.id 
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
                                        <th>Karyawan</th>
                                        <th>Tanggal</th>
                                        <th>Waktu Absen</th>
                                        <th>Waktu Terlambat</th>
                                        <th colspan="2">Shift</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($presences as $presence) { ?>
                                        <tr>
                                            <td rowspan="3"><?php echo $iteration++ ?></td>
                                            <th rowspan="3"><?php echo $presence['employee_name'] ?></th>
                                            <td rowspan="3"><?php echo date('d F Y', strtotime($presence['date'])) ?></td>
                                            <td rowspan="3"><?php echo $presence['presence_time'] ?></td>
                                            <td rowspan="3"><?php echo $presence['late_time'] . ' Menit' ?></td>
                                            <td colspan="2" class="text-center"><?php echo $presence['shift_name'] ?></td>
                                            <td rowspan="3">
                                                <?php if ($presence['status'] === 'Present') { ?>
                                                    <div class="badge badge-success">
                                                        Hadir
                                                    </div>
                                                <?php } elseif ($presence['status'] === 'Sick') { ?>
                                                    <div class="badge badge-primary">
                                                        Sakit
                                                    </div>
                                                <?php } elseif ($presence['status'] === 'Permission') { ?>
                                                    <div class="badge badge-warning">
                                                        Izin
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="badge badge-danger">
                                                        Alpa
                                                    </div>
                                                <?php } ?>
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