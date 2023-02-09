<?php

global $connection;

/**
 * Mengambil semua cuti.
 * 
 */

$leaveOfAbsences = [];

$result = $connection->execute_query("SELECT 
leave_of_absences.*, 
employees.*, employees.id AS employee_id, employees.name AS employee_name 
FROM leave_of_absences 
JOIN employees ON leave_of_absences.employee_id = employees.id 
ORDER BY leave_of_absences.id DESC");

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
                <div class="card card-success">
                    <div class="card-header">
                        <h4>Perizinan Cuti</h4>
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
                                        <th>Mulai</th>
                                        <th>Selesai</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($leaveOfAbsences as $leaveOfAbsence) { ?>
                                        <tr>
                                            <td><?php echo $iteration++ ?></td>
                                            <th><?php echo $leaveOfAbsence['employee_name'] ?></th>
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
                                            <td>
                                                <?php if ($leaveOfAbsence['status'] === 'draft') { ?>
                                                    <div class="d-flex align-items-center" style="gap: 1rem;">
                                                        <form action="<?php echo url('actions/leave-of-absences/accept?id=' . $leaveOfAbsence['id']) ?>" method="POST">
                                                            <button type="submit" class="btn btn-success">
                                                                Terima
                                                            </button>
                                                        </form>

                                                        <form action="<?php echo url('actions/leave-of-absences/reject?id=' . $leaveOfAbsence['id']) ?>" method="POST">
                                                            <button type="submit" class="btn btn-danger">
                                                                Tolak
                                                            </button>
                                                        </form>
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