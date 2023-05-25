<?php

$file = "dataBuku.txt";
$dataBuku = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kodeBuku = $_POST['kodeBuku'];

    // Membaca isi file
    $lines= file($file);
    $line_index=0;
    $line_index_separated=explode(": ", $lines[$line_index]);
    while($line_index_separated[1]!=$kodeBuku){
        $line_index_separated=explode(": ", $lines[$line_index]);
        $line_index+=1;
    }
    for($i=0; $i<8;$i++){
        echo $line_index_separated[1];
        array_push($dataBuku, $line_index_separated[1]);
        $line_index_separated=explode(": ", $lines[$line_index+$i]);
    }
    

    // Mencari baris yang mengandung kode buku yang akan diubah
    foreach ($lines as $line) {
        // Mengecek apakah baris mengandung kode buku yang akan diubah
        if (strpos($line, "Kode Buku: $kodeBuku") !== false) {
            $found = true;
            // Menampilkan form untuk mengubah data buku
            echo "<h2>Ubah Data Buku</h2>";
            echo "<form method='POST' action='simpan.php' enctype='multipart/form-data'>";
            echo "Kode Buku: <input type='text' name='kodeBuku' value='$dataBuku[0]' required>";
            echo "Judul Buku: <input type='text' name='judul' value='$dataBuku[1]' required><br>";
            echo "Pengarang: <input type='text' name='pengarang' value='$dataBuku[2]' required><br>";
            echo "Tahun Terbit: <input type='text' name='tahunTerbit' value='$dataBuku[3]' required><br>";
            echo "Halaman: <input type='text' name='halaman' value='$dataBuku[4]' required><br>";
            echo "Penerbit: <input type='text' name='penerbit' value='$dataBuku[5]' required><br>";
            echo "Kategori: <input type='text' name='kategori' value='$dataBuku[6]' required><br>";
            echo "Cover: <input type='file' name='cover' accept='image/*' value='$dataBuku[7]' required><br>";
            echo "<input type='submit' value='Simpan'>";
            echo "</form>";
        } else {
            $newContent .= $line . PHP_EOL;
        }
    }

    if (!$found) {
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
    <title>Ubah Data Buku</title>
</head>
<body>
    <h1>Ubah Data Buku</h1>
    <form method="POST" action="tes.php">
        <label>Kode Buku:</label>
        <input type="text" name="kodeBuku" required>
        <input type="submit" value="Ubah">
    </form>
    <br>
    <a href="input.php"><button>Back</button></a>
</body>
</html>
