<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Dados da tua BD no Render
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

// Dados a inserir
$passwordCofre = '1234';
$biometria = 1;

$query = "INSERT INTO cofre (password, biometria) VALUES ($1, $2)";
$result = pg_query_params($conn, $query, [$passwordCofre, $biometria]);

if ($result) {
    echo "✅ Registo inserido com sucesso na tabela cofre!";
} else {
    echo "❌ Erro ao inserir: " . pg_last_error($conn);
}

pg_close($conn);
?>
