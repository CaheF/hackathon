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
                <li><a href="cadastro.php" class="active">Cadastrar paciente</a></li>
                <li><a href="atendimento.php">Realizar triagem</a></li>
                <li><a href="triagem.php">Triagens realizadas</a></li>
                <li><a href="relatorio.php">Relatório</a></li>
            </ul>
        </nav>

    <main class="principal">
    <form method="POST">
            <h2>Cadastro Paciente</h2>  
            <div class="input">
                <label>Nome Paciente</label><br>
                <input type="text" id="name" name="nome" placeholder="Insira nome do paciente" required>
            </div>

            <div class="input">
                <label>Data Nascimento</label><br>
                <input type="date" id="dataNasc" name="dataNasc" placeholder="Insira data de nascimento" required>
            </div>

            <div class="input">
                <label>Bairro</label><br>
                <input type="text" id="bairro" name="bairro" placeholder="Insira o bairro" required>
            </div>

            <div class="input">
                <label class="lbl">Gênero</label> 
                <label class="lbl">Situação Trabalhista</label><br>

                <select id="genero" name="genero" required>
                    <option value="">Selecione...</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                    <option value="Outros">Outros</option>
                </select>
                
                <select id="trabalho" name="trabalho" required>
                    <option value="">Selecione...</option>
                    <option value="Empregado">Empregado</option>
                    <option value="Desempregado">Desempregado</option>
                    <option value="Autonomo">Autonomo</option>
                    <option value="Aposentado">Aposentado</option>
                </select>
            </div>

            <div class="input">
                <label>Contato</label>
                <input type="tel" id="contato" name="contato" placeholder="(xx)xxxxx-xxxx" maxlength="11" required>
            </div>

            <div class="input">
                <label>RG ou SUS</label>
                <input type="text" id="documento" name="documento" placeholder="Insira o RG ou SUS do paciente" required>
            </div>

            <div class="input">
                <label>Campo de observação</label>
                <textarea id="obs" name="obs" placeholder="Insira as observações do paciente"></textarea>
            </div>
            
            <div class="btn"><button type="submit" id="btnCad" name="btnCad">Cadastrar</button></div>

            <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST"){

                // Inclui o arquivo de conexão com o banco de dados
                require('back/conectar.php');
                
                // Coleta os dados do formulário
                $nome = $_POST['nome'];
                $dataNasc = $_POST['dataNasc'];
                $bairro = $_POST['bairro'];
                $genero = $_POST['genero'];
                $trabalho = $_POST['trabalho'];
                $contato = $_POST['contato'];
                $documento = $_POST['documento'];
                $obs = $_POST['obs'];

                // Validação dos campos obrigatórios
                if (empty($nome) || empty($dataNasc) || empty($bairro) || empty($genero) || empty($trabalho) || empty($contato) || empty($documento)) {
                    echo "<div class='error'>Todos os campos são obrigatórios, exceto o campo de observação.</div>";
                } else {
                    // Verifica se o paciente já está cadastrado
                    $sql = "SELECT idCadastro FROM cadastro WHERE documento = ? OR contato = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ss", $documento, $contato);
                    $stmt->execute();
                    $stmt->store_result();

                    if ($stmt->num_rows > 0) {
                        echo "<div class='msg'>Paciente já cadastrado.</div>";
                    } else {
                        // Inserir novo paciente
                        $sql = "INSERT INTO cadastro (nome, dataNasc, bairro, genero, trabalho, contato, documento, obs) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ssssssss", $nome, $dataNasc, $bairro, $genero, $trabalho, $contato, $documento, $obs);
                        $stmt->execute();
                        
                        // Verifica se o cadastro foi realizado com sucesso
                        if ($stmt->affected_rows > 0) {
                            echo "<div class='msg'>Cadastro realizado com sucesso!</div>";
                        } else {
                            echo "<div class='error'>Erro ao realizar o cadastro.</div>";
                        }
                        $stmt->close();
                    }
                }

                // Fechar a conexão com o banco de dados
                $conn->close();
            }
            ?>
    </form>
    </main>
</body>
</html>
