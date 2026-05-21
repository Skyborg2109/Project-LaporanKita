<?php
require_once 'db.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $id = $_GET['id'] ?? null;
        try {
            if ($id) {
                // Ambil satu data berdasarkan ID
                $stmt = $pdo->prepare("SELECT * FROM menu WHERE id = ?");
                $stmt->execute([$id]);
                $item = $stmt->fetch();
                
                if ($item) {
                    $item['harga'] = (int)$item['harga'];
                    echo json_encode(["status" => "success", "data" => $item]);
                } else {
                    http_response_code(404);
                    echo json_encode(["status" => "error", "message" => "Item not found"]);
                }
            } else {
                // Ambil semua data
                $stmt = $pdo->query("SELECT * FROM menu ORDER BY id DESC");
                $menu = $stmt->fetchAll();
                
                foreach ($menu as &$item) {
                    $item['harga'] = (int)$item['harga'];
                }
                echo json_encode(["status" => "success", "data" => $menu]);
            }
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
        break;

    case 'POST':
        $input = json_decode(file_get_contents("php://input"), true);
        
        if (!$input) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Invalid JSON input"]);
            break;
        }

        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("INSERT INTO menu (nama, harga, kategori, gambar) VALUES (?, ?, ?, ?)");
            
            // Cek apakah input adalah list banyak data (array numerik)
            if (isset($input[0]) && is_array($input[0])) {
                foreach ($input as $item) {
                    $stmt->execute([
                        $item['nama'],
                        (int)$item['harga'],
                        $item['kategori'] ?? 'Makanan',
                        $item['gambar'] ?? ''
                    ]);
                }
                $message = count($input) . " items added successfully";
            } else {
                // Input adalah satu data saja
                if (isset($input['nama']) && isset($input['harga'])) {
                    $stmt->execute([
                        $input['nama'],
                        (int)$input['harga'],
                        $input['kategori'] ?? 'Makanan',
                        $input['gambar'] ?? ''
                    ]);
                    $message = "Item added successfully";
                } else {
                    throw new Exception("Missing required fields (nama, harga)");
                }
            }

            $pdo->commit();
            echo json_encode(["status" => "success", "message" => $message]);
        } catch (Exception $e) {
            $pdo->rollBack();
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
        break;

    case 'PUT':
        $input = json_decode(file_get_contents("php://input"), true);
        $id = $_GET['id'] ?? $input['id'] ?? null;
        
        if ($id) {
            try {
                $stmt = $pdo->prepare("UPDATE menu SET nama = ?, harga = ?, kategori = ?, gambar = ? WHERE id = ?");
                $stmt->execute([
                    $input['nama'],
                    (int)$input['harga'],
                    $input['kategori'],
                    $input['gambar'],
                    $id
                ]);
                echo json_encode(["status" => "success", "message" => "Item updated successfully"]);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "ID is required"]);
        }
        break;

    case 'DELETE':
        $id = $_GET['id'] ?? null;
        if ($id) {
            try {
                $stmt = $pdo->prepare("DELETE FROM menu WHERE id = ?");
                $stmt->execute([$id]);
                echo json_encode(["status" => "success", "message" => "Item deleted successfully"]);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "ID is required"]);
        }
        break;
}
