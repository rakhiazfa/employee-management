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
                        <h4>Tambah Karyawan Baru</h4>
                    </div>
                    <div class="card-body">

                        <?php if (hasFlash('error')) { ?>
                            <div class="alert alert-danger">
                                <?php echo flash('error') ?>
                            </div>
                        <?php } ?>

                        <form action="<?php echo url('actions/employees/store') ?>" class="needs-validation row" novalidate="" method="POST">

                            <div class="form-group col-md-6">
                                <label>NIP</label>
                                <input type="text" class="form-control phone-number" name="nip" required autofocus>
                                <div class="invalid-feedback">
                                    Silahkan isi NIP karyawan.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>NPWP ( Opsional )</label>
                                <input type="text" class="form-control phone-number" name="npwp">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Nama Karyawan</label>
                                <input type="text" class="form-control" name="name" required>
                                <div class="invalid-feedback">
                                    Silahkan isi nama karyawan.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Nomor Telepon</label>
                                <input type="text" class="form-control phone-number" name="phone" required>
                                <div class="invalid-feedback">
                                    Silahkan isi nomor telepon karyawan.
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label>Shift</label>
                                <select class="form-control selectric" name="shift_id" required>
                                    <option selected disabled>Pilih shift karyawan</option>
                                    <?php foreach ($shifts as $shift) { ?>
                                        <option value="<?php echo $shift['id'] ?>">
                                            <?php echo $shift['name'] ?> |
                                            <?php echo $shift['start'] ?> -
                                            <?php echo $shift['end'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Silahkan isi pilih shift karyawan.
                                </div>
                            </div>

                            <div class="col-12 my-3">
                                <h5>Identitas Karyawan</h5>
                                <hr>
                            </div>

                            <div class="form-group col-12">
                                <label>NIK</label>
                                <input type="text" class="form-control" name="nik" required>
                                <div class="invalid-feedback">
                                    Silahkan isi NIK karyawan.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" name="place_of_birth" required>
                                <div class="invalid-feedback">
                                    Silahkan isi tempat lahir karyawan.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Tanggal Lahir</label>
                                <input type="text" class="form-control datepicker" name="date_of_birth" value="2000-07-03" required>
                                <div class="invalid-feedback">
                                    Silahkan isi tanggal lahir karyawan.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Jenis Kelamin</label>
                                <select class="form-control selectric" name="gender" required>
                                    <option selected disabled>Pilih jenis kelamin</option>
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                    <option value="">Tidak Diketahui</option>
                                </select>
                                <div class="invalid-feedback">
                                    Silahkan isi pilih shift karyawan.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Agama ( Opsional )</label>
                                <input type="text" class="form-control" name="religion">
                            </div>

                            <div class="form-group col-12">
                                <label>Alamat KTP</label>
                                <textarea class="form-control" name="ktp_address" rows="3" required></textarea>
                                <div class="invalid-feedback">
                                    Silahkan isi alamat ktp karyawan.
                                </div>
                            </div>

                            <div class="col-12 my-3">
                                <h5>Alamat Karyawan</h5>
                                <hr>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Negara</label>
                                <input type="text" class="form-control" name="country" value="Indonesia" required>
                                <div class="invalid-feedback">
                                    Silahkan isi negara karyawan.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Provinsi</label>
                                <input type="text" class="form-control" name="province" required>
                                <div class="invalid-feedback">
                                    Silahkan isi provinsi karyawan.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Kota</label>
                                <input type="text" class="form-control" name="city" required>
                                <div class="invalid-feedback">
                                    Silahkan isi kota karyawan.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Kode Pos</label>
                                <input type="text" class="form-control" name="postal_code" required>
                                <div class="invalid-feedback">
                                    Silahkan isi kode pos karyawan.
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label>Alamat</label>
                                <textarea class="form-control" name="address" rows="3" required></textarea>
                                <div class="invalid-feedback">
                                    Silahkan isi alamat karyawan.
                                </div>
                            </div>

                            <div class="col-12 my-3">
                                <h5>Akun</h5>
                                <hr>
                            </div>

                            <div class="form-group col-12">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" required>
                                <div class="invalid-feedback">
                                    Silahkan isi email karyawan.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Kata Sandi</label>
                                <input type="password" class="form-control" name="password" required>
                                <div class="invalid-feedback">
                                    Silahkan isi kata sandi karyawan.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>konfirmasi Kata Sandi</label>
                                <input type="password" class="form-control" name="password_confirmation" required>
                                <div class="invalid-feedback">
                                    Silahkan konfirmasi kata sandi karyawan.
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