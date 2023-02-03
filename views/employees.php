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
                                    <tr>
                                        <td>1</td>
                                        <th>001060704</th>
                                        <td>Rakhi Azfa Rifansya</td>
                                        <td>rakhiazfa0421@gmail.com</td>
                                        <td>
                                            <div class="d-flex align-items-center" style="gap: 1rem">
                                                <a href="#" class="btn btn-light">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <a href="#" class="btn btn-light">
                                                    <i class="fas fa-pen"></i>
                                                </a>

                                                <button type="submit" class="btn btn-light">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>

</div>