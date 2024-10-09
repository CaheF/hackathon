<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Triagem</title>
    <link rel="stylesheet" href="cadastro.css">
</head>
<body>
    <main>
    <form action="back/cadastro.php" method="POST">
        <div class="cad">
            <h2>Cadastro Paciente</h2>  
            <div class="input"><label>Nome Paciente</label><br>
            <input type="text" id="name" name="nome" placeholder="Insira nome do paciente">
            </div>

            <div class="input"><label>Data Nascimento</label><br>
            <input type="date" id="dataNasc" name="dataNasc" placeholder="Insira data de nascimento"></div>

            <div class="input"><label>Bairro</label><br>
            <input type="text" id="bairro" name="bairro" placeholder="Insira o bairro"></div>

            <div class="input"><label class="lbl">Gênero</label> 
                <label class="lbl">Situação Trabalhista</label><br>

                <select id="genero" name="genero">
                    <option value="">Selecione...</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                    <option value="Outros">Outros</option>
                </select>
                
                <select id="trabalho" name="trabalho">
                    <option value="">Selecione...</option>
                    <option value="Empregado">Empregado</option>
                    <option value="Desempregado">Desempregado</option>
                    <option value="Autonomo">Autonomo</option>
                    <option value="Aposentado">Aposentado</option>
                </select>
            </div>

            <div class="input">
                <label>Contato</label>
                <input type="tel" id="contato" name="contato" placeholder="(xx)xxxxx-xxxx">
            </div>

            <div class="input">
                <label>RG ou SUS</label>
                <input type="text" id="documento" name="documento" placeholder="Insira o RG ou SUS do paciente">
            </div>

            <div class="input">
                <label>Campo de observação</label>
                <textarea id="obs" name="obs" placeholder="Insira as observações do paciente"></textarea>

                
            </div>
            
        </div>
        <div class="btn"><button type="submit" id="btnCad" name="btnCad">Cadastrar</button></div>
    </form>
    </main>
</body>
</html>