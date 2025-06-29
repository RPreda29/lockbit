<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = 'dpg-d1g7e4qli9vc73abi8p0-a.frankfurt-postgres.render.com';
$port = '5432';
$dbname = 'lockbit';
$user = 'lockbit_user';
$password = '0sxXxNGk7THkeqH0INX10FGi8xY4eMdv';

$connStr = "host=$host port=$port dbname=$dbname user=$user password=$password";
$conn = pg_connect($connStr);

if (!$conn) {
    echo json_encode(["erro" => "Erro na conexão com a base de dados."]);
    exit;
}

$query = "SELECT password FROM cofre ORDER BY id_cofre DESC LIMIT 1";
$result = pg_query($conn, $query);

if ($row = pg_fetch_assoc($result)) {
    echo json_encode(["valor" => $row['password']]);
} else {
    echo json_encode(["erro" => "Nenhuma senha encontrada."]);
}

pg_close($conn);
?>
