<?php
require_once 'config.php';


require_once 'datenbank.php';

$dbConnection = createDBConnection($dbHost, $dbName, $dbUser, $dbPass);

$pdo = createDBConnection($dbHost, $dbName, $dbUser, $dbPass);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $fileId = $_POST['fileId'];



    $stmt = $pdo->prepare('SELECT file_path FROM uploads WHERE id = :fileId');
    $stmt->bindParam(':fileId', $fileId);
    $stmt->execute();
    $fileData = $stmt->fetch(PDO::FETCH_ASSOC);

   
    if ($fileData) {
     
        $license = generateLicense(); 
        $stmt = $pdo->prepare('INSERT INTO licenses (name, file_id, license) VALUES (:name, :fileId, :license)');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':fileId', $fileId);
        $stmt->bindParam(':license', $license);
        $stmt->execute();

      
        $pdo = null;

        header('Location: index.php');
        exit;
    } else {
       
        echo 'Datei ID nicht gefunden.';
        exit;
    }
}


function generateLicense() {
    $prefix = 'SV';
    $uniquePart = uniqid();
    $randomPart = bin2hex(random_bytes(4)); 
    return $prefix . '-' . $uniquePart . '-' . $randomPart;
}
?>
