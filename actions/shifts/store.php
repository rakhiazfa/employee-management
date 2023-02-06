<?php

global $connection;

$name = htmlspecialchars($_POST['name'] ?? null);
$start = htmlspecialchars($_POST['start'] ?? null);
$end = htmlspecialchars($_POST['end']);

$query = $connection->execute_query("INSERT INTO shifts (name, start, end) VALUES (
    ?, ?, ?
)", [$name, $start, $end]);

$_SESSION['FLASH_MESSAGE']['success'] = [
    'value' => 'Berhasil mendaftarkan Shift.',
    'called' => false,
];

header('Location: ' . env('APP_URL') . '/shifts');
die();
