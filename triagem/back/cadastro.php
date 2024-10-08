<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        require('triagem/back/conectar.php');

        $nome = $_POST['nome'];
        $dataNasc = $_POST['dataNasc'];
        $bairro = $_POST['bairro'];
        $genero = $_POST['genero'];
        $trabalho = $_POST['trabalho'];
        $contato = $_POST['contato'];
        $documento = $_POST['documento'];
        $obs = $_POST['obs'];

        $sql = "SELECT idCadastro FROM cadastro WHERE documento = ? OR nome = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $documento, $nome);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                echo "Paciente já cadastrado.";
            } else {
                // Inserir novo cliente
                $sql = "INSERT INTO cadastro (nome, dataNasc, bairro, genero, trabalho, contato, documento, obs) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssssss", $nome, $dataNasc, $bairro, $genero, $trabalho, $contato, $documento, $obs);
                $stmt->execute();
                
                // Avisar que o cadastro foi realizado
                if ($stmt->affected_rows > 0) {
                    echo "Cadastro realizado com sucesso!";
                } else {
                    echo "Erro ao realizar o cadastro.";
                }
                $stmt->close();
            }

            // Fechar a conexão
            $conn->close();
    }
?>