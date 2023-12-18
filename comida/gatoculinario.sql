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
            $livros = $sql->fetchAll(PDO::FETCH_ASSOC);



            foreach ($livros as $livro) {
              echo '<div class="cartao">';
              echo '
              <div class="imagem">
                <img src="data:image/jpeg;base64,' . base64_encode($livro['imagem']) . '" alt="' . $livro['nome_usuario'] . '" width="400">
              </div>
              ';
          
              // Display the book name instead of stars
              echo '<h3 class="nometext" >' . $livro['nome_usuario'] . '</h3>';
          
              echo '<form action="" method="post">';
              echo '<class="nometext" input type="hidden"   name="livro_id" value="' . $livro['id'] .  '">';
              echo '</form>';
              
              echo '<a href="info.php?id=' . $livro['id'] . '" class="btn-secondary2">Alugar</a>';
              echo '</div>';
          }
          
          } catch (PDOException $e) {
            echo "Erro na conexão com o banco de dados: " . $e->getMessage();
          }

          ?>