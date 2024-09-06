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
    // Recuperar e validar o ID do livro
    $livro_id = intval($_POST['livro_id']);
    $data_reserva = date('Y-m-d'); // Data atual
    $usuario_id = $_SESSION['usuario_id'];

    if ($livro_id <= 0) {
        echo "<p>ID do livro inválido.</p>";
        exit();
    }

    // Verificar se o livro está disponível usando prepared statements
    $stmt = $conn->prepare("SELECT * FROM livros WHERE id = ? AND disponivel = 1");
    $stmt->bind_param('i', $livro_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Reservar o livro usando prepared statements
        $stmt = $conn->prepare("INSERT INTO reservas (livro_id, usuario_id, data_reserva, status) VALUES (?, ?, ?, 'Ativa')");
        $stmt->bind_param('iis', $livro_id, $usuario_id, $data_reserva);

        if ($stmt->execute()) {
            // Atualizar status do livro usando prepared statements
            $stmt = $conn->prepare("UPDATE livros SET disponivel = 0 WHERE id = ?");
            $stmt->bind_param('i', $livro_id);
            $stmt->execute();

            echo "<p>Reserva realizada com sucesso.</p>";
        } else {
            echo "<p>Erro ao reservar o livro: " . $stmt->error . "</p>";
        }

        // Fechar a declaração
        $stmt->close();
    } else {
        echo "<p>O livro não está disponível.</p>";
    }
}

// Incluir o rodapé
include 'includes/footer.php';
