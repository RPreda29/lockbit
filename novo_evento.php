<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Dados da base PostgreSQL
$host = "dpg-d1g7e4qli9vc73abi8p0-a.frankfurt-postgres.render.com";
$port = "5432";
$dbname = "lockbit";
$user = "lockbit_user";
$password = "0sxXxNGk7THkeqH0INX10FGi8xY4eMdv";

// Lê os dados do POST
$tipo = $_POST['tipo'] ?? '';
$data_evento = $_POST['data_evento'] ?? '';

if (empty($tipo) || empty($data_evento)) {
    echo json_encode(["erro" => "Campos obrigatórios ausentes"]);
    exit;
}

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("INSERT INTO evento (tipo_evento, data_evento, id_cofre) VALUES (?, ?, 1)");
    $stmt->execute([$tipo, $data_evento]);

    echo json_encode(["sucesso" => true]);
} catch (PDOException $e) {
    echo json_encode(["erro" => "Erro ao registar evento: " . $e->getMessage()]);
}
?>
