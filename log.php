<?php
$logFile = 'log.txt';

echo "<!DOCTYPE html><html lang='id'><head><meta charset='UTF-8'>";
echo "<title>Riwayat Konversi</title>";
echo "<style>
    body { font-family: Arial; padding: 20px; background: #f4f4f4; }
    h1 { color: #007bff; }
    pre {
        background: white;
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        overflow-x: auto;
        white-space: pre-wrap;
        word-wrap: break-word;
    }
</style></head><body>";

echo "<h1>📜 Riwayat Konversi</h1>";

if (file_exists($logFile)) {
    $content = file_get_contents($logFile);
    if (strlen(trim($content)) === 0) {
        echo "<p><em>Belum ada riwayat konversi.</em></p>";
    } else {
        echo "<pre>$content</pre>";
    }
} else {
    echo "<p><em>Belum ada file log.</em></p>";
}

echo "</body></html>";
?>
