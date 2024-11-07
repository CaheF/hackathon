<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Triagem</title>
    <link rel="icon" href="image/aaa.png">
    <link rel="stylesheet" href="cadastro.css">
    <link rel="stylesheet" href="menu.css">
</head>
<body>
<div id="container">
    <nav id="menu">
        <ul>
            <a href="./relatorio.php"><img src="image/aaa.png" alt="Logo do site"></a>
            <li><a href="cadastro.php" class="active">Evento</a></li>
        </ul>
    </nav>

    <main class="principal">
        <form method="POST" class="cadastro-form">
            <h2>Cadastro de Evento</h2>  

            <div class="input">
                <label>Nome do Evento</label><br>
                <input type="text" id="nome" name="nome" placeholder="Insira o nome do evento" required>
            </div>

            <div class="input">
                <label>Data realizada</label><br>
                <input type="date" id="dataEvent" name="dataEvent" placeholder="Insira a data do evento" required>
            </div>

            <div class="input">
                <label>Local do Evento</label>
                <input type="text" id="local" name="local" placeholder="Insira o local do evento" required>
            </div>

            <div class="btn"><button type="submit" id="btnCad" name="btnCad">Cadastrar Ação</button></div>

            <?php 
require('conectar.php');  // Inclui a conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $dataEvent = $_POST['dataEvent'];
    $local = $_POST['local'];

    if (empty($nome) || empty($dataEvent) || empty($local)) {
        echo "<div class='error'>Todos os campos são obrigatórios.</div>";
    } else {
        // Corrigido a consulta SQL
        $sql = "INSERT INTO evento (nome, dataEvent, localEvent) VALUES (?, ?, ?)";
        
        // Preparando a consulta
        $stmt = $conn->prepare($sql);

        // Vinculando os parâmetros (removido o $obs)
        $stmt->bind_param("sss", $nome, $dataEvent, $local);

        // Executando a consulta
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            echo "<div class='msg'>Cadastro realizado com sucesso!</div>";
        } else {
            echo "<div class='error'>Erro ao realizar o cadastro.</div>";
        }

        // Fechar a declaração
        $stmt->close();
    }
}
?>
        </form>

            <h2> Lista de Eventos</h2>
            <?php 
            // Consulta para exibir eventos cadastrados
            $sql = "SELECT idEvento, nome, dataEvent, localEvent FROM evento";
            $resultado = $conn->query($sql);

            if ($resultado->num_rows > 0) {
                echo "<ul class='patient-list'>";
                while ($row = $resultado->fetch_assoc()) {
                    echo "<li>";
                    echo "<div>";
                    echo "Nome do Evento: " . $row["nome"] . "<br>";
                    echo "Data Realizada: " . $row["dataEvent"] . "<br>";
                    echo "Local: " . $row["localEvent"] . "<br>";
                    echo "</div>";

                    // Botão de triagem
                    echo "<form action='relTriagem.php' method='POST'>";
                    echo "<input type='hidden' name='idEvento' value='" . $row["idEvento"] . "'>";
                    echo "<button type='submit' class='triage-btn'>Realizar Evento</button>";
                    echo "</form>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "Nenhum evento encontrado.";
            }

            $conn->close();
            ?>
    </main>
</div>
</body>
</html>
