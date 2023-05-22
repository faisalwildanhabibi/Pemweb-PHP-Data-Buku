<?php

$file = "dataBuku.txt";
$read = file($file);

foreach ($read as $data) {
    echo $data . "<br>";
}

echo "<br> <a href='input.php'><button>Back</button></a>";
?>