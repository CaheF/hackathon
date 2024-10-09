<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saúde</title>
    <link rel="stylesheet" href="atendimento.css">
    <style>
        #menu ul li a.triagem{
            background-color: #0cf000;
            color: black;
        }
    </style>
</head>
<body>

    <div id="container">
        <nav id="menu">
            <ul>
                <li><a href="cadastro.php">Cadastrar paciente</a></li>
                <li><a href="atendimento.php">Realizar triagem</a></li>
                <li><a href="triagem.php" class="triagem">Ver triagens </a></li>
                <li><a href="relatorio.php">Relatório </a></li>
            </ul>
        </nav>

        <section id="main-content">
            <?php
                 echo "<h1>teste</h1>";       
            ?>
        </section>
    </div>
</body>
</html>