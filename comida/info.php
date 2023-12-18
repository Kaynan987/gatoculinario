<!-- ฅ•ω•ฅ -->
<?php
session_start();

// Verifica se o usuário está logado
function isLoggedIn() {
    return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<link rel="stylesheet" href="style.css">
  
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>gatoculinario</title>
  <style>
  </style>
</head>
<body>
  <h1>receita</h1>
  <center>  
  <?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "gatoculinario";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = $pdo->prepare("SELECT * FROM receitas WHERE id = :id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        $post = $sql->fetch(PDO::FETCH_ASSOC);
        

        if ($post) {
            echo "<h2>Detalhes da receita</h2>";
            echo "<img src='data:image/jpeg;base64," . base64_encode($post['imagem']) . "' alt='" . $post['nome_usuario'] . "' width='200'>";
            echo "<h3>" . $post['nome_usuario'] . "</h3>";
            echo "<p>" . $post['receita'] . "</p>";
            

          } else {
            echo "<p>não encontrado.</p>";
        }
    }
} catch (PDOException $e) {
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
}
?>
</center>
  
  
  
</body>
</html>
