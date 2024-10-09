<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>atendimento</title>
    <link rel="stylesheet" href="atendimento.css">
</head>
<body>
    <div class="card">
    <?php 
        require('back/conectar.php');

        $stmt = "SELECT idCadastro, nome, dataNasc, bairro, genero, trabalho, contato, documento, obs FROM cadastro"; 
        $resultado = $conn->query($stmt);

        if ($resultado->num_rows > 0) {
            // Itera sobre os resultados
            while ($row = $resultado->fetch_assoc()) {
                echo "<p>ID: " . $row["idCadastro"] . "</p>" . "<br>";
                echo "Nome: " . $row["nome"] . "<br>";
                echo "Data de Nascimento: " . $row["dataNasc"] . "<br>";
                echo "Bairro: " . $row["bairro"] . "<br>";
                echo "Gênero: " . $row["genero"] . "<br>";
                echo "Trabalho: " . $row["trabalho"] . "<br>";
                echo "Contato: " . $row["contato"] . "<br>";
                echo "Documento: " . $row["documento"] . "<br>";
                echo "Observações: " . $row["obs"] . "<br><br>";
            }
        } else {
            echo "Nenhum paciente encontrado.";
        }

        $conn->close();
    ?>
    </div>
</body>
</html>