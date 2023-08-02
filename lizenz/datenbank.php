<?php

require_once 'config.php';

function createDBConnection($dbHost, $dbName, $dbUser, $dbPass)
{
    try {
        $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die("Verbindung zur Datenbank fehlgeschlagen: " . $e->getMessage());
    }
}
?>
