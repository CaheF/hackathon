    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        // Inclui o arquivo de conexão com o banco de dados
        require('conectar.php');
        
        // Coleta os dados do formulário
        $nome = $_POST['nome'];
        $dataNasc = $_POST['dataNasc'];
        $bairro = $_POST['bairro'];
        $genero = $_POST['genero'];
        $trabalho = $_POST['trabalho'];
        $contato = $_POST['contato'];
        $documento = $_POST['documento'];
        $obs = $_POST['obs'];

        // Verifica se o paciente já está cadastrado
        $sql = "SELECT idCadastro FROM cadastro WHERE documento = ? OR nome = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $documento, $nome);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<p>Paciente já cadastrado.</p>";
        } else {
            // Inserir novo paciente
            $sql = "INSERT INTO cadastro (nome, dataNasc, bairro, genero, trabalho, contato, documento, obs) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssss", $nome, $dataNasc, $bairro, $genero, $trabalho, $contato, $documento, $obs);
            $stmt->execute();
            
            // Verifica se o cadastro foi realizado com sucesso
            if ($stmt->affected_rows > 0) {
                echo "<p>Cadastro realizado com sucesso!</p>";
            } else {
                echo "<p>Erro ao realizar o cadastro.</p>";
            }
            $stmt->close();
        }

        // Fechar a conexão com o banco de dados
        $conn->close();
    }
    ?>
