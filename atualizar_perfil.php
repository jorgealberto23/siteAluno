<?php
// Incluindo arquivos necessários
include 'includes/header.php';
include 'includes/db.php';

// Iniciar a sessão se ainda não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar se o usuário está autenticado
if (!isset($_SESSION['usuario_id'])) {
    echo "<p>Você deve estar logado para atualizar seu perfil.</p>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar os dados do formulário e validar
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $usuario_id = $_SESSION['usuario_id'];

    if (empty($nome) || empty($email)) {
        echo "<p>Nome e email são obrigatórios.</p>";
        exit();
    }

    // Validar formato do email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p>Email inválido.</p>";
        exit();
    }

    // Preparar a consulta para atualização do perfil
    $stmt = $conn->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
    $stmt->bind_param('ssi', $nome, $email, $usuario_id);

    // Executar a consulta
    if ($stmt->execute()) {
        echo "<p>Perfil atualizado com sucesso.</p>";
    } else {
        echo "<p>Erro ao atualizar o perfil: " . $stmt->error . "</p>";
    }

    // Fechar a declaração e a conexão
    $stmt->close();
}

// Incluir o rodapé
include 'includes/footer.php';
