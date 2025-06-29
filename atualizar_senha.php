<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Dados de ligação à base de dados no Render
$host = "dpg-d1g7e4qli9vc73abi8p0-a.frankfurt-postgres.render.com";
$port = "5432";
$dbname = "lockbit";
$user = "lockbit_user";
$password = "0sxXxNGk7THkeqH0INX10FGi8xY4eMdv";

// Lê a nova senha vinda por POST
$novaSenha = $_POST['senha'] ?? '';

if (empty($novaSenha)) {
    echo json_encode(["erro" => "Senha não recebida"]);
    exit;
}

try {
    // Conexão via PDO
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Atualiza a senha do cofre com ID 1
    $stmt = $pdo->prepare("UPDATE cofre SET password = ? wHERE id_cofre = 1");
    $stmt->execute([$novaSenha]);

    echo json_encode(["sucesso" => true]);
} catch (PDOException $e) {
    echo json_encode(["erro" => "Erro ao atualizar senha: " . $e->getMessage()]);
}
?>
