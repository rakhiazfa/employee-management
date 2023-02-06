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

            <li class="menu-header">Laporan</li>

            <li>
                <a class="nav-link" href="<?php echo url('reports') ?>">
                    <i class="fas fa-file-signature"></i>
                    <span>Laporan Kehadiran</span>
                </a>
            </li>

        </ul>

    </aside>
</div>