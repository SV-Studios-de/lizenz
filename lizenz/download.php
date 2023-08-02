<?php
require_once 'config.php';

require_once 'datenbank.php';


$dbConnection = createDBConnection($dbHost, $dbName, $dbUser, $dbPass);

$pdo = createDBConnection($dbHost, $dbName, $dbUser, $dbPass);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $license = $_POST['license'];

  


    $stmt = $pdo->prepare('SELECT file_id FROM licenses WHERE license = :license');
    $stmt->bindParam(':license', $license);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
  
        $fileId = $result['file_id'];

        $stmt = $pdo->prepare('SELECT file_path FROM uploads WHERE id = :fileId');
        $stmt->bindParam(':fileId', $fileId);
        $stmt->execute();
        $fileData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fileData) {
        
            $filePath = $fileData['file_path'];
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            readfile($filePath);
            exit;
        } else {
            echo 'Datei nicht gefunden.';
            exit;
        }
    } else {
        
        echo 'Ungültige Lizenz.';
        exit;
    }
}
?>
