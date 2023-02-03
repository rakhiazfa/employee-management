<?php

/**
 * Kumpulan fungsi-fungsi penolong.
 * 
 */


/**
 * Fungsi untuk mengambil konfigurasi berdasarkan key.
 * 
 * @param string $key
 * @param mixed|null $default
 * 
 * @return mixed
 */
function env(string $key, mixed $default = null)
{
    return $_ENV[$key] ?? $default;
}


/**
 * Fungsi untuk mengakses url secara spesifik.
 * 
 * @param string $path
 * 
 * @return string
 */
function url(string $path)
{
    return env('APP_URL') . '/' . $path;
}


/**
 * Fungsi untuk mengakses file pada folder assets.
 * 
 * @param string $file
 * 
 * @return string
 */
function asset(string $file)
{
    return env('APP_URL') . '/assets/' . $file;
}


/**
 * Fungsi untuk mengambil isi konten dari sebuah file.
 * 
 * @param string $file
 * 
 * @return string
 */
function getViewContent(string $file)
{
    ob_start();

    include_once ROOT_DIRECTORY . '/views/' . $file;

    return ob_get_clean();
}


/**
 * Fungsi untuk menampilkan isi content dari file sidebar.php
 * 
 * @return string
 */
function sidebar()
{
    echo getViewContent('components/auth/sidebar.php');
}


/**
 * Fungsi untuk menampilkan isi content dari file topbar.php
 * 
 * @return string
 */
function topbar()
{
    echo getViewContent('components/auth/topbar.php');
}


/**
 * Fungsi untuk menampilkan sebuah halaman dengat templatenya.
 * 
 * @param string $view
 * 
 * @return void
 */
function render(string $view)
{
    $template = getViewContent('components/layout.php');

    $content = getViewContent($view);

    echo str_replace('$CONTENT$', $content, $template);

    return 0;
}


/**
 * Fungsi untuk memeriksa ketersediaan flash message.
 * 
 * @param string $key
 * 
 * @return mixed
 */
function hasFlash(string $key)
{
    return $_SESSION['FLASH_MESSAGE'][$key] ?? false;
}


/**
 * Fungsi untuk menggunakan flash message.
 * 
 * @param string $key
 * 
 * @return mixed
 */
function flash(string $key)
{
    $_SESSION['FLASH_MESSAGE'][$key]['called'] = true;

    return $_SESSION['FLASH_MESSAGE'][$key]['value'];
}
