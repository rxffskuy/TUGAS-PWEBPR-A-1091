<?php
include 'database.php';

// Inisialisasi koneksi ke database
$db = new Database();
$conn = $db->getConnection();

// Query untuk mengambil data kontak
$sql = "SELECT * FROM tbl_datainfo";
$result = $conn->query($sql);

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
        // Refresh halaman setelah menambahkan data
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        $message = 'Gagal menambahkan data.';
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashbord</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');

        *{
            list-style: none;
            text-decoration: none;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Open Sans', sans-serif;
        }

        body{
            background: #f5f6fa;
        }

        .wrapper .sidebar{
            background: rgb(5, 68, 104);
            position: fixed;
            top: 0;
            left: 0;
            width: 225px;
            height: 100%;
            padding: 20px 0;
            transition: all 0.5s ease;
        }

        .wrapper .sidebar .profile{
            margin-bottom: 30px;
            text-align: center;
        }

        .wrapper .sidebar .profile img{
            display: block;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto;
        }

        .wrapper .sidebar .profile h3{
            color: #ffffff;
            margin: 10px 0 5px;
        }

        .wrapper .sidebar .profile p{
            color: rgb(206, 240, 253);
            font-size: 14px;
        }

        .wrapper .sidebar ul li a{
            display: block;
            padding: 13px 30px;
            border-bottom: 1px solid #10558d;
            color: rgb(241, 237, 237);
            font-size: 16px;
            position: relative;
        }

        .wrapper .sidebar ul li a .icon{
            color: #dee4ec;
            width: 30px;
            display: inline-block;
        }

        .wrapper .sidebar ul li a:hover,
        .wrapper .sidebar ul li a.active{
            color: #0c7db1;
            background:white;
            border-right: 2px solid rgb(5, 68, 104);
        }

        .wrapper .sidebar ul li a:hover .icon,
        .wrapper .sidebar ul li a.active .icon{
            color: #0c7db1;
        }

        .wrapper .sidebar ul li a:hover:before,
        .wrapper .sidebar ul li a.active:before{
            display: block;
        }

        .wrapper .section{
            width: calc(100% - 225px);
            margin-left: 225px;
            transition: all 0.5s ease;
        }

        .wrapper .section .top_navbar{
            background: rgb(7, 105, 185);
            height: 50px;
            display: flex;
            align-items: center;
            padding: 0 30px;
        }

        .wrapper .section .top_navbar .hamburger a{
            font-size: 28px;
            color: #f4fbff;
        }

        .wrapper .section .top_navbar .hamburger a:hover{
            color: #a2ecff;
        }

        body.active .wrapper .sidebar{
            left: -225px;
        }

        body.active .wrapper .section{
            margin-left: 0;
            width: 100%;
        }

        /*Tabel */
        .table-wrapper {
            margin-top: 20px;
            margin-left: 220px; /* Menambahkan margin kiri sejajar dengan lebar sidebar */
        }

        .table-wrapper table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-wrapper th,
        .table-wrapper td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        .table-wrapper th {
            background-color: #0c7db1;
            color: white;
        }

        .table-wrapper tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Tombol Edit */
        .btn-edit {
            background-color: green;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        /* Tombol Delete */
        .btn-delete {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        /* Tombol Tambah Data */
        .btn-tambah {
            margin-bottom: 10px;
            background-color: #0c7db1;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            display: block;
            text-align: center;
            margin-left: 20px;
        }
    </style>
</head>
<body>
   
<div class="wrapper">
        <div class="section">
            <div class="top_navbar">
                <div class="hamburger">
                    <a href="#">
                        <i class="fas fa-bars"></i>
                    </a>
                </div>
            </div>
             
        </div>
        <div class="sidebar">
            <div class="profile">
                <img src="https://berita.yodu.id/wp-content/uploads/2021/12/1-solo-leveling_res.jpg" alt="profile_picture">
                <h3>Sung Jinwoo</h3>
                <p>Mahasiswa</p>
            </div>
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"><i class="fas fa-home"></i></span>
                        <span class="item">Home</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class="fas fa-desktop"></i></span>
                        <span class="item">My Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="active">
                        <span class="icon"><i class="fas fa-user-friends"></i></span>
                        <span class="item">Mahasiswa</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class="fas fa-cog"></i></span>
                        <span class="item">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                        <span class="item">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
       
        <!-- Tabel -->
        <div class="table-wrapper">
            <a href='formulir.php' class='btn-tambah' style='width: 150px;'>Tambah Data</a>
            <form id="formTambah" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="display: none;">
                <input type="text" name="no_hp" placeholder="Nomor HP" required>
                <input type="text" name="owner" placeholder="Owner" required>
                <button type="submit">Tambah</button>
            </form>
            <?php if ($message != ''): ?>
                <div><?php echo $message; ?></div>
            <?php endif; ?>
            <table>
                <thead>
                    <tr>
                        <th>No ID</th>
                        <th>No HP</th>
                        <th>Owner</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop melalui setiap baris hasil query
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["no_id"] . "</td>";
                            echo "<td>" . $row["no_hp"] . "</td>";
                            echo "<td>" . $row["owner"] . "</td>";
                            echo "<td>
                                    <div class='flex justify-center space-x-4'>
                                        <a href='edit.php?no_id=" . $row["no_id"] . "' class='btn-edit'>Edit</a>
                                        <a href='delete.php?no_id=" . $row["no_id"] . "' class='btn-delete' onclick='return confirm(\"Apakah Anda yakin ingin menghapus kontak ini?\")'>Delete</a>
                                    </div>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script>
        var hamburger = document.querySelector(".hamburger");
        hamburger.addEventListener("click", function(){
            document.querySelector("body").classList.toggle("active");
        });
    </script>
</body>
</html>
