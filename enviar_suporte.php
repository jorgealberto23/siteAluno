<?php
// Incluindo arquivos necessários
include 'includes/header.php';
include 'includes/db.php';

// Iniciar a sessão se ainda não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar e validar os dados do formulário
    $nome = trim($_POST['nome']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $mensagem = trim($_POST['mensagem']);

    // Validação básica
    if (empty($nome) || empty($email) || empty($mensagem)) {
        echo "<p>Todos os campos são obrigatórios.</p>";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p>Endereço de e-mail inválido.</p>";
        exit();
    }

    // Enviar mensagem para o suporte
    $to = 'suporte@biblioteca.com';
    $subject = 'Mensagem de Suporte';
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Usando a função mail para enviar o e-mail
    if (mail($to, $subject, $mensagem, $headers)) {
        echo "<p>Sua mensagem foi enviada. Em breve você receberá uma resposta.</p>";
    } else {
        echo "<p>Erro ao enviar a mensagem. Tente novamente mais tarde.</p>";
    }
}

// Incluir o rodapé
include 'includes/footer.php';
