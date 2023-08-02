<?php
require_once 'config.php';

require_once 'datenbank.php';


$dbConnection = createDBConnection($dbHost, $dbName, $dbUser, $dbPass);

$pdo = createDBConnection($dbHost, $dbName, $dbUser, $dbPass);



$stmt = $pdo->query('SELECT * FROM uploads');
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);


$pdo = null;

echo json_encode($data);
?>
