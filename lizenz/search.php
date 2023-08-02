<?php
require_once 'config.php';
require_once 'datenbank.php';


$dbConnection = createDBConnection($dbHost, $dbName, $dbUser, $dbPass);


function deleteLicense($licenseId) {
    global $dbHost, $dbName, $dbUser, $dbPass;

   
    $pdo = createDBConnection($dbHost, $dbName, $dbUser, $dbPass);

   
    $stmt = $pdo->prepare('DELETE FROM licenses WHERE id = :licenseId');
    $stmt->bindParam(':licenseId', $licenseId);
    $stmt->execute();

    
    $pdo = null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

 
    $pdo = createDBConnection($dbHost, $dbName, $dbUser, $dbPass);

  
    $stmt = $pdo->prepare('SELECT * FROM licenses WHERE name LIKE :searchTerm OR license LIKE :searchTerm');
    $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%');
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $pdo = null;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteLicense'])) {
    $licenseId = $_POST['deleteLicense'];
    deleteLicense($licenseId);
    header('Location: search.php'); 
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lizenzen suchen und löschen</title>
   
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .confirmation-message {
            display: none;
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-4">Lizenzen suchen und löschen</h1>
    <button type="submit" onclick="window.location.href='index.php';" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-200 focus:ring-opacity-50">Back</button>
    <form action="search.php" method="post" class="mb-4">
        <label for="searchTerm" class="block">Suchbegriff:</label>
        <input type="text" name="searchTerm" id="searchTerm" required
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500 mb-2">
        <button type="submit"
                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            Suchen
        </button>
    </form>

    <?php if (isset($results)): ?>
        <h2 class="text-2xl font-bold mb-4">Suchergebnisse:</h2>
        <?php if (count($results) > 0): ?>
            <ul class="mb-4">
                <?php foreach ($results as $result): ?>
                    <li class="mb-2">
                        Name: <?php echo $result['name']; ?><br>
                        Lizenz: <?php echo $result['license']; ?><br>
                        Datei ID: <?php echo $result['file_id']; ?><br>
                       
                        <button onclick="showConfirmation(<?php echo $result['id']; ?>)"
                                class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded focus:outline-none focus:ring focus:ring-red-200 focus:ring-opacity-50">
                            Lizenz löschen
                        </button>
                        <div id="confirmation-<?php echo $result['id']; ?>" class="confirmation-message mt-2"></div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Keine Ergebnisse gefunden.</p>
        <?php endif; ?>
    <?php endif; ?>
</div>

<script>
    
    function showConfirmation(licenseId) {
        const confirmationMessage = document.getElementById('confirmation-' + licenseId);
        confirmationMessage.innerHTML = `Bist du sicher, dass du diese Lizenz löschen möchtest?
        <form action="search.php" method="post">
            <input type="hidden" name="deleteLicense" value="${licenseId}">
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded focus:outline-none focus:ring focus:ring-red-200 focus:ring-opacity-50">
                Ja, löschen
            </button>
        </form>
        <button onclick="hideConfirmation(${licenseId})"
                class="ml-2 py-2 px-4 rounded bg-gray-300 hover:bg-gray-400 focus:outline-none focus:ring focus:ring-gray-200 focus:ring-opacity-50">
            Nein, abbrechen
        </button>`;
        confirmationMessage.style.display = 'block';
    }

    
    function hideConfirmation(licenseId) {
        const confirmationMessage = document.getElementById('confirmation-' + licenseId);
        confirmationMessage.style.display = 'none';
    }
</script>
</body>
</html>
