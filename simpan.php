<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $file = "dataBuku.txt";
    //Membuat kodeBuku secara auto-increment
    if (file_exists($file) && filesize($file) > 0) {
        $getContent = file_get_contents($file);
        if (preg_match_all('/Kode Buku: (\d+)/', $getContent, $matches)) {
            $kode = $matches[1];
            $kodeAkhir = max($kode);
            $kodeBuku = $kodeAkhir + 1;
        }
    } else {
        $kodeBuku = 1;
    }
    //Menyimpan masukan menjadi variabel
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $tahunTerbit = $_POST['tahunTerbit'];
    $halaman = $_POST['halaman'];
    $penerbit = $_POST['penerbit'];
    $kategori = $_POST['kategori'];

    //Menyimpan variabel untuk dimuat pada dataBuku
    $dataBuku = "Kode Buku: $kodeBuku" . PHP_EOL;
    $dataBuku .= "Judul Buku: $judul" . PHP_EOL;
    $dataBuku .= "Pengarang Buku: $pengarang" . PHP_EOL;
    $dataBuku .= "Tahun Terbit Buku: $tahunTerbit" . PHP_EOL;
    $dataBuku .= "Halaman Buku: $halaman" . PHP_EOL;
    $dataBuku .= "Penerbit Buku: $penerbit" . PHP_EOL;
    $dataBuku .= "Kategori Buku: $kategori" . PHP_EOL;
    
    //Penamaan dan peletakan file gambar cover
    if ($_FILES['cover']['error'] === UPLOAD_ERR_OK) {
        $ekstensiFile = strtolower(pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION));
        $namaFile = $kodeBuku . "_" . $pengarang . "_" . $judul . "." . $ekstensiFile;
        $namaSementara = $_FILES['cover']['tmp_name'];
        $lokasiFile = 'cover/' . $namaFile;
        move_uploaded_file($namaSementara, $lokasiFile);
    }

    $dataBuku .= "Cover Buku: $lokasiFile" . PHP_EOL . PHP_EOL;

    //Menyimpan masukan ke dalam file dataBuku.txt
    if (file_put_contents($file, $dataBuku, FILE_APPEND) > 0){
        echo $dataBuku;
        echo "<br>";
        echo "<p> Data Successfully Overwritten to $file </p>";
    }else{
        
        echo "<p> Error! </p>";
    }

    //Membuat file txt baru untuk pendataan per-data masing-masing buku
    $fileIndiv = "$kodeBuku - $judul - $pengarang.txt";
    if (file_put_contents($fileIndiv, $dataBuku) > 0){
        echo "<br>";
        echo "<p> $fileIndiv Written successfully </p>";
    }else{
        echo "<br>";
        echo "<p> Error! </p>";
    }
}

echo "<br> <a href='input.php'><button>Back</button></a>";
echo "<br><br> <a href='cek.php'><button>Cek Data</button></a>"
?>