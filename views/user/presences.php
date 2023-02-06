<?php

global $connection;

$userId = $_SESSION['user']['id'];

$result = $connection->execute_query("SELECT 
users.*, 
employees.*, employees.id AS employee_id 
FROM users 
JOIN employees ON employees.user_id = users.id 
WHERE users.id = ? LIMIT 1", [$userId]);

$user = $result->fetch_assoc();

$employeeId = $user['employee_id'];

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
 WHERE presences.employee_id = ? 
 ORDER BY presences.id DESC", [$employeeId]);

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
                        <h4>Formulir Kehadiran</h4>
                    </div>
                    <div class="card-body">

                        <?php if (hasFlash('error')) { ?>
                            <div class="alert alert-danger">
                                <?php echo flash('error') ?>
                            </div>
                        <?php } ?>

                        <?php if (hasFlash('success')) { ?>
                            <div class="alert alert-success">
                                <?php echo flash('success') ?>
                            </div>
                        <?php } ?>

                        <form action="<?php echo url('actions/presences/store') ?>" class="needs-validation row" novalidate="" method="POST">

                            <input type="hidden" name="employee_id" value="<?php echo $employeeId ?>">

                            <div class="form-group col-12">
                                <label>Kondisi Anda</label>
                                <select class="form-control selectric" name="status" required>
                                    <option selected disabled>Pilih kondisi anda</option>
                                    <option value="Present">Hadir</option>
                                    <option value="Permission">Izin</option>
                                    <option value="Sick">Sakit</option>
                                </select>
                                <div class="invalid-feedback">
                                    Silahkan isi pilih shift karyawan.
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label>Keterangan ( Opsional )</label>
                                <textarea class="form-control" name="description" rows="3"></textarea>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary btn-lg" tabindex="4">
                                    Kirim Kehadiran
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h4>Riwayat Kehadiran</h4>
                    </div>
                    <div class="card-body">

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