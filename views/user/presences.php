<?php

global $connection;

$userId = $_SESSION['user']['id'];

$result = $connection->execute_query("SELECT 
employees.*, 
employees.id AS employee_id, 
users.id AS user_id, 
users.email,
shifts.id AS shift_id, 
shifts.name AS shift_name, 
shifts.start AS shift_start, 
shifts.end AS shift_end 
FROM employees 
JOIN users ON employees.user_id = users.id 
JOIN shifts ON employees.shift_id = shifts.id 
WHERE users.id = ?", [$userId]);

$user = $result->fetch_assoc();

$employeeId = $user['employee_id'] ?? '';

/**
 * Cek apakah karyawan sudah mengirim kehadiran sebelumnya.
 * 
 */

$result = $connection->execute_query("SELECT * FROM presences WHERE date = ? AND employee_id = ?", [date('Y-m-d'), $employeeId]);

$checkPresence = $result->fetch_assoc();

/**
 * Cek waktu saat karyawan mengirim kehadiran.
 * 
 */

$now = date('H:i:s');
$checkShift = false;

if (strtotime($now) < strtotime($user['shift_start'] ?? '') || strtotime($now) > strtotime($user['shift_end'] ?? '')) {

    $checkShift = true;
}

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

                <div class="card card-success <?php echo $checkPresence || $checkShift ? 'card-disabled' : '' ?>">
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
                                            <th rowspan="3"><?php echo $presence['name'] ?? '' ?></th>
                                            <td rowspan="3"><?php echo date('d F Y', strtotime($presence['date'] ?? '')) ?></td>
                                            <td rowspan="3"><?php echo $presence['presence_time'] ?? '' ?></td>
                                            <td rowspan="3"><?php echo $presence['late_time'] . ' Menit' ?></td>
                                            <td colspan="2" class="text-center"><?php echo $presence['shift_name'] ?? '' ?></td>
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
                                            <th><?php echo $presence['shift_start'] ?? '' ?></th>
                                        </tr>
                                        <tr>
                                            <th>End</th>
                                            <th><?php echo $presence['shift_end'] ?? '' ?></th>
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