<?php

try {
    // TODO: Change db name when created
    $db = new PDO(
        'pgsql:host=plg-broker.ad.univ-lorraine.fr;dbname=m1_circuit_03',
        'm1user1_03',
        'm1user1_03',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (Exception $e) {
    die($e->getMessage());
}