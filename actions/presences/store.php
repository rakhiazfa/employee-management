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
shifts.id AS shift_id, 
shifts.name AS shift_name, 
shifts.start AS shift_start, 
shifts.end AS shift_end 
FROM employees 
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

$date = date('Y-m-d');
$presenceTime = date('H:i:s');
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

/**
 * Cek waktu saat karyawan mengirim kehadiran.
 * 
 */

if (strtotime($presenceTime) < strtotime($employee['shift_start'])) {

    $_SESSION['FLASH_MESSAGE']['error'] = [
        'value' => 'Jam ' . $presenceTime . ' tidak masuk ke dalam shift anda.',
        'called' => false,
    ];

    header('Location: ' . env('APP_URL') . '/user/presences');
    die();
}

if (strtotime($presenceTime) > strtotime($employee['shift_end'])) {

    $lateTime = (int) floor(round(abs(strtotime($presenceTime) - strtotime($employee['shift_end'])) / 60, 2));
}

$query = $connection->execute_query("INSERT INTO presences 
(date, presence_time, late_time, status, description, employee_id) 
VALUES (
    ?, ?, ?, ?, ?, ?
)", [$date, $presenceTime, $lateTime, $status, $description, $employeeId]);

$_SESSION['FLASH_MESSAGE']['success'] = [
    'value' => 'Berhasil mengirim absensi.',
    'called' => false,
];

header('Location: ' . env('APP_URL') . '/user/presences');
die();
