<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>atendimento</title>
</head>
<body>
    <?php 
        require_once('triagem/back/conectar.php');
       //require_once('triagem/back/cadastro.php');

        $stmt = "SELECT idCadastro, nomePaciente, dataNasc, bairro, genero, trabalho, contato, documento, obs FROM cadastro"; 
        $resultado = $conn->query($stmt);
    ?>
</body>
</html>