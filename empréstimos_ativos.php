<?php
session_start();
include 'includes/header.php';
include 'includes/db.php'; // Inclua o arquivo de conexão com o banco de dados

// Verifique se o ID do usuário está definido na sessão
if (!isset($_SESSION['usuario_id'])) {
    echo "<p>Você precisa estar logado para ver esta página.</p>";
    include 'includes/footer.php';
    exit;
}

// Obtenha o ID do usuário da sessão
$usuario_id = intval($_SESSION['usuario_id']); // Garanta que o ID é um número inteiro

// Consultar empréstimos ativos
$sql = "SELECT emprestimos.id, livros.titulo, emprestimos.data_emprestimo, emprestimos.data_devolucao
        FROM emprestimos
        JOIN livros ON emprestimos.livro_id = livros.id
        WHERE emprestimos.usuario_id = $usuario_id AND emprestimos.devolvido = 0";
$result = $conn->query($sql);
?>

<main>
    <h2>Empréstimos Ativos</h2>

    <?php if ($result && $result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Data de Empréstimo</th>
                    <th>Data de Devolução</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                        <td><?php echo htmlspecialchars($row['data_emprestimo']); ?></td>
                        <td><?php echo htmlspecialchars($row['data_devolucao']); ?></td>
                        <td>
                            <form action="devolucao.php" method="post">
                                <input type="hidden" name="emprestimo_id" value="<?php echo $row['id']; ?>">
                                <button type="submit">Devolver</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Você não tem empréstimos ativos.</p>
    <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>
