<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="<?php echo asset('img/employee-management.png') ?>" type="image/x-icon">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo asset('modules/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('modules/fontawesome/css/all.min.css') ?>">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo asset('modules/bootstrap-daterangepicker/daterangepicker.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('modules/select2/dist/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('modules/jquery-selectric/selectric.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') ?>">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo asset('css/style.min.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('css/components.min.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('css/custom.css') ?>">

    <link rel="icon" href="<?php echo asset('img/employee-management.png') ?>">

    <title>Management Employee</title>
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">

            <div class="page-loader">
                <div class="page-loader-wrapper">
                    <img class="spinner" src="<?php echo asset('img/spinner-primary.svg') ?>" alt="Spinner">
                </div>
            </div>

            $CONTENT$

        </div>

        <footer class="footer">
            <div class="d-flex justify-content-center">
                <div>
                    Copyright &copy; <?php echo date('Y') ?>
                    <div class="bullet"></div>
                    <a href="#" target="_blank">Fauzan Achmad</a>
                </div>
            </div>
        </footer>


        <!-- General JS Scripts -->
        <script src="<?php echo asset('modules/jquery.min.js') ?>"></script>
        <script src="<?php echo asset('modules/popper.js') ?>"></script>
        <script src="<?php echo asset('modules/tooltip.js') ?>"></script>
        <script src="<?php echo asset('modules/bootstrap/js/bootstrap.min.js') ?>"></script>
        <script src="<?php echo asset('modules/nicescroll/jquery.nicescroll.min.js') ?>"></script>
        <script src="<?php echo asset('modules/moment.min.js') ?>"></script>
        <script src="<?php echo asset('js/stisla.js') ?>"></script>

        <!-- JS Libraies -->
        <script src="<?php echo asset('modules/cleave-js/dist/cleave.min.js') ?>"></script>
        <script src="<?php echo asset('modules/cleave-js/dist/addons/cleave-phone.us.js') ?>"></script>
        <script src="<?php echo asset('modules/jquery-pwstrength/jquery.pwstrength.min.js') ?>"></script>
        <script src="<?php echo asset('modules/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>
        <script src="<?php echo asset('modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') ?>"></script>
        <script src="<?php echo asset('modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') ?>"></script>
        <script src="<?php echo asset('modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') ?>"></script>
        <script src="<?php echo asset('modules/select2/dist/js/select2.full.min.js') ?>"></script>
        <script src="<?php echo asset('modules/jquery-selectric/jquery.selectric.min.js') ?>"></script>

        <!-- Forms Advanced JS -->
        <script src="<?php echo asset('js/forms-advanced.js') ?>"></script>

        <!-- Template JS File -->
        <script src="<?php echo asset('js/scripts.js') ?>"></script>
        <script src="<?php echo asset('js/custom.js') ?>"></script>

</body>

</html>