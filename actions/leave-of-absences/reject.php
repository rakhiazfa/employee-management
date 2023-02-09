<?php

global $connection;

$id = htmlspecialchars($_GET['id'] ?? null);

$query = $connection->execute_query("UPDATE leave_of_absences SET status = ? WHERE id = ?", ['rejected', $id]);

$_SESSION['FLASH_MESSAGE']['success'] = [
    'value' => 'Berhasil menolak permintaan.',
    'called' => false,
];

header('Location: ' . env('APP_URL') . '/leave-of-absences');
die();
