<?php

global $connection;

$employeeId = htmlentities($_POST['employee_id']);
$userId = htmlspecialchars($_POST['user_id']);
$identityId = htmlspecialchars($_POST['identity_id']);
$locationId = htmlspecialchars($_POST['location_id']);

/**
 * Get employee detail.
 * 
 */

$result = $connection->execute_query("SELECT 
employees.*, users.email, 
locations.*, locations.id AS location_id, 
identities.*, identities.id AS identity_id, identities.address AS ktp_address 
FROM employees 
JOIN users ON employees.user_id = users.id 
JOIN locations ON locations.employee_id = employees.id 
JOIN identities ON identities.employee_id = employees.id 
WHERE employees.id = ? 
LIMIT 1", [$employeeId]);

/**
 * Mengambil request user.
 * 
 */

$nip = htmlspecialchars($_POST['nip'] ?? null);
$npwp = htmlspecialchars($_POST['npwp'] ?? null);
$name = htmlspecialchars($_POST['name'] ?? null);
$phone = htmlspecialchars($_POST['phone'] ?? null);
$shift_id = htmlspecialchars($_POST['shift_id'] ?? null);

$nik = htmlspecialchars($_POST['nik'] ?? null);
$placeOfBirth = htmlspecialchars($_POST['place_of_birth'] ?? null);
$dateOfBirth = htmlspecialchars($_POST['date_of_birth'] ?? null);
$gender = htmlspecialchars($_POST['gender'] ?? null);
$religion = htmlspecialchars($_POST['religion'] ?? null);
$ktpAddress = htmlspecialchars($_POST['ktp_address'] ?? null);

$country = htmlspecialchars($_POST['country'] ?? null);
$province = htmlspecialchars($_POST['province'] ?? null);
$city = htmlspecialchars($_POST['city'] ?? null);
$postalCode = htmlspecialchars($_POST['postal_code'] ?? null);
$address = htmlspecialchars($_POST['address'] ?? null);

$email = htmlspecialchars($_POST['email'] ?? null);
