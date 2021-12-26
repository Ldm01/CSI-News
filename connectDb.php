<?php

try {
    // TODO: ADD SWITCH STATEMENT TO CONNECT ONLY THE USER ASSOCIATED
    // FOR THE MOMENT WE'RE CONNECTED AS ADMIN
    $db = new PDO(
        'pgsql:host=localhost;dbname=gestionnews',
        'administrateur',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (Exception $e) {
    die($e->getMessage());
}