<?php
$servername = "localhost:3308";
$username = "root";
$password = "etec2024";
$dbname = "hackathon";

$conn = new mysqli($servername, $username, $password, $dbname);

//Verifica se a conexão foi estabelecida corretamente 
if ($conn->connect_error){
    die("falha na conexão: " . $conn->connect_error);
}
?>