<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Dados da base PostgreSQL no Render
$host = "dpg-d1g7e4qli9vc73abi8p0-a.frankfurt-postgres.render.com";
$port = "5432";
$db = "lockbit";
$user = "lockbit_user";
$pass = "0sxXxNGk7THkeqH0INX10FGi8xY4eMdv";

// Lê os dados do POST
$novaSenha = $_POST['senha'] ?? '';

if (trim($novaSenha) === '') {
    echo json_encode(["erro" => "Senha não recebida"]);
    exit;
}

try {
    // Ligação com PDO para PostgreSQL
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Atualiza a senha do ID 1
    $stmt = $pdo->prepare("UPDATE cofre SET password = ? WHERE id_cofre = 1");
    $stmt->execute([$novaSenha]);

    echo json_encode(["sucesso" => true]);
} catch (PDOException $e) {
    echo json_encode(["erro" => "Erro ao atualizar senha: " . $e->getMessage()]);
}
?>
