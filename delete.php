<?php
include 'database.php';

// Inisialisasi koneksi ke database
$db = new Database();
$conn = $db->getConnection();

// Pastikan ID kontak yang akan dihapus telah diberikan melalui parameter GET
if(isset($_GET['no_id'])) {
    $id = $_GET['no_id'];

    // Periksa apakah ID adalah bilangan bulat
    if (!is_numeric($id)) {
        echo "Invalid ID.";
        exit();
    }

    // Query untuk menghapus entri berdasarkan ID
    $sql = "DELETE FROM tbl_datainfo WHERE no_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // "i" menunjukkan bahwa $id adalah integer

    if ($stmt->execute()) {
        // Penghapusan berhasil, arahkan kembali ke halaman tabel
        header("Location: index.php");
        exit();
    } else {
        // Jika terjadi kesalahan dalam penghapusan
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    // Jika ID tidak diberikan, mungkin ada kesalahan dalam permintaan
    echo "ID not provided.";
}
?>
