<!-- ฅ•ω•ฅ -->
<?php
session_start();

// Verifica se o usuário está logado
function isLoggedIn() {
    return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
  
    <title>Cadastro de Livros no livro</title>
    <header>
        <nav>
            <ul>
                <li><a href="dashboard.php">Voltar</a></li>
                <div>
                </div>
                <script>
                    
                </script>
            </ul>
        </nav>
    </header>
    
    <!DOCTYPE html>
<html>
<head>
  
    <style>
       
    </style>
</head>
<body>

    
</head>
<body>   
    <div class="container">
        <h2>Cadastro de Livros no livro</h2>
    <hr>

    <form id="uploadForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <label for="imagem">Selecione uma imagem:</label>
            <input type="file" name="imagem" accept="image/*" id="imagemInput" onchange="previewImage(event)">
            <br>
            <img id="imagemPreview" src="" alt="Preview da imagem" style="max-width: 300px;">
            <br>

    <hr>
    <label for="nome_usuario">Nome</label>
            <input type="text" id="nome_usuario" name="nome_usuario" placeholder="Digite o seu nome" required>

            <label for="receita">receita:</label>
            <textarea id="receita" name="receita" placeholder="Digite a receita" required></textarea>
            <button type="submit" name="cadastrar">Cadastrar</button>
        </form>
        

        
        <?php

        // Conexão com o banco de dados
        $host = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "gatoculinario";

        $conn = new mysqli($host, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        // Verifica se o formulário foi enviado
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nome_usuario = $_POST['nome_usuario'];
            $receita = $_POST['receita'];
            $imagem = $_FILES["imagem"];           

            // Verifica se uma imagem foi enviada
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
                $imagem = $_FILES["imagem"];
                $nomeFinal = time() . '_' . $imagem["name"];

            if (move_uploaded_file($imagem["tmp_name"], $nomeFinal)) {
                $conteudo = file_get_contents($nomeFinal);
                $conteudo = $conn->real_escape_string($conteudo);

                    // Prepara e executa a inserção no banco de dados
                    $sql = "INSERT INTO receitas (nome_usuario  , receita, imagem) 
                    VALUES ('$nome_usuario', '$receita', '$conteudo')";
            
            if ($conn->query($sql) === TRUE) {
                echo "Cadastro do livro realizado com sucesso!";
            } else {
                echo "Erro ao cadastrar o livro: " . $conn->error;
            }

                    // Remove o arquivo temporário da imagem
                    unlink($nomeFinal);
                } else {
                    echo "Erro ao fazer o upload da imagem.";
                }
            } else {
                echo "Você não enviou uma imagem.";
            }
        }

       
        ?>

    </div>
</div>
<script>
        // Função para mostrar a imagem selecionada no elemento <img>
        function previewImage(event) {
            var input = event.target;
            var img = document.getElementById("imagemPreview");

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    img.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                img.src = "";
            }
        }
    </script>
</body>
</html>
