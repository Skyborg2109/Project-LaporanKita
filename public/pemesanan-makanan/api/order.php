<?php
require_once 'db.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    if (isset($data['customer_name']) && isset($data['items']) && !empty($data['items'])) {
        try {
            $pdo->beginTransaction();

            $order_id = "ORD-" . strtoupper(uniqid());
            $total_price = 0;
            foreach ($data['items'] as $item) {
                $total_price += $item['price'] * $item['quantity'];
            }

            // Insert into orders table
            $stmt = $pdo->prepare("INSERT INTO orders (order_id, customer_name, total_price, status) VALUES (?, ?, ?, 'Pending')");
            $stmt->execute([$order_id, $data['customer_name'], $total_price]);

            // Insert into order_items table
            $stmtItem = $pdo->prepare("INSERT INTO order_items (order_id, product_id, name, price, quantity) VALUES (?, ?, ?, ?, ?)");
            foreach ($data['items'] as $item) {
                $stmtItem->execute([
                    $order_id,
                    $item['product_id'],
                    $item['name'],
                    $item['price'],
                    $item['quantity']
                ]);
            }

            $pdo->commit();

            echo json_encode([
                "status" => "success",
                "message" => "Order placed successfully",
                "order_details" => [
                    "order_id" => $order_id,
                    "customer_name" => $data['customer_name'],
                    "total_price" => $total_price
                ]
            ]);
        } catch (PDOException $e) {
            $pdo->rollBack();
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Incomplete data"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Method Not Allowed"]);
}
