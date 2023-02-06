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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Daftar Karyawan</h4>
                        <div>
                            <a href="<?php echo url('presences/create') ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                                <span>Tambah Karyawan</span>
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
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Masuk</th>
                                        <th>Keluar</th>
                                        <th>Telat (Mnt)</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($presences as $presence) { ?>
                                        <tr>
                                            <td><?php echo $iteration++ ?></td>
                                            <th><?php echo $presence['name'] ?></th>
                                            <td><?php echo $presence['date'] ?></td>
                                            <td><?php echo $presence['start'] ?></td>
                                            <td><?php echo $presence['end'] ?></td>
                                            <td><?php echo $presence['late_time'] ?></td>
                                            <td>
                                                <div class="d-flex align-items-center" style="gap: 1rem">
                                                    <a href="<?php echo url('presences/detail?id=' . $presence['id']) ?>" class="btn btn-light">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <a href="<?php echo url('presences/edit?id=' . $presence['id']) ?>" class="btn btn-light">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <form action="<?php echo url('actions/presences/delete') ?>" method="post">
                                                        <input type="hidden" name="user_id" value="<?php echo $presence['user_id'] ?>">
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