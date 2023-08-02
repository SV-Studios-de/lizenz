<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    require_once 'config.php';
   
    if ($password === $adminPass) {
      
    } else {
       
        header('Location: index.php');
        exit;
    }
} else {
    
    header('Location: index.php');
    exit;
}
?>


<div class="container mx-auto py-8">
  <h1 class="text-3xl font-bold mb-4">Datei-Upload und Lizenz erstellen</h1>

  <form action="upload.php" method="post" enctype="multipart/form-data" class="mb-4">
    <label for="name" class="block">Name:</label>
    <input type="text" name="name" id="name" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500 mb-2">

    <input type="file" name="file" id="file" required class="mb-2">

    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-200 focus:ring-opacity-50">Datei hochladen</button>
  </form>

  <h2 class="text-2xl font-bold mb-4">Hochgeladene Dateien:</h2>
  <ul id="fileList" class="mb-4">

  </ul>

  <h2 class="text-2xl font-bold mb-4">Lizenz erstellen:</h2>
  <form action="create_license.php" method="post" class="mb-4">
    <label for="name" class="block">Name:</label>
    <input type="text" name="name" id="name" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500 mb-2">

    <label for="fileId" class="block">Datei ID:</label>
    <input type="text" name="fileId" id="fileId" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500 mb-2">

    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-200 focus:ring-opacity-50">Lizenz erstellen</button>
  </form>

  <button onclick="location.href='search.php'" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-200 focus:ring-opacity-50">Suchen</button>
</div>

<script>

  function updateFileList() {
    fetch('list_files.php')
      .then(response => response.json())
      .then(data => {
        const fileList = document.getElementById('fileList');
        fileList.innerHTML = '';

        data.forEach(file => {
          const listItem = document.createElement('li');
          listItem.textContent = `ID: ${file.id}, Name: ${file.name}`;
          fileList.appendChild(listItem);
        });
      });
  }


  document.addEventListener('DOMContentLoaded', function() {
    updateFileList();
  });
</script>

</body>
</html>
