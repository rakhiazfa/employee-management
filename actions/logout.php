<?php

unset($_SESSION['user']);

header('Location: ' . env('APP_URL') . '/login');
die();
