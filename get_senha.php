<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Liga à base de dados no Render
$host = 'dpg-d1g7e4qli9vc73abi8p0-a.frankfurt-postgres.render.com';
$port = '5432';
$dbname = 'lockbit';
$user = 'lockbit_user';
$password = '0sxXxNGk7THkeqH0INX10FGi8xY4eMdv';

$connStr = "host=$host port=$port dbname=$dbname user=$user password=$password";
$conn = pg_connect($connStr);

if (!$conn) {
    die("❌ Erro na conexão com a base de dados.");
}

// Busca todas as passwords existentes
$query = "SELECT id_cofre, password, biometria FROM cofre ORDER BY id_cofre DESC";
$result = pg_query($conn, $query);

$senhas = [];

while ($row = pg_fetch_assoc($result)) {
    $senhas[] = $row;
}

// Retorna como JSON
header('Content-Type: application/json');
echo json_encode($senhas, JSON_PRETTY_PRINT);

pg_close($conn);
?>
