<?php

global $connection;

/**
 * Mengambil semua karyawan.
 * 
 */

$employees = [];

$result = $connection->execute_query("SELECT employees.*, users.email FROM employees 
JOIN users ON employees.user_id = users.id 
ORDER BY employees.id DESC");

while ($row = $result->fetch_assoc()) {

    array_push($employees, $row);
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
                            <a href="<?php echo url('employees/create') ?>" class="btn btn-primary">
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
                                        <th>NIP</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($employees as $employee) { ?>
                                        <tr>
                                            <td><?php echo $iteration++ ?></td>
                                            <th><?php echo $employee['nip'] ?></th>
                                            <td><?php echo $employee['name'] ?></td>
                                            <td><?php echo $employee['email'] ?></td>
                                            <td>
                                                <div class="d-flex align-items-center" style="gap: 1rem">
                                                    <a href="<?php echo url('employees/detail?id=' . $employee['id']) ?>" class="btn btn-light">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <a href="<?php echo url('employees/edit?id=' . $employee['id']) ?>" class="btn btn-light">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <form action="<?php echo url('actions/employees/delete') ?>" method="post">
                                                        <input type="hidden" name="user_id" value="<?php echo $employee['user_id'] ?>">
                                                        <button type="submit" class="btn btn-light">
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