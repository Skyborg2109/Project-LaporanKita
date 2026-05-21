<?php
require_once 'db.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

try {
    $stmt = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC");
    $orders = $stmt->fetchAll();
    echo json_encode($orders);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
