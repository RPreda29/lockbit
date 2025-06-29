<?php
$host = "localhost";
$db = "lockbit";
$user = "root"; // substitui se usares outro
$pass = "";

// Lê os dados recebidos via POST
$novaSenha = $_POST['senha'] ?? '';

if ($novaSenha === '') {
    echo json_encode(["erro" => "Senha não recebida"]);
    exit;
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $stmt = $pdo->prepare("UPDATE cofre SET password = ? WHERE id_cofre = 1");
    $stmt->execute([$novaSenha]);
    echo json_encode(["sucesso" => true]);
} catch (PDOException $e) {
    echo json_encode(["erro" => "Erro ao atualizar senha: " . $e->getMessage()]);
}
?>
