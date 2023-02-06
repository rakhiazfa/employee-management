<?php

global $connection;

$id = (int) $_GET['id'];

$shifts = [];

$result = $connection->execute_query("SELECT * FROM shifts WHERE id = ? LIMIT 1 ", [$id]);



$shift = $result->fetch_assoc();



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
                        <h4>Perbarui Data Shift</h4>
                    </div>
                    <div class="card-body">

                        <?php if (hasFlash('error')) { ?>
                            <div class="alert alert-danger">
                                <?php echo flash('error') ?>
                            </div>
                        <?php } ?>

                        <form action="<?php echo url('actions/shifts/update?id=' . $shift['id']) ?>" class="needs-validation row" novalidate="" method="POST">


                            <div class="form-group col-md-6">
                                <label>Nama Shift</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $shift['name'] ?>" required>
                                <div class="invalid-feedback">
                                    Silahkan isi nama shift.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Masuk</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control timepicker" name="start" value="<?php echo date('H:i:s', strtotime($shift['start'])) ?>" required>
                                    <div class="invalid-feedback">
                                        Silahkan isi Masuk Shift.
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Keluar</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control timepicker" name="end" value="<?php echo date('H:i:s', strtotime($shift['end'])) ?>" required>
                                    <div class="invalid-feedback">
                                        Silahkan isi Keluar Shift.
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary btn-lg" tabindex="4">
                                    Simpan
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </section>

</div>