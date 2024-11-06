<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saúde</title>
    <link rel="stylesheet" href="menuRel.css">
    <link rel="stylesheet" href="relTriagem.css">
</head>
<body>
<div id="container">
    <nav id="menu">
            <ul>
                <a href="./relatorio.php"><img src="image/aaa.png" alt="Logo do site"></a>
                <li><a href="cadastro.php">Evento</a></li>
            </ul>
    </nav>
    <?php
        include_once('conectar.php');

        if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['idEvento'])){
            $idEvento = $_POST['idEvento'];
            $stmt = $conn->prepare("SELECT * FROM evento WHERE idEvento = ?");
            $stmt->bind_param("i", $idEvento);
            $stmt->execute();
            $result = $stmt->get_result();
 
        } else {
            echo "Cu";
        }

        if($result->num_rows > 0){
        ?>
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

            <div class="input">
                <label>Descrição do Evento</label>
                <textarea id="obs" name="obs" placeholder="Insira as observações"></textarea>
            </div>
            
            <div class="btn"><button type="submit" id="btnCad" name="btnCad">Cadastrar Ação</button></div>
        </main>
            </form>

    <?php
        }
    ?>

</div>
</body>
</html>