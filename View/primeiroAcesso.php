<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="./Navegacao.php" method="post">
        <div>
            <label for="">Nome</label>
            <input type="text" name="txtNome" id="txtNome">
        </div>
        <div>
            <label for="">Email</label>
            <input type="email" name="txtEmail" id="txtEmail">
        </div>
        <div>
            <label for="">CPF</label>
            <input type="text" name="txtCPF" id="txtCpf">
        </div>
        <div>
            <label for="">Senha</label>
            <input type="password" name="txtSenha" id="txtSenha">
        </div>

        <input type="submit" value="Cadastrar" name="btnCadastrar">
    </form>
</body>
</html>