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
        <div class="cad">
            <h2>Cadastro Paciente</h2>  
            <div class="input"><label>Nome Paciente</label><br>
            <input type="text" id="name" name="nome" placeholder="Insira nome do paciente"></div>

            <div class="input"><label>Data Nascimento</label><br>
            <input type="date" id="data" name="data" placeholder="Insira data de nascimento"></div>

            <div class="input"><label>Bairro</label><br>
            <input type="text" id="bairro" name="bairro" placeholder="Insira o bairro"></div>

            <div class="input"><label>Gênero</label><br>
                <select id="genero" name="genero">
                    <option value="">Selecione...</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                    <option value="Outros">Outro</option>
                </select>
            </div>
        </div>
    </main>
</body>
</html>