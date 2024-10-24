<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Triagem</title>
    <link rel="icon" href="image/aaa.png">
    <link rel="stylesheet" href="cadastro.css">
    <link rel="stylesheet" href="atendimento.css">
    <style>
        .msg {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }
        .error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }
    </style>
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
    <form method="POST">
            <h2>Cadastro de Evento</h2>  

            <div class="input">
                <label>Data realizada</label><br>
                <input type="date" id="dataNasc" name="dataNasc" placeholder="Insira data de nascimento" required>
            </div>

            <div class="input">
                <label>Local do Evento</label>
                <input type="text" id="nome" name="nome" placeholder="Insira a ação que será realizada" required>
            </div>

            <div class="input">
                <label>Nome do Evento</label>
                <input type="text" id="documento" name="documento" placeholder="Insira a ação que será realizada" required>
            </div>

            <div class="input">
                <label>Descrição do Evento</label>
                <textarea id="obs" name="obs" placeholder="Insira as observações do paciente"></textarea>
            </div>
            
            <div class="btn"><button type="submit" id="btnCad" name="btnCad">Cadastrar Ação</button></div>

            <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST"){

                // Inclui o arquivo de conexão com o banco de dados
                require('back/conectar.php');
            
                $dataNasc = $_POST['dataNasc'];
                $documento = $_POST['documento'];
                $obs = $_POST['obs'];
                $nome = $_POST['nome'];

                // Validação dos campos obrigatórios
                if (empty($dataNasc)  || empty($documento) || empty($obs) || empty($nome)) {
                    echo "<div class='error'>Todos os campos são obrigatórios.</div>";
                }  else {
                        // Inserir novo paciente
                        $sql = "INSERT INTO cadastro (dataNasc, documento, obs, nome) VALUES (?, ?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ssss",$dataNasc, $documento, $obs, $nome);
                        $stmt->execute();
                        
                        // Verifica se o cadastro foi realizado com sucesso
                        if ($stmt->affected_rows > 0) {
                            echo "<div class='msg'>Cadastro realizado com sucesso!</div>";
                        } else {
                            echo "<div class='error'>Erro ao realizar o cadastro.</div>";
                        }
                        $stmt->close();
                    }

                // Fechar a conexão com o banco de dados
                $conn->close();
            }
            ?>
    </form>
    </main>
</body>
</html>
