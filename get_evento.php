<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Dados de conexão à base de dados
$host = 'dpg-d1g7e4qli9vc73abi8p0-a.frankfurt-postgres.render.com';
$port = '5432';
$dbname = 'lockbit';
$user = 'lockbit_user';
$password = '0sxXxNGk7THkeqH0INX10FGi8xY4eMdv';

$connStr = "host=$host port=$port dbname=$dbname user=$user password=$password";
$conn = pg_connect($connStr);

if (!$conn) {
    echo json_encode(["erro" => "Erro de conexão ao banco de dados."]);
    exit;
}

// Consulta das entradas mais recentes
$query = "SELECT id_evento, data_evento, tipo_evento FROM evento ORDER BY id_evento DESC LIMIT 50";
$result = pg_query($conn, $query);

$dados = [];
if ($result) {
    while ($row = pg_fetch_assoc($result)) {
        $dados[] = [
            "id_evento" => (int)$row["id_evento"],
            "data_evento" => $row["data_evento"],
            "tipo_evento" => $row["tipo_evento"]
        ];
    }
    echo json_encode($dados);
} else {
    echo json_encode(["erro" => "Erro ao buscar dados."]);
}

pg_close($conn);
?>
