<?php

global $connection;

$id = (int) $_GET['id'];

$name = htmlspecialchars($_POST['name'] ?? null);
$start = htmlspecialchars($_POST['start'] ?? null);
$end = htmlspecialchars($_POST['end'] ?? null);
$start = date('H:i:s', strtotime($start));
$end = date('H:i:s', strtotime($end));

$query = $connection->execute_query("UPDATE shifts SET 
name = ?,
start = ?,
end = ? WHERE id = ? LIMIT 1 ", [$name, $start, $end, $id]);


$_SESSION['FLASH_MESSAGE']['success'] = [
    'value' => 'Berhasil mendaftarkan Shift.',
    'called' => false,
];

header('Location: ' . env('APP_URL') . '/shifts');
die();
