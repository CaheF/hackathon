<?php
require('back/conectar.php');

// Verifica se o idPaciente foi enviado
if (isset($_GET['idPaciente'])) {
    $idPaciente = $_GET['idPaciente'];

    // Preparar a consulta para pegar os dados do paciente
    $stmt = $conn->prepare("SELECT nome, dataNasc, bairro, genero, trabalho, contato, documento, obs FROM cadastro WHERE idCadastro = ?");
    $stmt->bind_param("i", $idPaciente);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $paciente = $resultado->fetch_assoc();
    } else {
        // Caso não encontre o paciente
        echo "Paciente não encontrado.";
        exit;
    }
} else {
    // Redirecionar se não houver idPaciente
    echo "ID do paciente não especificado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Triagem do Paciente</title>
    <link rel="stylesheet" href="atendimento.css">
    <link rel="stylesheet" href="relTriagem.css">
</head>
<body>
<div id="container">
        <nav id="menu">
            <ul>
                <a href="./relatorio.php"><img src="image/aaa.png" alt="Logo do site"></a>
                <li><a href="cadastro.php">Cadastrar paciente</a></li>
                <li><a href="atendimento.php" class="active">Realizar triagem</a></li>
                <li><a href="triagem.php">Triagens realizadas </a></li>
                <li><a href="relatorio.php">Relatório </a></li>
            </ul>
        </nav>
    <main class="principal">
    <form method="POST">
        
        <div class="input" id="alinhamentoPaciente">
            <label id="lblNome">Nome:</label>
            <label id="nomePaciente"><?php echo $paciente['nome']; ?></label>
        </div>

        <div class="input"><label class="lbl">Altura</label>
            <input type="text" id="altura" name="altura" placeholder="Insira a altura">
        </div>

        <div class="input"><label class="lbl">Peso</label>
            <input type="text" id="peso" name="peso" placeholder="Insira o peso">
        </div>

        <div class="input">
        <label class="lbl">Tipo Sangue<br></label>
        <select id="tipoSangue" name="tipoSangue">
            <option value="">Selecione...</option>
            <option value="A+">A+</option>
            <option value="B+">B+</option>
            <option value="A-">A-</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
        </select>
        </div>

        <div class="input">
            <label class="lbl">Data</label>
            <input type="date" id="data" name="data">
        </div>

        <div class="input">
            <label class="lbl">Pressão</label>
            <input type="text" id="pressao" name="pressao" placeholder="Insira a pressão">
        </div>

        <div class="input">
            <label class="lbl">Lugar Realizado</label>
            <input type="text" id="lugar" name="lugar" placeholder="Insira o local de triagem">
        </div>
        
        <div class="input">
            <label class="lbl">Atendente</label>
            <input type="text" id="atendente" name="atendente" placeholder="Insira o nome do atendente">
        </div>

        <div class="input">
                <label class="lbl">Campo de observação</label>
                <textarea id="obs" name="obs" placeholder="Insira as observações do paciente"></textarea>
        </div>

        <div class="btn">
            <button type="submit">Salvar Triagem</button>
        </div>

        <div class="msg">
        <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        // Inclui o arquivo de conexão com o banco de dados
        require('back/conectar.php');
        
        // Coleta os dados do formulário
        $idCadastro = $idPaciente;
        $altura = $_POST['altura'];
        $peso = $_POST['peso'];
        $tipoSangue = $_POST['tipoSangue'];
        $pressao = $_POST['pressao'];
        $data = $_POST['data'];
        $lugar = $_POST['lugar'];
        $atendente = $_POST['atendente'];
        $obs = $_POST['obs'];

            // Inserir novo paciente
            $sql = "INSERT INTO atendimento (idCadastro, altura, peso, tipoSangue, pressao, dia, lugar, atendente, obsAtendente) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("issssssss", $idCadastro, $altura, $peso, $tipoSangue, $pressao, $data, $lugar, $atendente, $obs);
            $stmt->execute();
            
            // Verifica se o cadastro foi realizado com sucesso
            if ($stmt->affected_rows > 0) {
                echo "<div class='cad'>";
                echo "<p>Cadastro realizado com sucesso!</p>";
                echo "</div>";
            } else {
                echo "<p>Erro ao realizar o cadastro.</p>";
            }
            $stmt->close();

        // Fechar a conexão com o banco de dados
        $conn->close();
    }
    ?>
        </div>
    </form>
</main>
</div>


</body>
</html>
