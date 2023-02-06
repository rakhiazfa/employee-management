<?php

global $connection;

$result = $connection->execute_query("SELECT * FROM shifts");

$shifts = [];

while ($row = $result->fetch_assoc()) {

    array_push($shifts, $row);
}

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
                        <h4>Tambah Shift Baru</h4>
                    </div>
                    <div class="card-body">

                        <?php if (hasFlash('error')) { ?>
                            <div class="alert alert-danger">
                                <?php echo flash('error') ?>
                            </div>
                        <?php } ?>

                        <form action="<?php echo url('actions/shifts/store') ?>" class="needs-validation row" novalidate="" method="POST">

                            <div class="form-group col-md-12">
                                <label>Nama Shift</label>
                                <input type="text" class="form-control " name="name" required>
                                <div class="invalid-feedback">
                                    Silahkan isi Nama Shift.
                                </div>
                            </div>


                            <div class="form-group col-md-6">
                                <label>Masuk</label>
                                <input type="text" class="form-control timepicker" name="start" value="00:00" required>
                                <div class="invalid-feedback">
                                    Silahkan isi Masuk Shift.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Keluar</label>
                                <input type="text" class="form-control timepicker" name="end" value="00:00" required>
                                <div class="invalid-feedback">
                                    Silahkan isi Keluar Shift.
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary btn-lg" tabindex="4">
                                    Tambah
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </section>

</div>