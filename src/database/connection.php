<?php

/**
 * Koneksi database.
 * 
 */

$connection = new mysqli(
    env('DATABASE_HOST'),
    env('DATABASE_USERNAME'),
    env('DATABASE_PASSWORD'),
    env('DATABASE_NAME'),
    env('DATABASE_PORT'),
);
