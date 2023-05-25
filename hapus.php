<?php
$file = "dataBuku.txt";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kodeBuku = $_POST['kodeBuku'];

    // Membaca isi file
    $content = file_get_contents($file);

    // Mencari data buku berdasarkan kode buku
    $pattern = "/Kode Buku: $kodeBuku(.*?)Cover Buku: (.*?)\n/s";
    preg_match($pattern, $content, $matches);

    if (isset($matches[0])) {
        $dataBuku = $matches[0];

        // Menghapus data buku dari isi file
        $content = str_replace($dataBuku, '', $content);

        // Menyimpan perubahan ke dalam file
        if (file_put_contents($file, $content) !== false) {
            // Menghapus file cover jika ada
            $coverPath = trim($matches[2]);
            if ($coverPath != '') {
                unlink($coverPath);
            }
            echo "Data berhasil dihapus.";
        } else {
            echo "Gagal menghapus data.";
        }
    } else {
        echo "Data tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Data Buku</title>
</head>
<body>
    <h1>Hapus Data Buku</h1>
    <form method="POST" action="hapus.php">
        <label>Kode Buku:</label>
        <input type="text" name="kodeBuku" required>
        <input type="submit" value="Hapus">
    </form>
    <br>
    <a href="input.php"><button>Back</button></a>
</body>
</html>
