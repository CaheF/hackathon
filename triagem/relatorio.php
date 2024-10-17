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

// Consulta SQL para agrupar e contar as idades, usando o nome correto da coluna 'dataNasc'
$sql = "SELECT TIMESTAMPDIFF(YEAR, dataNasc, CURDATE()) AS idade, COUNT(*) AS total 
        FROM cadastro 
        WHERE dataNasc IS NOT NULL 
        GROUP BY idade 
        ORDER BY total DESC 
        LIMIT 1;"; // Pega a idade mais comum

// Executa a consulta
$result = $conn->query($sql);

// Verifica se houve resultado
if ($result) {
    // Pega o resultado da consulta
    $row = $result->fetch_assoc();

    echo "<br>" . "<h2>Relátorio Geral</h2>";

    // Exibe a idade mais comum e a quantidade de registros
    if ($row['idade'] !== null) {
        echo "A idade mais comum é: " . $row['idade'] . " anos, com " . $row['total'] . " registros.";
    } else {
        echo "Nenhuma idade cadastrada.";
    }
} else {
    echo "Erro ao executar a consulta: " . $conn->error;
}

                   
        $sql = "SELECT genero, COUNT(*) AS quantidade FROM cadastro GROUP BY genero ORDER BY quantidade DESC LIMIT 1";

        // Executa a consulta
        $result = $conn->query($sql);

        // Verifica se houve resultado
        if ($result->num_rows > 0) {
   
        $row = $result->fetch_assoc();

    
        echo "<br>" . "O gênero mais cadastrado é: " . $row['genero'] . " com " . $row['quantidade'] . " cadastros.";
        }else {
            echo "Nenhum dado encontrado.";
        }

    $sql = "SELECT tipoSangue, COUNT(*) AS quantidade FROM atendimento GROUP BY tipoSangue ORDER BY quantidade DESC LIMIT 1";

 
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
  
    $row = $result->fetch_assoc();
    

    echo "<br>" . "O tipo sanguíneo mais cadastrado é: " . $row['tipoSangue'] . " com " . $row['quantidade'] . " cadastros.";
    } else {
        echo "Nenhum dado encontrado.";
    }

   
    $sql = "SELECT COUNT(*) AS total_registros FROM cadastro";

    $result = $conn->query($sql);

    // Verifica se houve resultado
    if ($result) {
    // Pega o resultado da consulta
        $row = $result->fetch_assoc();
    
    // E/xibe o total de registros
        echo "<br>" . "Total de pessoas registradas: " . $row['total_registros'];
        } else {
            echo "Erro ao executar a consulta: " . $conn->error;
        }

        $sql = "SELECT SUM(peso) AS total_peso, COUNT(peso) AS total_registros FROM atendimento";

// Executa a consulta
$result = $conn->query($sql);

// Verifica se houve resultado
if ($result) {
    // Pega o resultado da consulta
    $row = $result->fetch_assoc();

    // Calcula o peso médio manualmente
    if ($row['total_registros'] > 0) {
        $peso_medio = $row['total_peso'] / $row['total_registros'];
        echo "<br>" . "O peso médio é: " . number_format($peso_medio, 2) . " kg";
    } else {
        echo "Nenhum registro de peso encontrado.";
    }
} else {
    echo "Erro ao executar a consulta: " . $conn->error;
}
    echo "</div>";
            ?>

        </section>
    </div>
</body>
</html>