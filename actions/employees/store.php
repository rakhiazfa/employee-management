<?php

global $connection;

$nip = htmlspecialchars($_POST['nip'] ?? null);
$npwp = htmlspecialchars($_POST['npwp'] ?? null);
$name = htmlspecialchars($_POST['name'] ?? null);
$phone = htmlspecialchars($_POST['phone'] ?? null);
$shift_id = htmlspecialchars($_POST['shift_id'] ?? null);
$role_id = htmlspecialchars($_POST['role_id'] ?? null);

$nik = htmlspecialchars($_POST['nik'] ?? null);
$placeOfBirth = htmlspecialchars($_POST['place_of_birth'] ?? null);
$dateOfBirth = htmlspecialchars($_POST['date_of_birth'] ?? null);
$gender = htmlspecialchars($_POST['gender'] ?? null);
$religion = htmlspecialchars($_POST['religion'] ?? null);
$ktpAddress = htmlspecialchars($_POST['ktp_address'] ?? null);

$country = htmlspecialchars($_POST['country'] ?? null);
$province = htmlspecialchars($_POST['province'] ?? null);
$city = htmlspecialchars($_POST['city'] ?? null);
$postalCode = htmlspecialchars($_POST['postal_code'] ?? null);
$address = htmlspecialchars($_POST['address'] ?? null);

$email = htmlspecialchars($_POST['email'] ?? null);
$password = htmlspecialchars($_POST['password'] ?? null);
$passwordConfirmation = htmlspecialchars($_POST['password_confirmation'] ?? null);

$npwp = $npwp !== "" ? $npwp : null;

/**
 * Memeriksa konfirmasi kata sandi.
 * 
 */

if ($password !== $passwordConfirmation) {

    $_SESSION['FLASH_MESSAGE']['error'] = [
        'value' => 'Konfirmasi kata sandi tidak sesuai.',
        'called' => false,
    ];

    header('Location: ' . env('APP_URL') . '/employees/create');
    die();
}

$password = password_hash($password, PASSWORD_DEFAULT);

/**
 * Memeriksa unique attribute.
 * 
 */

$checkNip = $connection->execute_query("SELECT * FROM employees WHERE nip = ? LIMIT 1", [$nip])->fetch_assoc();

$checkNpwp = $connection->execute_query("SELECT * FROM employees WHERE npwp = ? LIMIT 1", [$npwp])->fetch_assoc();

$checkNik = $connection->execute_query("SELECT * FROM identities WHERE nik = ? LIMIT 1", [$nik])->fetch_assoc();

$checkEmail = $connection->execute_query("SELECT * FROM users WHERE email = ? LIMIT 1", [$email])->fetch_assoc();

if ($checkNip || $checkNpwp || $checkNik || $checkEmail) {

    $_SESSION['FLASH_MESSAGE']['error'] = [
        'value' => 'Data karyawan telah terdaftar.',
        'called' => false,
    ];

    header('Location: ' . env('APP_URL') . '/employees/create');
    die();
}

$query = $connection->execute_query("INSERT INTO users (name, email, password, role) VALUES (
    ?, ?, ?, ?
)", [$name, $email, $password, $role_id]);

$userId = $connection->insert_id;

$query = $connection->execute_query("INSERT INTO employees (
    nip, npwp, name, phone, shift_id, user_id
) VALUES (?, ?, ?, ?, ?, ?)", [$nip, $npwp, $name, $phone, $shift_id, $connection->insert_id]);

$employeeId = $connection->insert_id;

$query = $connection->execute_query("INSERT INTO identities (
    nik, name, place_of_birth, date_of_birth, gender, religion, address, employee_id
) VALUES (?, ?, ?, ?, ?, ?, ?, ?)", [
    $nik, $name,
    $placeOfBirth,
    $dateOfBirth,
    $gender, $religion,
    $ktpAddress,
    $employeeId,
]);

$query = $connection->execute_query("INSERT INTO locations (
    country, province, city, postal_code, address, employee_id
) VALUES (?, ?, ?, ?, ?, ?)", [$country, $province, $city, $postalCode, $address, $employeeId]);

$_SESSION['FLASH_MESSAGE']['success'] = [
    'value' => 'Berhasil mendaftarkan karyawan.',
    'called' => false,
];

header('Location: ' . env('APP_URL') . '/employees');
die();
