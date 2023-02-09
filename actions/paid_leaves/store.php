<?php
global $connection;

$start = htmlspecialchars($_POST['start'] ?? null);
$end = htmlspecialchars($_POST['end'] ?? null);
$description = htmlspecialchars($_POST['description'] ?? null);
$employeeId = (int) htmlspecialchars($_POST['employee_id'] ?? null);

$result = $connection->execute_query("SELECT 
employees.*, 
users.id AS user_id, 
users.email
FROM employees 
JOIN users ON employees.user_id = users.id 
WHERE employees.id = ?", [$employeeId]);

$employee = $result->fetch_assoc();


/**
 * Validasi request.
 * 
 */

if ($description === "") {

    $_SESSION['FLASH_MESSAGE']['error'] = [
        'value' => 'Bidang Alasan tidak boleh kosong.',
        'called' => false,
    ];

    header('Location: ' . env('APP_URL') . '/user/presences');
    die();
}

$s = new DateTime($start);
$e = new DateTime($end);

$total = $s->diff($e)->days + 1;


$paidStart = DateTime::createFromFormat('H:i:s', $employee['start'] ?? '');
$paidEnd = DateTime::createFromFormat('H:i:s', $employee['end'] ?? '');

/**
 * Membuat kehadiran.
 * 
 */

$query = $connection->execute_query("INSERT INTO paid_leaves 
(start, end, total, description, status, employee_id) 
VALUES (
    ?, ?, ?, ?, ?, ?
)", [$start, $end, $total, $description, '', $employeeId]);

/**
 * Membuat riwayat cuti.
 * 
 */

$query = $connection->execute_query("INSERT INTO paid_leave_histories 
(employee_nip, employee_name, employee_email, shift_name, shift_start, shift_end, paid_leave_id) 
VALUES (
    ?, ?, ?, ?, ?, ?, ?
)", [
    $employee['nip'],
    $employee['name'],
    $employee['email'],
    $start,
    $end,
    $connection->insert_id,
]);

$_SESSION['FLASH_MESSAGE']['success'] = [
    'value' => 'Berhasil mengirim permohonan.',
    'called' => false,
];

header('Location: ' . env('APP_URL') . '/user/presences');
die();
