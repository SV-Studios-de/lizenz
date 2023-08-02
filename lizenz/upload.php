<?php
require_once 'config.php';

require_once 'datenbank.php';


$dbConnection = createDBConnection($dbHost, $dbName, $dbUser, $dbPass);

$pdo = createDBConnection($dbHost, $dbName, $dbUser, $dbPass);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $uploadDir = 'uploads/';
    $fileName = $_FILES['file']['name'];
    $uploadPath = $uploadDir . $fileName;
    $name = $_POST['name']; 


    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath)) {

        $stmt = $pdo->prepare('INSERT INTO uploads (name, file_path) VALUES (:name, :file_path)');
        $stmt->bindParam(':name', $name); 
        $stmt->bindParam(':file_path', $uploadPath);
        $stmt->execute();
       
        $pdo = null;

        header('Location: index.php');
        exit;
    } else {
     
        echo 'Fehler beim Hochladen der Datei.';
        exit;
    }
} else {

    header('Location: index.php');
    exit;
}
?>
