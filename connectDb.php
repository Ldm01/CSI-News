<?php
session_start();
try {
    if (!isset($_SESSION['id'])) {
        $db = new PDO(
            'pgsql:host=localhost;dbname=gestionnews',
            'notconnecteduser',
            '',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    } elseif (isset($_SESSION['admin']) && $_SESSION['admin']) {
        $db = new PDO(
            'pgsql:host=localhost;dbname=gestionnews',
            'adminuser',
            '',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    } else {
        $db = new PDO(
            'pgsql:host=localhost;dbname=gestionnews',
            'abonneuser',
            '',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
} catch (Exception $e) {
    die($e->getMessage());
}