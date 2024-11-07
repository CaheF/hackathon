<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saúde</title>
    <link rel="icon" href="image/aaa.png">
    <link rel="stylesheet" href="menuRel.css">
    <link rel="stylesheet" href="relatorio.css">
</head>
<body>

<div id="container">
    <nav id="menu">
        <ul>
            <a href="./relatorio.php"><img src="image/aaa.png" alt="Logo do site"></a>
            <li><a href="cadastro.php">Evento</a></li>
        </ul>
    </nav>

    <section id="main-content">
        <div class='relatorio'>
            <h2>Dashboard</h2>
            <div class="conteudo">

                <!-- Pessoas Atendidas -->
                <div class="campo">
                    <h4>PESSOAS ATENDIDAS</h4>
                    <?php 
                    require('conectar.php');
                    $sql = "SELECT COUNT(idAtendimento) AS total FROM atendimento";
                    $resultado = $conn->query($sql);

                    if ($resultado && $resultado->num_rows > 0) {
                        $row = $resultado->fetch_assoc();
                        echo "<div class='resultTotal'>" . $row['total'] . "</div>"; 
                    } else {
                        echo "Nenhum dado encontrado";
                    }
                    ?>
                </div>

                <!-- Média de Idade -->
                <div class="campo">
                    <h4>MÉDIA DE IDADE</h4>
                    <?php 
                    $sql = "SELECT AVG(idade) AS media FROM atendimento";
                    $resultado = $conn->query($sql);

                    if ($resultado && $resultado->num_rows > 0) {
                        $row = $resultado->fetch_assoc();
                        echo "<div class='resultIdade'>" . round($row['media'], 2) . "</div>";
                    } else {
                        echo "Nenhum dado encontrado";
                    }
                    ?> 
                </div>

                <!-- Contagem por Etnia -->
                <div class="campo">
                    <h4>ETNIAS</h4>
                    <?php 
                    $sql = "SELECT cor, COUNT(*) AS quantidade FROM atendimento GROUP BY cor";
                    $resultado = $conn->query($sql);

                    if ($resultado && $resultado->num_rows > 0) {
                        while ($row = $resultado->fetch_assoc()) {
                            echo "<div class='resultCor'>" . $row['cor'] . ": " . $row['quantidade'] . "</div>";
                        }
                    } else {
                        echo "Nenhum dado encontrado";
                    }
                    ?> 
                </div>

                <!-- Média de IMC -->
                <div class="campo">
                    <h4>MÉDIA DO IMC</h4>
                    <?php 
                    $sql = "SELECT AVG(peso / (altura * altura / 10000)) AS media_imc FROM atendimento";
                    $resultado = $conn->query($sql);

                    if ($resultado && $resultado->num_rows > 0) {
                        $row = $resultado->fetch_assoc();
                        $mediaImc = $row['media_imc'];
                        echo "<div class='resultImc'>" . (!is_null($mediaImc) ? round($mediaImc, 2) : "Dados insuficientes") . "</div>";
                    } else {
                        echo "Nenhum dado encontrado";
                    }
                    ?> 
                </div>

                <!-- Tipo Sanguíneo Mais Comum -->
                <div class="campo">
    <h4>TIPOS DE SANGUE</h4>
    <?php 
    $sql = "SELECT tipoSangue, COUNT(*) AS quantidade FROM atendimento GROUP BY tipoSangue ORDER BY quantidade DESC";
    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            echo "<div class='resultSangue'>" . $row['tipoSangue'] . " = " . $row['quantidade'] .  "</div>";
        }
    } else {
        echo "Nenhum dado encontrado";
    }
    ?> 
</div>

                <!-- Média de Pressão -->
                <div class="campo">
                    <h4>MÉDIA DE PRESSÕES</h4>
                    <?php 
                    $sql = "SELECT AVG(pressao) AS media_pressao FROM atendimento";
                    $resultado = $conn->query($sql);

                    if ($resultado && $resultado->num_rows > 0) {
                        $row = $resultado->fetch_assoc();
                        $mediaPressao = $row['media_pressao'];
                        echo "<div class='resultPressao'>" . (!is_null($mediaPressao) ? round($mediaPressao, 2) : "Dados insuficientes") . "</div>";
                    } else {
                        echo "Nenhum dado encontrado";
                    }
                    ?> 
                </div>

            </div>
        </div>
    </section>
</div>

</body>
</html>
