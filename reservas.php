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

// Consultar reservas do usuário
$sql = "SELECT reservas.id, livros.titulo, reservas.data_reserva, reservas.data_livro
        FROM reservas
        JOIN livros ON reservas.livro_id = livros.id
        WHERE reservas.usuario_id = $usuario_id";

$result = $conn->query($sql);
?>

<main>
    <h2>Minhas Reservas</h2>

    <?php if ($result && $result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Data da Reserva</th>
                    <th>Data do Livro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                        <td><?php echo htmlspecialchars($row['data_reserva']); ?></td>
                        <td><?php echo htmlspecialchars($row['data_livro']); ?></td>
                        <td>
                            <form action="cancelar_reserva.php" method="post">
                                <input type="hidden" name="reserva_id" value="<?php echo $row['id']; ?>">
                                <button type="submit">Cancelar</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Você não tem reservas.</p>
    <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>
