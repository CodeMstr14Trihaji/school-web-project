<?php
echo "<!DOCTYPE html><html lang='id'><head><meta charset='UTF-8'><title>Hasil Konversi</title></head><body>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Konversi PANJANG
    if (isset($_POST["convert_php_length"])) {
        $value = floatval($_POST["value"]);
        $from = $_POST["fromUnit"];
        $to = $_POST["toUnit"];

        $panjang = [
            "km" => 1000,
            "hm" => 100,
            "dam" => 10,
            "m"  => 1,
            "dm" => 0.1,
            "cm" => 0.01,
            "mm" => 0.001,
            "ft" => 0.3048
        ];

        if (isset($panjang[$from]) && isset($panjang[$to])) {
            $hasil = ($value * $panjang[$from]) / $panjang[$to];
            echo "<h2>Hasil Konversi Panjang (PHP)</h2>";
            echo "<p>$value $from = $hasil $to</p>";
            file_put_contents("log.txt", "Panjang: $value $from → $hasil $to\n", FILE_APPEND);
        } else {
            echo "<p>Unit panjang tidak dikenali.</p>";
        }
    }

    // Konversi BERAT
    elseif (isset($_POST["convert_php_weight"])) {
        $value = floatval($_POST["weightValue"]);
        $from = $_POST["fromWeight"];
        $to = $_POST["toWeight"];

        $berat = [
            "kg" => 1000,
            "hg" => 100,
            "dag" => 10,
            "g"  => 1,
            "dg" => 0.1,
            "cg" => 0.01,
            "mg" => 0.001,
            "lb" => 453.592
        ];

        if (isset($berat[$from]) && isset($berat[$to])) {
            $hasil = ($value * $berat[$from]) / $berat[$to];
            echo "<h2>Hasil Konversi Berat (PHP)</h2>";
            echo "<p>$value $from = $hasil $to</p>";
            file_put_contents("log.txt", "Berat: $value $from → $hasil $to\n", FILE_APPEND);
        } else {
            echo "<p>Unit berat tidak dikenali.</p>";
        }
    } else {
        echo "<p>Tidak ada aksi yang dikenali.</p>";
    }
} else {
    echo "<p>Gunakan tombol Convert PHP dari form sebelumnya.</p>";
}

echo "</body></html>";
?>
