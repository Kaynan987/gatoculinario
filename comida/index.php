<!-- ฅ•ω•ฅ -->
<?php
session_start();

// Verifica se o usuário está logado
function isLoggedIn() {
    return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>comida</title>

  <style>
   
  </style>
</head>

<body>
  <header style="z-index: 40;">

    <div class="cab">
      <a href="index.php" class="hotbartext1">INÍCIO</a>
      <a href="login.php" class="hotbartext1">CONTA</a>
      
      <?php
    if (isset($_SESSION['email']) && $_SESSION['email'] == 'root@root.com') {
        echo '<a href="dashboard.php" class="hotbartext1">ADMIN</a>';
    }
    ?>      

      <?php
      if (isset($_SESSION['email'])) {
    // Usuário está conectado, exibir o status
        echo '<li><a class="hotbartext1" href="logout.php">Sair</a><p class="user-status">Conectado como: ' . $_SESSION['email'] . '</p></li>';
      } else {
        // Usuário não está conectado, exibir mensagem alternativa
        echo '<li><a href="entrar.php" class="hotbartext1">entra</a><p class="user-status">Você não está em nenhuma conta</p></li>';
        }?>
</header>

    </div>
    <div class="direita">
      <div class="bannr">
        <div class="corzinha">
        <center>  
        <h1 class="white"> O que voce quer comer hoje?</h1>
        </center>  
          <form class="pusca" action="pesquisa.php" method="GET">
          <input type="text" id="nome_receita" name="nome_receita" placeholder="Pesquise por comida">
          <button type="submit">Pesquisar</button>          
          <center>
        </div>
      </div>
      </center>
      <section class="main">

        <div class="lista-livros">

          <?php
          $servername = "localhost";
          $username = "root";
          $password = "root";
          $dbname = "gatoculinario";

          try {
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




            $sql = $pdo->prepare("SELECT * FROM receitas");
            $sql->execute();
            $receita = $sql->fetchAll(PDO::FETCH_ASSOC);



            foreach ($receita as $receita) {
              echo '<div class="cartao">';
              echo '
              <div class="imagem">
                <img src="data:image/jpeg;base64,' . base64_encode($receita['imagem']) . '" alt="' . $receita['nome_usuario'] . '" width="400">
              </div>
              ';
          
              // Display the book name instead of stars
              echo '<h3 class="nometext" >' . $receita['nome_receita'] . '</h3>';
          
              echo '<form action="" method="post">';
              echo '<class="nometext" input type="hidden"   name="receita_id" value="' . $receita['id'] .  '">';
              echo '</form>';
              
              echo '<a href="info.php?id=' . $receita['id'] . '" class="btn-secondary2">Alugar</a>';
              echo '</div>';
          }
          
          } catch (PDOException $e) {
            echo "Erro na conexão com o banco de dados: " . $e->getMessage();
          }

          ?>


        </div>
      </section>
    </div>
  </div>

</body>

</html>