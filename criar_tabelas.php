<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Dados da tua base PostgreSQL no Render
$host = 'dpg-d1g7e4qli9vc73abi8p0-a.frankfurt-postgres.render.com';
$port = '5432';
$dbname = 'lockbit';
$user = 'lockbit_user';
$password = '0sxXxNGk7THkeqH0INX10FGi8xY4eMdv';


$connStr = "host=$host port=$port dbname=$dbname user=$user password=$password";
$conn = pg_connect($connStr);

if (!$conn) {
    die("❌ Erro na conexão com o banco de dados.");
}

// Criação das tabelas
$sql = "
CREATE TABLE IF NOT EXISTS cofre (
  id_cofre SERIAL PRIMARY KEY,
  password VARCHAR(255) NOT NULL,
  biometria INTEGER
);

CREATE TABLE IF NOT EXISTS entrada (
  id_entrada SERIAL PRIMARY KEY,
  data_entrada TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  id_cofre INTEGER REFERENCES cofre(id_cofre)
);

CREATE TABLE IF NOT EXISTS falha (
  id_falha SERIAL PRIMARY KEY,
  data_falha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  id_cofre INTEGER REFERENCES cofre(id_cofre)
);

CREATE TABLE IF NOT EXISTS evento (
  id_evento SERIAL PRIMARY KEY,
  data_evento TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  tipo_evento VARCHAR(255),
  id_cofre INTEGER REFERENCES cofre(id_cofre)
);
";

$result = pg_query($conn, $sql);

if ($result) {
    echo "✅ Tabelas criadas com sucesso!";
} else {
    echo "❌ Erro ao criar tabelas: " . pg_last_error($conn);
}

pg_close($conn);
?>
