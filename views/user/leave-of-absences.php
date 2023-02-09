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
 * Mengambil semua cuti.
 * 
 */

$leaveOfAbsences = [];

$result = $connection->execute_query("SELECT 
leave_of_absences.*, 
leave_of_absence_histories.*, leave_of_absence_histories.id AS leave_of_absence_history_id, 
leave_of_absence_histories.employee_name AS employee_name_history, 
employees.*, employees.id AS employee_id, employees.name AS employee_name 
FROM leave_of_absences 
LEFT JOIN employees ON leave_of_absences.employee_id = employees.id 
LEFT JOIN leave_of_absence_histories ON leave_of_absence_histories.leave_of_absence_id = leave_of_absences.id 
WHERE employees.id = ? ORDER BY leave_of_absences.id DESC", [$employeeId]);

while ($row = $result->fetch_assoc()) {

    array_push($leaveOfAbsences, $row);
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
                        <h4>Permintaan Cuti</h4>
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

                        <form action="<?php echo url('actions/leave-of-absences/store') ?>" class="needs-validation row" novalidate="" method="POST">

                            <input type="hidden" name="employee_id" value="<?php echo $employeeId ?>">

                            <div class="form-group col-md-6">
                                <label>Dari</label>
                                <input type="text" class="form-control datepicker" name="start" required>
                                <div class="invalid-feedback">
                                    Silahkan isi waktu dimulainya cuti.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Sampai</label>
                                <input type="text" class="form-control datepicker" name="end" required>
                                <div class="invalid-feedback">
                                    Silahkan isi waktu selesainya cuti.
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label>Jenis Cuti</label>
                                <select class="form-control selectric" name="category" required>
                                    <option selected disabled>Pilih jenis cuti</option>
                                    <option value="Cuti Tahunan">Cuti Tahunan</option>
                                    <option value="Cuti Pernikahan">Cuti Pernikahan</option>
                                    <option value="Cuti Sakit">Cuti Sakit</option>
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
                                    Kirim Permintaan
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
                        <h4>Terkirim</h4>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Karyawan</th>
                                        <th>Mulai</th>
                                        <th>Selesai</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($leaveOfAbsences as $leaveOfAbsence) { ?>
                                        <tr>
                                            <td><?php echo $iteration++ ?></td>
                                            <th><?php echo $leaveOfAbsence['employee_name'] ?? $leaveOfAbsence['employee_name_history'] ?></th>
                                            <td><?php echo $leaveOfAbsence['start'] ?></td>
                                            <td><?php echo $leaveOfAbsence['end'] ?></td>
                                            <td><?php echo $leaveOfAbsence['category'] ?></td>
                                            <td>
                                                <?php if ($leaveOfAbsence['status'] === 'draft') { ?>
                                                    <div class="badge badge-primary">
                                                        Dalam Proses
                                                    </div>
                                                <?php } elseif ($leaveOfAbsence['status'] === 'accepted') { ?>
                                                    <div class="badge badge-success">
                                                        Diterima
                                                    </div>
                                                <?php } elseif ($leaveOfAbsence['status'] === 'rejected') { ?>
                                                    <div class="badge badge-danger">
                                                        Ditolak
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="badge badge-danger">
                                                        Tidak Diketahui
                                                    </div>
                                                <?php } ?>
                                            </td>
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