<?php
// Incluindo os arquivos necessários
include 'includes/header.php';
include 'includes/db.php';

// Iniciar a sessão se ainda não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar se o usuário está autenticado
if (!isset($_SESSION['usuario_id'])) {
    echo "<p>Você deve estar logado para alterar a senha.</p>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar os dados do formulário
    $nova_senha = $_POST['nova_senha'];
    $usuario_id = $_SESSION['usuario_id'];

    // Validar a nova senha
    if (empty($nova_senha)) {
        echo "<p>Senha não pode ser vazia.</p>";
        exit();
    }

    // Criptografar a nova senha
    $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);

    // Preparar a consulta para atualização da senha
    $stmt = $conn->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
    $stmt->bind_param('si', $nova_senha_hash, $usuario_id);

    // Executar a consulta
    if ($stmt->execute()) {
        echo "<p>Senha alterada com sucesso.</p>";
    } else {
        echo "<p>Erro ao alterar a senha: " . $stmt->error . "</p>";
    }

    // Fechar a declaração e a conexão
    $stmt->close();
}

include 'includes/footer.php';
