<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["convert_php"])) {
    $value = floatval($_POST["value"]);
    $from = $_POST["fromUnit"];
    $to = $_POST["toUnit"];

    $satuan = [
        "km" => 1000,
        "hm" => 100,
        "dam" => 10,
        "m" => 1,
        "dm" => 0.1,
        "cm" => 0.01,
        "mm" => 0.001,
        "ft" => 0.3048
    ];

    if (isset($satuan[$from]) && isset($satuan[$to])) {
        $hasil = ($value * $satuan[$from]) / $satuan[$to];
        echo "<h2>Hasil Konversi PHP</h2>";
        echo "<p>$value $from = $hasil $to</p>";
        file_put_contents("log.txt", "$value $from → $hasil $to\n", FILE_APPEND);
    } else {
        echo "<p>Unit tidak dikenali.</p>";
    }
} else {
    echo "<p>Gunakan tombol Convert PHP dari form sebelumnya.</p>";
}
?>
