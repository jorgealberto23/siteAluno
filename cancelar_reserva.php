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
    echo "<p>Você deve estar logado para cancelar uma reserva.</p>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar e validar o ID da reserva
    $reserva_id = intval($_POST['reserva_id']);

    if ($reserva_id <= 0) {
        echo "<p>ID da reserva inválido.</p>";
        exit();
    }

    // Consultar reserva usando prepared statements
    $stmt = $conn->prepare("SELECT * FROM reservas WHERE id = ?");
    $stmt->bind_param('i', $reserva_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $reserva = $result->fetch_assoc();

    if ($reserva) {
        // Cancelar a reserva usando prepared statements
        $stmt = $conn->prepare("DELETE FROM reservas WHERE id = ?");
        $stmt->bind_param('i', $reserva_id);
        if ($stmt->execute()) {
            // Atualizar status do livro usando prepared statements
            $stmt = $conn->prepare("UPDATE livros SET disponivel = 1 WHERE id = ?");
            $stmt->bind_param('i', $reserva['livro_id']);
            $stmt->execute();
            echo "<p>Reserva cancelada com sucesso.</p>";
        } else {
            echo "<p>Erro ao cancelar a reserva: " . $stmt->error . "</p>";
        }
    } else {
        echo "<p>Reserva não encontrada.</p>";
    }

    // Fechar a declaração
    $stmt->close();
}

// Incluir o rodapé
include 'includes/footer.php';
