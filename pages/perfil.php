<?php
// Incluindo arquivos necessários
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/db.php';

// Iniciar a sessão se ainda não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar se o usuário está autenticado
if (!isset($_SESSION['usuario_id'])) {
    echo "<p>Você deve estar logado para acessar esta página.</p>";
    include __DIR__ . '/../includes/footer.php';
    exit();
}

// Obter o ID do usuário da sessão
$usuario_id = $_SESSION['usuario_id'];

// Consultar os dados do perfil do usuário
$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
} else {
    echo "<p>Usuário não encontrado.</p>";
    include __DIR__ . '/../includes/footer.php';
    exit();
}

// Fechar a declaração
$stmt->close();
?>

<main>
    <h2>Perfil do Usuário</h2>
    <form action="perfil_atualizar.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>

        <button type="submit">Atualizar Perfil</button>
    </form>

    <h3>Alterar Senha</h3>
    <form action="alterar_senha.php" method="post">
        <label for="nova_senha">Nova Senha:</label>
        <input type="password" id="nova_senha" name="nova_senha" required>

        <button type="submit">Alterar Senha</button>
    </form>
</main>

<?php
// Incluir o rodapé
include __DIR__ . '/../includes/footer.php';
?>