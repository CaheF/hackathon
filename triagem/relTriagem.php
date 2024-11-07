<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saúde</title>
    <link rel="stylesheet" href="menuRel.css">
    <link rel="stylesheet" href="relTriagem.css">
</head>
<body>
<div id="container">
    <nav id="menu">
            <ul>
                <a href="./relatorio.php"><img src="image/aaa.png" alt="Logo do site"></a>
                <li><a href="cadastro.php">Evento</a></li>
            </ul>
    </nav>
    <?php
        include_once('conectar.php');

        if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['idEvento'])){
            $idEvento = $_POST['idEvento'];
            $stmt = $conn->prepare("SELECT * FROM evento WHERE idEvento = ?");
            $stmt->bind_param("i", $idEvento);
            $stmt->execute();
            $result = $stmt->get_result();
 
        } else {
            echo "Cu";
        }

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $date = Datetime::createFromFormat('Y-m-d', $row['dataEvent']);
        ?>
        <main class="principal">
            <form method="POST" class="cadastro-form">
            <h2>Atendimento</h2>  

            <div class="input" id="nome">
                <?php
                    echo "<div class='infos'>";
                    echo "<label>Nome da ação:</label>" ."<input type=text name='nome' id='nome'>";
                    echo "</div>";

                    echo "<div class='infos'>";
                    echo "<label id='data'>Data:</label>" ."<p>"  . $date->format('d/m/Y') . "</p>";
                    echo "</div>";
                ?>
            </div>
            
            <div class="input" id="dados">
                <label>Idade</label>
                <input type="int"  name="idade" id="idade" placeholder="Idade" required>

                <label>Peso</label>
                <input type="int"  name="peso" id="peso" placeholder="Peso aprox." required>

                <label>Etnia</label>
                <select name="etnia" id="etnia">
                    <option value="">Selecione...</option>
                    <option value="pardo">Pardo</option>
                    <option value="branco">Branco</option>
                    <option value="negro">Negro</option>
                    <option value="indigena">Indígena</option>
                    <option value="amarelo">Amarelo</option>
                </select>

            </div>

            <div class="input" id="dados">
                <label id="lblAlt">Altura</label>
                <input type="number"  name="altura" id="altura" placeholder="altura(cm)" required>

                <label>Pressão</label>
                <input type="float"  name="pressao" id="pressao" placeholder="Pressão" required>

                <label id="lblStatus">Status</label>
                <select name="status" id="status">
                    <option value="">Selecione...</option>
                    <option value="empregado">Empregado</option>
                    <option value="desempregado">Desempregado</option>
                    <option value="aposentado">Aposentado</option>
                    <option value="estudante">Estudante</option>
                </select>
<input type="hidden" name="idEvento" value="<?php echo $idEvento; ?>">
                <label id="lblSangue">Tipo Sangue</label>
                <select name="tipoSangue" id="tipoSangue">
                    <option value="">Selecione...</option>
                    <option value="A">A</option>
                    <option value="A-">A-</option>
                    <option value="B">B</option>
                    <option value="B-">B-</option>
                    <option value="AB">AB</option>
                    <option value="AB-">AB-</option>
                    <option value="O">O</option>
                    <option value="O-">O-</option>
                </select>
                
            </div>
            
            <div class="btn"><button type="submit" id="btnCad" name="btnCad">Finalizar Atendimento</button></div>
        
        </main>
            </form>
        <?php } ?>
    <?php
       
       if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['idade'])){
        $idade = $_POST['idade'];
        $peso = $_POST['peso'];
        $cor = $_POST['etnia'];
        $altura = $_POST['altura'];
        $status = $_POST['status'];
        $pressao = $_POST['pressao'];
        $tipoSangue = $_POST['tipoSangue'];
        $acao = $_POST['nome'];

        $sql = "INSERT INTO atendimento(idade, peso, altura, sitTrabalho, pressao, tipoSangue, cor, acao) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("iiisdsss", $idade, $peso, $altura, $status, $pressao, $tipoSangue, $cor, $acao);

        $stmt->execute();

        if($stmt->affected_rows > 0){
            echo "Atendimento realizado";
        } else {
            echo "Erro ao realizar o atendimento";
        }
       }

       $stmt->close();
       $conn->close();
    ?>

</div>
</body>
</html>