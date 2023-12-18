<?php
    session_start();

    // Verifica se o usuário está logado
    function isLoggedIn() {
        return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
    }
    ?>
    <?php
    // Configuração do banco de dados
    $hostname = "localhost";
    $username = "root";
    $password = "root";
    $database = "gatoculinario";

    $conn = new mysqli($hostname, $username, $password, $database);

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM usuarios WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($query);

        if ($result->num_rows === 1) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
        } else {
            $loginError = "Credenciais inválidas";
        }
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <style>
      
    </style>
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <center>
        <div class="teste">
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
        <p>Bem-vindo a nosso site, <?php echo $_SESSION['email']; ?>!</p>
        <div class="botom">
        <a href="index.php">INICIO</a>
        <?php
        if (isset($_SESSION['email']) && $_SESSION['email'] == 'root@root.com') {
            echo '<a href="dashboard.php" class="botom">ADMIN</a>';
        }
        ?> 
            <a href="?logout=true">SAIR</a>
            
        </div>
    </center>
        <?php else : ?>
            <center><h1><p class="texto">LOGIN</p></h1></center>
            
            <?php if (isset($loginError)) : ?>
                <p><?php echo $loginError; ?></p>
            <?php endif; ?>
            <center><div class="auth-card">
            <form method="post">
            <label class="texto" for="email">Usuário:</label>
            <center> <input class="caixa" type="text" id="email" name="email" required><br></center>

                <label class="texto" for="password">Senha:</label>
                <center><input class="caixa" type="password" id="password" name="password" required><br></center>

                <center><input class="button" href="index.php"type="submit" value="Entrar"></center>
            </form>
            </div>   </center> 
    <?php endif; ?>
    </div>
    </body>
    </html>
