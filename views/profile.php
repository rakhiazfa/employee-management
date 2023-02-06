<?php

global $connection;

$user = $_SESSION['user'];
$userId = $user['id'];

if ($user['role'] === 'employee') {

    $result = $connection->execute_query("SELECT 
    employees.*, 
    employees.id AS employee_id, 
    users.*,
    users.id AS user_id, 
    shifts.id AS shift_id, 
    shifts.name AS shift_name, 
    shifts.start AS shift_start, 
    shifts.end AS shift_end, 
    locations.*, 
    locations.id AS location_id, 
    identities.*, 
    identities.address AS ktp_address, 
    identities.id AS identity_id 
    FROM employees 
    JOIN users ON employees.user_id = users.id 
    JOIN shifts ON employees.shift_id = shifts.id 
    JOIN locations ON locations.employee_id = employees.id 
    JOIN identities ON identities.employee_id = employees.id 
    WHERE users.id = ?", [$userId]);

    $user = $result->fetch_assoc();
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

            <div class="<?php echo $user['role'] === 'employee' ? 'col-md-6' : 'col-12' ?>">

                <div class="card">
                    <div class="card-header">
                        <h4>Profile</h4>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama</th>
                                    <td class="border-top border-light"><?php echo $user['name'] ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td class="border-top border-light"><?php echo $user['email'] ?> </td>
                                </tr>
                                <tr>
                                    <th>Role</th>
                                    <td class="border-top border-light"><?php echo $user['role'] ?> </td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>

            </div>

            <?php if ($user['role'] === 'employee') { ?>

                <div class="col-md-6">

                    <div class="card card-success">
                        <div class="card-header">
                            <h4>Shift Anda</h4>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="text-center" colspan="2">
                                            <?php echo $user['shift_name'] ?? '-' ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Start</th>
                                        <td class="border-top border-light">
                                            : <?php echo $user['shift_start'] ?? '-' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>End</th>
                                        <td class="border-top border-light">
                                            : <?php echo $user['shift_end'] ?? '-' ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="card card-success">
                        <div class="card-header">
                            <h4>Identitas</h4>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>NIP</th>
                                        <td class="border-top border-light">
                                            : <?php echo $user['nip'] ?? '-' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>NPWP</th>
                                        <td class="border-top border-light">
                                            : <?php echo $user['npwp'] ? $user['npwp'] : '-' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Telepon</th>
                                        <td class="border-top border-light">
                                            : <?php echo $user['phone'] ?? '-' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>NIK</th>
                                        <td class="border-top border-light">
                                            : <?php echo $user['nik'] ?? '-' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tempat Lahir</th>
                                        <td class="border-top border-light">
                                            : <?php echo $user['place_of_birth'] ?? '-' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td class="border-top border-light">
                                            : <?php echo $user['date_of_birth'] ?? '-' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td class="border-top border-light">
                                            : <?php echo $user['gender'] ?  $user['gender'] : '-' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Agama</th>
                                        <td class="border-top border-light">
                                            : <?php echo $user['religion'] ?  $user['religion'] : '-' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" colspan="2">Alamat KTP :</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center"><?php echo $user['ktp_address'] ?></td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="card card-success">
                        <div class="card-header">
                            <h4>Alamat Karyawan</h4>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Negara</th>
                                        <td class="border-top border-light">
                                            : <?php echo $user['country'] ?? '-' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Provinsi</th>
                                        <td class="border-top border-light">
                                            : <?php echo $user['province'] ?? '-' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Kota</th>
                                        <td class="border-top border-light">
                                            : <?php echo $user['city'] ?? '-' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Kode Pos</th>
                                        <td class="border-top border-light">
                                            : <?php echo $user['postal_code'] ?? '-' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" colspan="2">Alamat Domisili :</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center"><?php echo $user['address']  ?? '-' ?></td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>

            <?php } ?>

        </div>

    </section>

</div>