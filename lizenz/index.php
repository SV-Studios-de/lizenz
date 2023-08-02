<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lizenz System</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center mt-8">
    <form action="download.php" method="post" class="bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Datei Herunterladen</h1>
        <label for="license" class="block">Lizenz eingeben:</label>
        <input type="text" name="license" id="license" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500">
        <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-200 focus:ring-opacity-50">Datei herunterladen</button>
    </form>
</div>


<div class="min-h-screen flex items-center justify-center">
    <form action="admin.php" method="post" class="bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Admin Login</h1>
        <input type="password" placeholder="Password" name="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500">
        <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-200 focus:ring-opacity-50">Admin</button>
    </form>
</div>


</body>
</html>
