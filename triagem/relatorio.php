<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saúde</title>
    <link rel="icon" href="image/aaa.png">
    <link rel="stylesheet" href="atendimento.css">
    <link rel="stylesheet" href="relatorio.css">
</head>
<body>

    <div id="container">
    <nav id="menu">
            <ul>
                <a href="./relatorio.php"><img src="image/aaa.png" alt="Logo do site"></a>
                <li><a href="cadastro.php">Cadastrar paciente</a></li>
                <li><a href="atendimento.php">Realizar triagem</a></li>
                <li><a href="triagem.php">Triagens realizadas </a></li>
                <li><a href="relatorio.php" class="active">Relatório </a></li>
            </ul>
        </nav>

        <section id="main-content">
            <?php

echo "<div class='relatorio'>";

include_once('back/conectar.php');

// Consulta SQL para agrupar e contar as idades
$sql = "SELECT TIMESTAMPDIFF(YEAR, dataNasc, CURDATE()) AS idade, COUNT(*) AS total 
        FROM cadastro 
        WHERE dataNasc IS NOT NULL 
        GROUP BY idade 
        ORDER BY total DESC 
        LIMIT 1;"; // Pega a idade mais comum

$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    echo "<h2>Relatório Geral</h2>";

    if ($row['idade'] !== null) {
        echo "<div class='dados'>A idade mais comum é: <strong>" . $row['idade'] . "</strong> anos, com <strong>" . $row['total'] . "</strong> registros.</div>";
    } else {
        echo "<div class='error'>Nenhuma idade cadastrada.</div>";
    }
} else {
    echo "<div class='error'>Erro ao executar a consulta: " . $conn->error . "</div>";
}

// Gênero mais cadastrado
$sql = "SELECT genero, COUNT(*) AS quantidade FROM cadastro GROUP BY genero ORDER BY quantidade DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<div class='dados'>O gênero mais cadastrado é: <strong>" . $row['genero'] . "</strong> com <strong>" . $row['quantidade'] . "</strong> cadastros.</div>";
} else {
    echo "<div class='error'>Nenhum dado encontrado.</div>";
}

// Tipo sanguíneo mais cadastrado
$sql = "SELECT tipoSangue, COUNT(*) AS quantidade FROM atendimento GROUP BY tipoSangue ORDER BY quantidade DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<div class='dados'>O tipo sanguíneo mais cadastrado é: <strong>" . $row['tipoSangue'] . "</strong> com <strong>" . $row['quantidade'] . "</strong> cadastros.</div>";
} else {
    echo "<div class='error'>Nenhum dado encontrado.</div>";
}

// Total de registros
$sql = "SELECT COUNT(*) AS total_registros FROM cadastro";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    echo "<div class='dados'>Total de pessoas registradas: <strong>" . $row['total_registros'] . "</strong></div>";
} else {
    echo "<div class='error'>Erro ao executar a consulta: " . $conn->error . "</div>";
}

// Peso médio
$sql = "SELECT SUM(peso) AS total_peso, COUNT(peso) AS total_registros FROM atendimento";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    if ($row['total_registros'] > 0) {
        $peso_medio = $row['total_peso'] / $row['total_registros'];
        echo "<div class='dados'>O peso médio é: <strong>" . number_format($peso_medio, 2) . "</strong> kg</div>";
    } else {
        echo "<div class='error'>Nenhum registro de peso encontrado.</div>";
    }
} else {
    echo "<div class='error'>Erro ao executar a consulta: " . $conn->error . "</div>";
}

echo "</div>";

            ?>

        </section>
    </div>
</body>
</html>