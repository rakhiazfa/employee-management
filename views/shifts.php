<?php

global $connection;

/**
 * Mengambil semua karyawan.
 * 
 */

$shifts = [];

$result = $connection->execute_query("SELECT * FROM shifts");

while ($row = $result->fetch_assoc()) {

    array_push($shifts, $row);
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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Daftar shift</h4>
                        <div>
                            <a href="<?php echo url('shifts/create') ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                                <span>Tambah shift</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        <?php if (hasFlash('success')) { ?>
                            <div class="alert alert-success">
                                <?php echo flash('success') ?>
                            </div>
                        <?php } ?>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($shifts as $shift) { ?>
                                        <tr>
                                            <td><?php echo $iteration++ ?></td>
                                            <th><?php echo $shift['name'] ?></th>
                                            <td><?php echo date('H:i:s', strtotime($shift['start'])) ?></td>
                                            <td><?php echo date('H:i:s', strtotime($shift['end'])) ?></td>
                                            <td>
                                                <div class="d-flex align-items-center" style="gap: 1rem">

                                                    <a href="<?php echo url('shifts/edit?id=' . $shift['id']) ?>" class="btn btn-light">
                                                        <i class="fas fa-pen"></i>
                                                    </a>

                                                    <form action="<?php echo url('actions/shifts/delete?id=' . $shift['id']) ?>" method="post">
                                                        <input type="hidden" name="user_id" value="<?php echo $shift['user_id'] ?? '' ?>">
                                                        <button type="submit" class="btn btn-light" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
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