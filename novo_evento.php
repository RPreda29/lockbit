<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Dados da base PostgreSQL no Render
$host = "dpg-d1g7e4qli9vc73abi8p0-a.frankfurt-postgres.render.com";
$port = "5432";
$dbname = "lockbit";
$user = "lockbit_user";
$password = "0sxXxNGk7THkeqH0INX10FGi8xY4eMdv";

// Valor do tipo de evento
$tipo = 'Atualização de senha';

try {
    // Conexão PDO para PostgreSQL
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepara e executa inserção
    $stmt = $pdo->prepare("INSERT INTO evento (data_evento, tipo_evento, id_cofre) VALUES (NOW(), ?, 1)");
    $stmt->execute([$tipo]);

    echo json_encode(['sucesso' => 'Evento registado com sucesso']);
} catch (PDOException $e) {
    echo json_encode(['erro' => 'Erro ao registar evento: ' . $e->getMessage()]);
}
?>
