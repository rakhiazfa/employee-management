<?php

global $connection;

$employeeId = (int) htmlspecialchars($_POST['employee_id'] ?? null);

$status = htmlspecialchars($_POST['status'] ?? null);
$description = htmlspecialchars($_POST['description'] ?? null);

/**
 * Mengambil data karyawan.
 * 
 */

$result = $connection->execute_query("SELECT 
employees.*, 
users.id AS user_id, 
users.email,
shifts.id AS shift_id, 
shifts.name AS shift_name, 
shifts.start AS shift_start, 
shifts.end AS shift_end 
FROM employees 
JOIN users ON employees.user_id = users.id 
JOIN shifts ON employees.shift_id = shifts.id 
WHERE employees.id = ?", [$employeeId]);

$employee = $result->fetch_assoc();

/**
 * Validasi request.
 * 
 */

if ($status === "") {

    $_SESSION['FLASH_MESSAGE']['error'] = [
        'value' => 'Bidang status tidak boleh kosong.',
        'called' => false,
    ];

    header('Location: ' . env('APP_URL') . '/user/presences');
    die();
}

$now = new DateTime();

$date = date('Y-m-d');
$presenceTime = $now->format('Y-m-d H:i:s');
$lateTime = 0;

/**
 * Cek apakah karyawan sudah mengirim kehadiran sebelumnya.
 * 
 */

$result = $connection->execute_query("SELECT * FROM presences WHERE date = ? AND employee_id = ?", [$date, $employeeId]);

$checkPresence = $result->fetch_assoc();

if ($checkPresence) {

    $_SESSION['FLASH_MESSAGE']['error'] = [
        'value' => 'Anda sudah mengirim absensi.',
        'called' => false,
    ];

    header('Location: ' . env('APP_URL') . '/user/presences');
    die();
}

$shiftStart = DateTime::createFromFormat('H:i:s', $employee['shift_start'] ?? '');
$shiftEnd = DateTime::createFromFormat('H:i:s', $employee['shift_end'] ?? '');

$year = (int) date('Y');
$month = (int) date('m');
$date = (int) date('d');

/**
 * Cek apakah waktu melewati jam 12 malam.
 * 
 */

$shiftStart->setDate($year, $month, $date);

if ((int) date('H') < (int) $shiftStart->format('H') && (int) date('H') < (int) $shiftEnd->format('H')) {

    $shiftStart->setDate($year, $month, ($date - 1));
}

/**
 * Cek waktu saat karyawan mengirim kehadiran.
 * 
 */

if (strtotime($presenceTime) < strtotime($shiftStart->format('Y-m-d H:i:s')) && strtotime($presenceTime) > strtotime($shiftEnd->format('Y-m-d H:i:s'))) {

    $_SESSION['FLASH_MESSAGE']['error'] = [
        'value' => 'Jam ' . $presenceTime . ' tidak masuk ke dalam shift anda.',
        'called' => false,
    ];

    header('Location: ' . env('APP_URL') . '/user/presences');
    die();
}

if (strtotime($presenceTime) > strtotime($shiftStart->format('Y-m-d H:i:s'))) {

    $lateTime = (int) floor(round(abs(strtotime($presenceTime) - strtotime($shiftStart->format('Y-m-d H:i:s'))) / 60, 2));
}

$presenceTime = $now->format('H:i:s');

/**
 * Membuat kehadiran.
 * 
 */

$query = $connection->execute_query("INSERT INTO presences 
(date, presence_time, late_time, status, description, employee_id) 
VALUES (
    ?, ?, ?, ?, ?, ?
)", [$date, $presenceTime, $lateTime, $status, $description, $employeeId]);

/**
 * Membuat riwayat kehadiran.
 * 
 */

$query = $connection->execute_query("INSERT INTO presence_histories 
(employee_nip, employee_name, employee_email, shift_name, shift_start, shift_end, presence_id) 
VALUES (
    ?, ?, ?, ?, ?, ?, ?
)", [
    $employee['nip'],
    $employee['name'],
    $employee['email'],
    $employee['shift_name'],
    $employee['shift_start'],
    $employee['shift_end'],
    $connection->insert_id,
]);

$_SESSION['FLASH_MESSAGE']['success'] = [
    'value' => 'Berhasil mengirim absensi.',
    'called' => false,
];

header('Location: ' . env('APP_URL') . '/user/presences');
die();
