<?php
$host = "localhost";
$db = "lockbit";
$user = "root"; // padrão do XAMPP
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $stmt = $pdo->query("SELECT password FROM cofre LIMIT 1");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($result);
} catch (PDOException $e) {
    echo json_encode(["erro" => "Erro ao aceder à base: " . $e->getMessage()]);
}
?>
