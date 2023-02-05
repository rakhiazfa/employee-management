<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#"><?php echo env('APP_NAME') ?></a>
        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#"></a>
        </div>

        <ul class="sidebar-menu">

            <li class="menu-header">Dashboard</li>

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="<?php echo url('dashboard') ?>">General Dashboard</a>
                    </li>
                </ul>
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

        </ul>

    </aside>
</div>