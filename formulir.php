<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Tambah Data</title>
    <!-- Tambahkan CSS styles -->
</head>
<body>
    <h2>Formulir Tambah Data</h2>
    <form action="tambah_data.php" method="post">
        <label for="no_hp">Nomor HP:</label><br>
        <input type="text" id="no_hp" name="no_hp" required><br>
        <label for="owner">Owner:</label><br>
        <input type="text" id="owner" name="owner" required><br><br>
        <button type="submit">Tambah Data</button>
    </form>
</body>
</html>
