<?php
require_once '../controllers/DashboardController.php';

header('Content-Type: application/json');

try {
    $host = "localhost";
    $db_name = "sistema_asistencia";
    $username = "root";
    $password = "";

    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $controller = new DashboardController($pdo);
    $controller->getDashboardData();
} catch (PDOException $e) {
    echo json_encode(['error' => "Error de conexión a la base de datos: " . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

