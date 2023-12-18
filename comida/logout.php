<?php
session_start(); // Inicia a sessão se ainda não estiver iniciada

// Destruir todas as variáveis de sessão
$_SESSION = array();

// Destruir a sessão
session_destroy();

// Redirecionar o usuário de volta para a página inicial ou outra página de sua escolha
header("Location: index.php");
exit(); // Certifica-se de que o código após o redirecionamento não seja executado
?>