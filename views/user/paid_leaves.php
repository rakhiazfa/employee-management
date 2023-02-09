<?php

global $connection;

/**
 * Mengambil semua cuti.
 * 
 */

$paid_leaves = [];

$result = $connection->execute_query("SELECT * FROM paid_leaves JOIN employees ON paid_leaves.employee_id = employees.id");

while ($row = $result->fetch_assoc()) {

    array_push($paid_leaves, $row);
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
                        <h4>Formulir Cuti</h4>
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

                        <form action="<?php echo url('actions/paid_leaves/store') ?>" class="needs-validation row" novalidate="" method="POST">

                            <input type="hidden" name="employee_id" value="<?php echo $employeeId ?>">

                            <div class="form-group col-md-6">
                                <label>Dari Tanggal</label>
                                <input type="text" class="form-control datepicker" name="start" required>
                                <div class="invalid-feedback">
                                    Silahkan isi Tanggal.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Sampai Tanggal</label>
                                <input type="text" class="form-control datepicker" name="end" required>
                                <div class="invalid-feedback">
                                    Silahkan isi Tanggal.
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label>Alasan Mengambil Cuti</label>
                                <textarea class="form-control" name="description" rows="3" required></textarea>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary btn-lg" tabindex="4">
                                    Kirim Permohonan
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
                        <h4>Perizinan Cuti</h4>
                    </div>
                    <div class="card-body">

                        <?php if (hasFlash('success')) { ?>
                            <div class="alert alert-success">
                                <?php echo flash('success') ?>
                            </div>
                        <?php } ?>

                        <div class="table-responsive">
                            <table class="table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Cuti</th>
                                        <th>Lama</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($paid_leaves as $paid_leave) { ?>
                                        <tr>
                                            <td><?php echo $iteration++ ?></td>
                                            <td><?php echo date('d F Y', strtotime($paid_leave['start'])) . '  -  ' . date('d F Y', strtotime($paid_leave['end'])) ?></td>
                                            <td><?php echo $paid_leave['total'] . 'Hari' ?></td>
                                            <td><?php echo $paid_leave['description'] ?></td>
                                            <td>
                                                <?php if ($paid_leave['status'] === 'yes') { ?>
                                                    <div class="badge badge-success">
                                                        Diterima
                                                    </div>
                                                <?php } elseif ($paid_leave['status'] === 'no') { ?>
                                                    <div class="badge badge-danger">
                                                        Ditolak
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="badge badge-primary">
                                                        Diproses
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