<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atendimento</title>

    <link rel="stylesheet" href="atendimento.css">

    <style>
        #menu ul li a.atendimento {
            background-color: #0cf000;
            color: black;
        }
    </style>
</head>
<body>
<div id="container">
        <nav id="menu">
            <ul>
                <a href="./relatorio.php"><img src="image/aa.png" alt="Logo do site"></a>
                <li><a href="cadastro.php" class="cadastrar">Cadastrar paciente</a></li>
                <li><a href="atendimento.php">Realizar triagem</a></li>
                <li><a href="triagem.php">Triagens realizadas </a></li>
                <li><a href="relatorio.php">Relatório </a></li>
            </ul>
        </nav>

    <main class="card principal">
        <!-- Formulário de pesquisa -->
        <div class="search-container">
            <form action="atendimento.php" method="POST">
                <input type="text" name="nomePaciente" placeholder="Pesquise o nome do paciente...">
                <button type="submit">Pesquisar</button>
            </form>
        </div>

        <div class="card-content">
            <?php
            require('back/conectar.php');

            // Verifica se o nome do paciente foi enviado via POST
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nomePaciente"])) {
                $nomePaciente = $_POST["nomePaciente"];
                $stmt = $conn->prepare("SELECT idCadastro, nome, dataNasc, bairro, genero, trabalho, contato, documento, obs FROM cadastro WHERE nome LIKE ?");
                $searchTerm = "%" . $nomePaciente . "%";
                $stmt->bind_param("s", $searchTerm);
            } else {
                $stmt = $conn->prepare("SELECT idCadastro, nome, dataNasc, bairro, genero, trabalho, contato, documento, obs FROM cadastro");
            }

            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                echo "<ul class='patient-list'>";
                while ($row = $resultado->fetch_assoc()) {
                    echo "<li>";
                    echo "<div>";
                    echo "<h4>Número de cadastro: " . $row["idCadastro"] . "</h4>";
                    echo "Nome: " . $row["nome"] . "<br>";
                    echo "Data de Nascimento: " . $row["dataNasc"] . "<br>";
                    echo "Bairro: " . $row["bairro"] . "<br>";
                    echo "Gênero: " . $row["genero"] . "<br>";
                    echo "Trabalho: " . $row["trabalho"] . "<br>";
                    echo "Contato: " . $row["contato"] . "<br>";
                    echo "Documento: " . $row["documento"] . "<br>";
                    echo "Observações: " . $row["obs"] . "<br>";
                    echo "</div>";

                    // Botão de triagem
                    echo "<form action='relTriagem.php' method='GET'>";
                    echo "<input type='hidden' name='idPaciente' value='" . $row["idCadastro"] . "'>";
                    echo "<button type='submit' class='triage-btn'>Realizar Triagem</button>";
                    echo "</form>";
                }
                echo "</ul>";
            } else {
                echo "Nenhum paciente encontrado.";
            }

            $conn->close();
            ?>
        </div>
    </main>
</div>
</body>
</html>
