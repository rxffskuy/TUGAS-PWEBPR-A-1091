<?php
// Include file database.php untuk inisialisasi koneksi
include 'database.php';

// Inisialisasi koneksi ke database
$db = new Database();
$conn = $db->getConnection();

// Mendapatkan nomor ID dari parameter URL
$no_id = $_GET['no_id'];

// Query untuk mendapatkan data yang akan diedit berdasarkan nomor ID
$sql = "SELECT * FROM tbl_datainfo WHERE no_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $no_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

// Pesan error atau sukses setelah mengedit data
$message = '';

// Jika ada data yang dikirimkan melalui formulir edit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $no_hp = $_POST['no_hp'];
    $owner = $_POST['owner'];

    // Query untuk mengupdate data yang ada di database
    $updateSql = "UPDATE tbl_datainfo SET no_hp = ?, owner = ? WHERE no_id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("ssi", $no_hp, $owner, $no_id); // "ssi" menunjukkan bahwa parameter terakhir adalah integer

    // Eksekusi query
    if ($stmt->execute()) {
        $message = 'Data berhasil diupdate.';
        header("Location: index.php"); // Redirect kembali ke halaman utama setelah mengedit
        exit;
    } else {
        $message = 'Gagal mengupdate data.';
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Sisipkan bagian head HTML yang diperlukan -->
</head>
<body>
    <!-- Formulir untuk mengedit data -->
    <h2>Edit Data</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?no_id=" . $row['no_id']); ?>" method="post">
        <label for="no_hp">Nomor HP:</label><br>
        <input type="text" id="no_hp" name="no_hp" value="<?php echo $row['no_hp']; ?>" required><br>
        <label for="owner">Owner:</label><br>
        <input type="text" id="owner" name="owner" value="<?php echo $row['owner']; ?>" required><br><br>
        <button type="submit">Update Data</button>
    </form>
    <div><?php echo $message; ?></div>
</body>
</html>
