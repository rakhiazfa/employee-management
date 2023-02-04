<?php

global $connection;

$id = (int) $_GET['id'];

$result = $connection->execute_query("SELECT 
employees.*, users.email, 
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

            <div class="col-md-7">
                <div class="card card-success">
                    <div class="card-header">
                        <h4>Detail Karyawan</h4>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>NIP</th>
                                    <td class="border-top border-light">
                                        : <?php echo $employee['nip'] ?? '-' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>NPWP</th>
                                    <td class="border-top border-light">
                                        : <?php echo $employee['npwp'] ? $employee['npwp'] : '-' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td class="border-top border-light">
                                        : <?php echo $employee['name'] ?? '-' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nomor Telepon</th>
                                    <td class="border-top border-light">
                                        : <?php echo $employee['phone'] ?? '-' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td class="border-top border-light">
                                        : <?php echo $employee['email'] ?? '-' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <td class="border-top border-light">
                                        : <?php echo $employee['nik'] ?? '-' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tempat Lahir</th>
                                    <td class="border-top border-light">
                                        : <?php echo $employee['place_of_birth'] ?? '-' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td class="border-top border-light">
                                        : <?php echo $employee['date_of_birth'] ?? '-' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td class="border-top border-light">
                                        : <?php echo $employee['gender'] ?  $employee['gender'] : '-' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Agama</th>
                                    <td class="border-top border-light">
                                        : <?php echo $employee['religion'] ?  $employee['religion'] : '-' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center" colspan="2">Alamat KTP :</th>
                                </tr>
                                <tr>
                                    <td colspan="2"><?php echo $employee['ktp_address'] ?></td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-5">
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
                                        : <?php echo $employee['country'] ?? '-' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Provinsi</th>
                                    <td class="border-top border-light">
                                        : <?php echo $employee['province'] ?? '-' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Kota</th>
                                    <td class="border-top border-light">
                                        : <?php echo $employee['city'] ?? '-' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Kode Pos</th>
                                    <td class="border-top border-light">
                                        : <?php echo $employee['postal_code'] ?? '-' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center" colspan="2">Alamat Domisili :</th>
                                </tr>
                                <tr>
                                    <td colspan="2"><?php echo $employee['address'] ?></td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </section>

</div>