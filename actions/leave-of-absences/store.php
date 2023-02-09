<?php

global $connection;

$employeeId = (int) htmlspecialchars($_POST['employee_id'] ?? null);

$start = htmlspecialchars($_POST['start'] ?? null);
$end = htmlspecialchars($_POST['end'] ?? null);
$category = htmlspecialchars($_POST['category'] ?? null);
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

if ($category === "") {

    $_SESSION['FLASH_MESSAGE']['error'] = [
        'value' => 'Bidang kategori tidak boleh kosong.',
        'called' => false,
    ];

    header('Location: ' . env('APP_URL') . '/user/leave-of-absences');
    die();
}

/**
 * Membuat cuti.
 * 
 */

$query = $connection->execute_query("INSERT INTO leave_of_absences 
(start, end, category, description, employee_id) 
VALUES (
    ?, ?, ?, ?, ?
)", [$start, $end, $category, $description, $employeeId]);

/**
 * Membuat riwayat cuti.
 * 
 */

$query = $connection->execute_query("INSERT INTO leave_of_absence_histories 
(employee_nip, employee_name, employee_email, leave_of_absence_id) 
VALUES (
    ?, ?, ?, ?
)", [
    $employee['nip'],
    $employee['name'],
    $employee['email'],
    $connection->insert_id,
]);

$_SESSION['FLASH_MESSAGE']['success'] = [
    'value' => 'Berhasil mengirim permintaan.',
    'called' => false,
];

header('Location: ' . env('APP_URL') . '/user/leave-of-absences');
die();
