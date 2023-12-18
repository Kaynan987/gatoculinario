<!DOCTYPE html>
<html>
<head>
  <title>Tela de Cadastro</title>
  <link rel="stylesheet" href="style.css">
  <style>

  </style>
</head>
<body>
<header style="z-index: 40;">
    <div class="cab">
      <a href="index.php" class="hotbartext1">INÍCIO</a>
      <a href="cadastro.php" class="hotbartext1">CONTA</a>
      
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
        echo '<li><a href="login.php" class="hotbartext1">entrar</a><p class="user-status">Você não está em nenhuma conta</p></li>';
        }?>

  
</header>

    </div>

  <div class="container">
    <h2>Tela de Cadastro</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <label for="nome">Usuário:</label>
      <input type="text" id="nome" name="nome" placeholder="Digite seu usuário">

      <label for="email">Email:</label>
      <input type="text" id="email" name="email" placeholder="Digite seu email">

      <label for="password">Senha:</label>
      <input type="password" id="password" name="password" placeholder="Digite sua senha">

      <button class="button" type="submit">Cadastrar</button>
      
      <div style="display: flex; justify-content: center; margin-top: 10px;">
       
      </div>
    </form> 
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Dados de conexão com o banco de dados
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "gatoculinario";

  // Conexão com o banco de dados
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Verifica se houve algum erro na conexão
  if ($conn->connect_error) {
      die("Falha na conexão com o banco de dados: " . $conn->connect_error);
  }

  // Obtém os dados do formulário
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Verifica se o email já existe no banco de dados
  $email_check_query = "SELECT * FROM usuarios WHERE email='$email'";
  $result = $conn->query($email_check_query);

  if ($result->num_rows > 0) {
      echo "O email já está cadastrado.";
  } else {
      // Prepara e executa a inserção no banco de dados
      $sql = "INSERT INTO usuarios (nome, email, password) VALUES ('$nome', '$email', '$password')";

      if ($conn->query($sql) === TRUE) {
          echo "Cadastro realizado com sucesso!";
      } else {
          echo "Erro ao cadastrar: " . $conn->error;
      }
  }

  // Fecha a conexão com o banco de dados
  $conn->close();
}
?>


  </div>
</body>
</html>