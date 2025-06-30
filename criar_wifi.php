<?php
try {
    $pdo = new PDO("pgsql:host=SEU_HOST;port=5432;dbname=SEU_BANCO", "SEU_USUARIO", "SUA_SENHA");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "
        CREATE TABLE IF NOT EXISTS wifi (
            ssid VARCHAR(255),
            senha VARCHAR(255)
        );
    ";

    $pdo->exec($sql);
    echo "✅ Tabela 'wifi' criada com sucesso!";
} catch (PDOException $e) {
    echo "❌ Erro ao criar tabela: " . $e->getMessage();
}
?>
