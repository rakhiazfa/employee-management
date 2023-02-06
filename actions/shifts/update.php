<?php

global $connection;

$id = (int) $_GET['id'];

$name = htmlspecialchars($_POST['name'] ?? null);
$start = htmlspecialchars($_POST['start'] ?? null);
$end = htmlspecialchars($_POST['end'] ?? null);

$query = $connection->execute_query("UPDATE shifts SET 
name = '$name',
start = '$start',
end = '$end' WHERE id = ? LIMIT 1 ", [$id]);


$_SESSION['FLASH_MESSAGE']['success'] = [
    'value' => 'Berhasil mendaftarkan Shift.',
    'called' => false,
];

header('Location: ' . env('APP_URL') . '/shifts');
die();
