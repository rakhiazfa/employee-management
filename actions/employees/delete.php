<?php

global $connection;

$userId = htmlspecialchars($_POST['user_id']);

$query = $connection->execute_query("DELETE FROM users WHERE id = ?", [$userId]);

$_SESSION['FLASH_MESSAGE']['success'] = [
    'value' => 'Berhasil menghapus data karyawan.',
    'called' => false,
];

header('Location: ' . env('APP_URL') . '/employees');
die();
