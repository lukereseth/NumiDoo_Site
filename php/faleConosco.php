<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Verifica se todos os campos foram preenchidos
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "Por favor, preencha todos os campos.";
        exit;
    }

    // Configurações do e-mail
    $to = "seuemail@dominio.com"; // Altere para o seu email
    $subjectEmail = "Mensagem do Fale Conosco - $subject";
    $body = "Você recebeu uma nova mensagem de $name ($email):\n\n$message";
    $headers = "From: $email";

    // Enviar e-mail
    if (mail($to, $subjectEmail, $body, $headers)) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Erro ao enviar a mensagem.";
    }
}
?>
