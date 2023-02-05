<?php

global $connection;

$result = $connection->execute_query("SELECT * FROM shifts");

$shifts = [];

while ($row = $result->fetch_assoc()) {

    array_push($shifts, $row);
}

$id = (int) $_GET['id'];

$result = $connection->execute_query("SELECT 
employees.*, users.email, users.id AS user_id, 
locations.*, locations.id AS location_id, 
identities.*, identities.id AS identity_id, identities.address AS ktp_address 
FROM employees 
JOIN users ON employees.user_id = users.id 
JOIN locations ON locations.employee_id = employees.id 
JOIN identities ON identities.employee_id = employees.id 
WHERE employees.id = ? 
LIMIT 1", [$id]);

$employee = $result->fetch_assoc();

if (!$employee) {

    header('Location: ' . env('APP_URL') . '/404');
    die();
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
                        <h4>Perbarui Data Karyawan</h4>
                    </div>
                    <div class="card-body">

                        <?php if (hasFlash('error')) { ?>
                            <div class="alert alert-danger">
                                <?php echo flash('error') ?>
                            </div>
                        <?php } ?>

                        <form action="<?php echo url('actions/employees/update') ?>" class="needs-validation row" novalidate="" method="POST">

                            <input type="hidden" name="employee_id" value="<?php echo $id ?>">
                            <input type="hidden" name="user_id" value="<?php echo $employee['user_id'] ?>">
                            <input type="hidden" name="identity_id" value="<?php echo $employee['identity_id'] ?>">
                            <input type="hidden" name="location_id" value="<?php echo $employee['location_id'] ?>">

                            <div class="form-group col-md-6">
                                <label>NIP</label>
                                <input type="text" class="form-control phone-number" name="nip" value="<?php echo $employee['nip'] ?>" required autofocus>
                                <div class="invalid-feedback">
                                    Silahkan isi NIP karyawan.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>NPWP ( Opsional )</label>
                                <input type="text" class="form-control phone-number" name="npwp" value="<?php echo $employee['npwp'] ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Nama Karyawan</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $employee['name'] ?>" required>
                                <div class="invalid-feedback">
                                    Silahkan isi nama karyawan.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Nomor Telepon</label>
                                <input type="text" class="form-control phone-number" name="phone" value="<?php echo $employee['phone'] ?>" required>
                                <div class="invalid-feedback">
                                    Silahkan isi nomor telepon karyawan.
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label>Shift</label>
                                <select class="form-control selectric" name="shift_id" required>
                                    <option selected disabled>Pilih shift karyawan</option>
                                    <?php foreach ($shifts as $shift) { ?>
                                        <option <?php echo $employee['shift_id'] === $shift['id'] ? 'selected' : '' ?> value="<?php echo $shift['id'] ?>">
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
                                <input type="text" class="form-control" name="nik" value="<?php echo $employee['nik'] ?>" required>
                                <div class="invalid-feedback">
                                    Silahkan isi NIK karyawan.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" name="place_of_birth" value="<?php echo $employee['place_of_birth'] ?>" required>
                                <div class="invalid-feedback">
                                    Silahkan isi tempat lahir karyawan.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Tanggal Lahir</label>
                                <input type="text" class="form-control datepicker" name="date_of_birth" value="<?php echo $employee['date_of_birth'] ?>" required>
                                <div class="invalid-feedback">
                                    Silahkan isi tanggal lahir karyawan.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Jenis Kelamin</label>
                                <select class="form-control selectric" name="gender" required>
                                    <option selected disabled>Pilih jenis kelamin</option>
                                    <option <?php echo $employee['gender'] === 'Pria' ? 'selected' : '' ?> value="Pria">Pria</option>
                                    <option <?php echo $employee['gender'] === 'Wanita' ? 'selected' : '' ?> value="Wanita">Wanita</option>
                                    <option <?php echo $employee['gender'] === null ? 'selected' : '' ?> value="">Tidak Diketahui</option>
                                </select>
                                <div class="invalid-feedback">
                                    Silahkan isi pilih shift karyawan.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Agama ( Opsional )</label>
                                <input type="text" class="form-control" value="<?php echo $employee['religion'] ?>" name="religion">
                            </div>

                            <div class="form-group col-12">
                                <label>Alamat KTP</label>
                                <textarea class="form-control" name="ktp_address" rows="3" required><?php echo $employee['ktp_address'] ?? '-' ?></textarea>
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
                                <input type="text" class="form-control" name="country" value="<?php echo $employee['country'] ?? 'Indonesia' ?>" required>
                                <div class="invalid-feedback">
                                    Silahkan isi negara karyawan.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Provinsi</label>
                                <input type="text" class="form-control" name="province" value="<?php echo $employee['province'] ?>" required>
                                <div class="invalid-feedback">
                                    Silahkan isi provinsi karyawan.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Kota</label>
                                <input type="text" class="form-control" name="city" value="<?php echo $employee['city'] ?>" required>
                                <div class="invalid-feedback">
                                    Silahkan isi kota karyawan.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Kode Pos</label>
                                <input type="text" class="form-control" name="postal_code" value="<?php echo $employee['postal_code'] ?>" required>
                                <div class="invalid-feedback">
                                    Silahkan isi kode pos karyawan.
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label>Alamat</label>
                                <textarea class="form-control" name="address" rows="3" required><?php echo $employee['address'] ?></textarea>
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
                                <input type="email" class="form-control" name="email" value="<?php echo $employee['email'] ?>" required>
                                <div class="invalid-feedback">
                                    Silahkan isi email karyawan.
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