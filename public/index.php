<?php

/**
 * Employee Management
 * 
 * Teknologi yang digunakan: 
 * 
 *  - Framework:
 * 
 *      - Bootstrap
 * 
 *  - Package PHP:
 * 
 *      - vlucas/phpdotenv
 * 
 * @author Rakhi Azfa Rifansya
 */

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Memuat konfigurasi yang ada di file .env
 * 
 */

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

/**
 * Mendefinisikan root directory dari aplikasi ini.
 * 
 */

define('ROOT_DIRECTORY', dirname(__DIR__));

/**
 * Memuat fungsi-fungsi penolong.
 * 
 */

require_once __DIR__ . '/../src/foundation/helpers.php';

/**
 * Memuat koneksi database.
 * 
 */

require_once __DIR__ . '/../src/database/connection.php';

/**
 * Cek mode debug.
 * 
 */

if (!filter_var(env('APP_DEBUG'), FILTER_VALIDATE_BOOL)) {

    error_reporting(1);
}

/**
 * Mengubah default timezone.
 * 
 */

date_default_timezone_set(env('TIMEZONE', 'Asia/Jakarta'));

/**
 * Memulai sesi.
 * 
 */

session_start();

/**
 * Mengambil request url.
 * 
 */

$url = $_SERVER['PATH_INFO'] ?? '/dashboard';

/**
 * Daftar halaman yang membutuhkan akses login.
 * 
 */

$guardedPages = [
    '/dashboard',
];

/**
 * Memuat halaman sesuai request url yang diberikan.
 * 
 */

if ($url !== '/') {

    /**
     * Cek apakah halaman membutuhkan akses login.
     * 
     */

    if (in_array($url, $guardedPages)) {

        /**
         * Jika user belum login, maka lempar user ke halaman login.
         * 
         */

        if (!isset($_SESSION['user'])) {

            header('Location: ' . env('APP_URL') . '/login');
            die();
        }
    }

    /**
     * Cek ketersediaan file.
     * 
     */

    if (file_exists(ROOT_DIRECTORY . '/views' . $url . '.php')) {

        render($url . '.php');
    } else {

        render('404.php');
    }
}
