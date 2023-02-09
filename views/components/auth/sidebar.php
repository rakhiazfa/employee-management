<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">
                <img class="sidebar-logo" src="<?php echo asset('img/employee-management.png') ?>" alt="Logo">
            </a>
        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#"></a>
        </div>

        <ul class="sidebar-menu" style="margin-top: 1.95rem;">

            <li class="menu-header">Dashboard</li>

            <li class="">
                <a href="<?php echo url('dashboard') ?>" class="nav-link">
                    <i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">Menu / Item</li>

            <?php if ($_SESSION['user']['role'] === 'admin') { ?>
                <li>
                    <a class="nav-link" href="<?php echo url('employees') ?>">
                        <i class="fas fa-users"></i>
                        <span>Daftar Karyawan</span>
                    </a>
                </li>

                <li>
                    <a class="nav-link" href="<?php echo url('presences') ?>">
                        <i class="fas fa-calendar"></i>
                        <span>Kehadiran Karyawan</span>
                    </a>
                </li>

                <li>
                    <a class="nav-link" href="<?php echo url('paid_leaves') ?>">
                        <i class="fas fa-calendar-minus"></i>
                        <span>Perizinan Cuti</span>
                    </a>
                </li>
            <?php } else { ?>
                <li>
                    <a class="nav-link" href="<?php echo url('user/presences') ?>">
                        <i class="fas fa-calendar"></i>
                        <span>Kehadiran</span>
                    </a>
                </li>


                <li>
                    <a class="nav-link" href="<?php echo url('user/paid_leaves') ?>">
                        <i class="fas fa-calendar-minus"></i>
                        <span>Perizinan Cuti</span>
                    </a>
                </li>
            <?php } ?>



            <?php if ($_SESSION['user']['role'] === 'admin') { ?>
                <li class="menu-header">Laporan</li>

                <li>
                    <a class="nav-link" href="<?php echo url('reports') ?>">
                        <i class="fas fa-file-signature"></i>
                        <span>Laporan Kehadiran</span>
                    </a>
                </li>
            <?php } ?>

            <?php if ($_SESSION['user']['role'] === 'admin') { ?>
                <li class="menu-header">Setting</li>

                <li>
                    <a class="nav-link" href="<?php echo url('shifts') ?>">
                        <i class="fas fa-clock"></i>
                        <span>Shift</span>
                    </a>
                </li>
            <?php } ?>

        </ul>

    </aside>
</div>