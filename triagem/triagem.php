<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saúde</title>
    <link rel="stylesheet" href="atendimento.css">
    
    <style>
        #menu ul li a.triagem {
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
                <form action="triagem.php" method="POST">
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
                    $searchTerm = "%" . $nomePaciente . "%";
                    $stmt = $conn->prepare("SELECT atendimento.idAtendimento, cadastro.idCadastro, cadastro.nome, atendimento.peso, atendimento.tipoSangue, atendimento.pressao, atendimento.dia, atendimento.lugar, atendimento.atendente, atendimento.obsAtendente FROM atendimento JOIN cadastro ON cadastro.idCadastro = atendimento.idCadastro WHERE cadastro.nome LIKE ?");
                    $stmt->bind_param("s", $searchTerm);
                } else {
                    $stmt = $conn->prepare("SELECT atendimento.idAtendimento, cadastro.idCadastro, cadastro.nome, atendimento.peso, atendimento.tipoSangue, atendimento.pressao, atendimento.dia, atendimento.lugar, atendimento.atendente, atendimento.obsAtendente FROM atendimento JOIN cadastro ON cadastro.idCadastro = atendimento.idCadastro");
                }

                $stmt->execute();
                $resultado = $stmt->get_result();

                if ($resultado->num_rows > 0) {
                    echo "<ul class='patient-list'>";
                    while ($row = $resultado->fetch_assoc()) {
                        echo "<li>";
                        echo "<div>";
                        echo "<h4>Número da triagem: " . $row["idAtendimento"] . "</h4>";
                        echo "Nome: " . $row["nome"] . "<br>"; 
                        echo "Peso: " . $row["peso"] . "<br>";
                        echo "Tipo sanguíneo: " . $row["tipoSangue"] . "<br>";
                        echo "Pressão: " . $row["pressao"] . "<br>";
                        echo "Dia: " . $row["dia"] . "<br>";
                        echo "Local: " . $row["lugar"] . "<br>";
                        echo "Atendente: " . $row["atendente"] . "<br>";
                        echo "Observação do Atendente: " . $row["obsAtendente"] . "<br>";
                        echo "</div>";
                        echo "</li>";
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
