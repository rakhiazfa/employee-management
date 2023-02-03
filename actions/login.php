<?php

global $connection;

$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);

/**
 * Cek apakah email sudah terdaftar atau belum.
 * 
 */

$query = $connection->execute_query("SELECT * FROM users WHERE email = ? LIMIT 1", [$email]);
$user = $query->fetch_assoc();

if (!$user) {

    $_SESSION['FLASH_MESSAGE']['error'] = [
        'value' => 'Email yang anda masukan belum terdaftar.',
        'called' => false,
    ];

    header('Location: ' . env('APP_URL') . '/login');
    die();
}

/**
 * Cek apakah kata sandi betul atau salah.
 * 
 */

$checkPassword = password_verify($password, $user['password']);

if (!$checkPassword) {

    $_SESSION['FLASH_MESSAGE']['error'] = [
        'value' => 'Kata sandi yang anda masukan salah.',
        'called' => false,
    ];

    header('Location: ' . env('APP_URL') . '/login');
    die();
}

$_SESSION['user'] = $user;

header('Location: ' . env('APP_URL'));
die();
