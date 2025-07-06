<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $line = "[" . date("Y-m-d H:i:s") . "] {$data['value']} {$data['from']} → {$data['result']} {$data['to']} ({$data['unit']})" . PHP_EOL;
    file_put_contents("log.txt", $line, FILE_APPEND | LOCK_EX);
    echo json_encode(["status" => "success"]);
}
?>
