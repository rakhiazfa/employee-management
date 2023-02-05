<?php

$user = $_SESSION['user'];

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
        </div>

    </section>

</div>