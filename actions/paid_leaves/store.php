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


/**
 * Membuat kehadiran.
 * 
 */

$query = $connection->execute_query("INSERT INTO paid_leaves 
(start, end, total, description) 
VALUES (
    ?, ?, ?, ?
)", [$start, $end, $total, $description]);



$_SESSION['FLASH_MESSAGE']['success'] = [
    'value' => 'Berhasil mengirim permohonan.',
    'called' => false,
];

header('Location: ' . env('APP_URL') . '/user/paid_leaves');
die();
