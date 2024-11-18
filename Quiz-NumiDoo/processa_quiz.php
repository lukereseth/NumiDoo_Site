<?php
// Obtém a resposta enviada e a resposta correta
$resposta_usuario = $_POST['answer'];
$resposta_certa = $_POST['resposta_certa'];

// Verifica se a resposta do usuário é igual à resposta correta
if ($resposta_usuario === $resposta_certa) {
    echo "<p>Correto! A resposta é $resposta_certa.</p>";
} else {
    echo "<p>Incorreto. A resposta correta era $resposta_certa.</p>";
}

// Link para voltar ao quiz
echo '<p><a href="quiz.php">Tentar outra pergunta</a></p>';
?>
