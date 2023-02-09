<?php
global $connection;

$id = (int) $_GET['id'];

$status = htmlspecialchars($_POST['status']);

$query = $connection->execute_query("UPDATE paid_leaves SET 
status = 'yes' 
WHERE id = ?", [$id]);

$_SESSION['FLASH_MESSAGE']['success'] = [
    'value' => 'Berhasil Diubah.',
    'called' => false,
];

header('Location: ' . env('APP_URL') . '/paid_leaves');
die();
