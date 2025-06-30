<?php
try {
    $pdo = new PDO("pgsql:host=SEU_HOST;port=5432;dbname=SEU_BANCO", "SEU_USUARIO", "SUA_SENHA");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO wifi (ssid, senha) VALUES (:ssid, :senha)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':ssid' => 'LockBit',
        ':senha' => 'LockBit1'
    ]);

    echo "✅ Credenciais inseridas com sucesso!";
} catch (PDOException $e) {
    echo "❌ Erro ao inserir dados: " . $e->getMessage();
}
?>
