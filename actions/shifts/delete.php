<?php

global $connection;

$id = (int) $_GET['id'];

$query = $connection->execute_query("DELETE FROM shifts WHERE id = ?", [$id]);

$_SESSION['FLASH_MESSAGE']['success'] = [
    'value' => 'Berhasil menghapus data shift.',
    'called' => false,
];

header('Location: ' . env('APP_URL') . '/shifts');
die();
