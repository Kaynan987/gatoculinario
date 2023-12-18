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
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Livros</title>
    <style>
    </style>
</head>
<body class="funto">
    
    <h1 class="titulo">sua pesquisa foi essas</h1>
    <?php

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "gatoculinario";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        if (isset($_GET['nome_usuario']) or isset($_GET['nome_usuario'])) {            
            if (isset($_GET['nome_usuario'])){
                $nome_usuario = $_GET['nome_usuario'];
            }
   
            $sql = "SELECT * FROM receitas 
                    WHERE nome_usuario LIKE '%$nome_usuario%'";
    
            $result = $pdo->query($sql);
    
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="book-card">';
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['imagem']) . '" alt="' . $row['nome_usuario'] . '" width="200">';
                    echo '<div class="book-card-content">';
                    echo '<h2>' . $row['nome_usuario'] . '</h2>';
                    echo '</div>';
                    echo '</div>';
                }
            } 
            else {
                echo "<p>para de ser besta e pesquise algo q existe</p>";
            }
        }
    
    } catch (PDOException $e) {
        echo "Erro na conexão com o banco de dados: " . $e->getMessage();
    }
     
    ?>


</body>
</html>
