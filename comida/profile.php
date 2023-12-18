<?php


// Verificar se o usuário está logado, caso contrário, redirecionar para a página de login
if (!isset($_SESSION['user_id'])) {
    header("Location: entrar.php");
    exit;
}

// Função para fazer logout do usuário
function fazerLogout()
{
    // Encerrar a sessão
    session_destroy();

    // Redirecionar para a página de login após o logout
    header("Location: entrar.php");
    exit;
}

// Verificar se o formulário de logout foi enviado
if (isset($_POST['logout'])) {
    fazerLogout();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Perfil do Usuário</title>
</head>
<body>
    <h1>Bem-vindo(a) ao seu perfil</h1>
    <p>Seu conteúdo personalizado pode ser exibido aqui.</p>
    <form action="" method="post">
        <button type="submit" name="logout">Sair</button>
    </form>
</body>
</html>
