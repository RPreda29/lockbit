<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Dados da base PostgreSQL no Render
$host = "dpg-d1g7e4qli9vc73abi8p0-a.frankfurt-postgres.render.com";
$port = "5432";
$dbname = "lockbit";
$user = "lockbit_user";
$password = "0sxXxNGk7THkeqH0INX10FGi8xY4eMdv";

// Recebe o datetime por POST
$dataRecebida = $_POST['data_falha'] ?? '';

if (empty($dataRecebida)) {
    echo json_encode(['erro' => 'data_falha não recebida']);
    exit;
}

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepara e insere a data fornecida
    $stmt = $pdo->prepare("INSERT INTO falha (data_falha, id_cofre) VALUES (?, 1)");
    $stmt->execute([$dataRecebida]);

    echo json_encode(['sucesso' => 'Falha de acesso registada com sucesso']);
} catch (PDOException $e) {
    echo json_encode(['erro' => 'Erro ao inserir falha de acesso: ' . $e->getMessage()]);
}
?>
