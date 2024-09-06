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
    echo "<p>Você deve estar logado para atualizar suas preferências.</p>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar e validar as preferências do formulário
    $devolucao_alertas = isset($_POST['devolucao_alertas']) ? 1 : 0;
    $novas_reservas = isset($_POST['novas_reservas']) ? 1 : 0;
    $usuario_id = $_SESSION['usuario_id'];

    // Preparar a consulta para atualizar as preferências de notificação
    $stmt = $conn->prepare("UPDATE usuarios SET devolucao_alertas = ?, novas_reservas = ? WHERE id = ?");
    $stmt->bind_param('iii', $devolucao_alertas, $novas_reservas, $usuario_id);

    // Executar a consulta
    if ($stmt->execute()) {
        echo "<p>Preferências de notificação atualizadas com sucesso.</p>";
    } else {
        echo "<p>Erro ao atualizar as preferências: " . $stmt->error . "</p>";
    }

    // Fechar a declaração
    $stmt->close();
}

// Incluir o rodapé
include 'includes/footer.php';
