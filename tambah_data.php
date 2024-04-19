<?php
include 'database.php';

// Inisialisasi koneksi ke database
$db = new Database();
$conn = $db->getConnection();

// Pesan error atau sukses setelah menambahkan data
$message = '';

// Jika ada data yang dikirimkan melalui formulir tambah
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $no_hp = $_POST['no_hp'];
    $owner = $_POST['owner'];

    // Query untuk menambahkan data baru ke database
    $insertSql = "INSERT INTO tbl_datainfo (no_hp, owner) VALUES (?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param("ss", $no_hp, $owner); // "ss" menunjukkan bahwa kedua parameter adalah string

    // Eksekusi query
    if ($stmt->execute()) {
        $message = 'Data berhasil ditambahkan.';
        header("Location: index.php");
        exit; // Pastikan untuk menggunakan exit setelah fungsi header untuk menghentikan eksekusi skrip selanjutnya
    } else {
        $message = 'Gagal menambahkan data.';
    }
    $stmt->close();
}
?>

