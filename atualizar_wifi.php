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

// Lê os dados enviados pela app
$ssid = $_POST['ssid'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($ssid) || empty($senha)) {
    echo json_encode(["erro" => "Campos 'ssid' e 'senha' são obrigatórios"]);
    exit;
}

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Atualiza o primeiro registo (ou o único)
    $stmt = $pdo->prepare("UPDATE wifi SET ssid = ?, senha = ?");

    $stmt->execute([$ssid, $senha]);

    echo json_encode(["sucesso" => true, "ssid" => $ssid]);
} catch (PDOException $e) {
    echo json_encode(["erro" => "Erro ao atualizar Wi-Fi: " . $e->getMessage()]);
}
?>
