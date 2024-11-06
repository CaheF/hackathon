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

        <div class="campo">
            <h4>PESSOAS ATENDIDAS</h4>
        </div>

        <div class="campo">
            <h4>IDADE</h4>
        </div>

        <div class="campo">
            <h4>ETNIA</h4>
        </div>

        <div class="campo">
            <h4>MÉDIA IMC</h4>
        </div>

        <div class="campo">
            <h4>TIPO SANGUE</h4>
        </div>

        <div class="campo">
            <h4>MÉDIA PRESSÃO</h4>
        </div>
    </div>
    </section>
    </div>

    <?php 
        require('conectar.php');

        $sql = "SELECT COUNT(idAtendimento) AS total from atendimento";
        $resultado = $conn->query($sql);

        if($resultado->num_rows > 0){
            $row = $resultado->fetch_assoc();
            echo "<div class='resultTotal'>" . $row['total'] . "</div>"; 
        } else {
            echo "Nenhum dado encontrado";
        }

        $sql = "SELECT AVG(idade) AS media from atendimento";
        $resultado = $conn->query($sql);

        if ($resultado) {  // Verifica se a consulta foi bem-sucedida
            if ($resultado->num_rows > 0) {
                $row = $resultado->fetch_assoc();
                echo "<div class='resultIdade'>" . $row['media'] . "</div>";
            } else {
        echo "Nenhum dado encontrado";
            }
        } else {
        echo "Erro na consulta de média: " . $conn->error;
        }
    ?> 
</body>
</html>