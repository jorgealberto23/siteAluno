<?php include 'includes/header.php'; ?>
<main>
    <?php
    include 'includes/db.php';
    
    // Obter ID do livro via GET
    $livro_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    
    // Consultar detalhes do livro
    $sql = "SELECT * FROM livros WHERE id = $livro_id";
    $result = $conn->query($sql);
    $livro = $result->fetch_assoc();
    
    if ($livro):
    ?>
        <h2>Detalhes do Livro</h2>
        <p><strong>Título:</strong> <?php echo htmlspecialchars($livro['titulo']); ?></p>
        <p><strong>Autor:</strong> <?php echo htmlspecialchars($livro['autor']); ?></p>
        <p><strong>ISBN:</strong> <?php echo htmlspecialchars($livro['isbn']); ?></p>
        <p><strong>Descrição:</strong> <?php echo htmlspecialchars($livro['descricao']); ?></p>
        
        <form action="reserva.php" method="post">
            <input type="hidden" name="livro_id" value="<?php echo $livro['id']; ?>">
            <button type="submit">Reservar</button>
        </form>
        <button onclick="adicionarListaDesejos(<?php echo $livro['id']; ?>)">Adicionar à Lista de Desejos</button>
    <?php else: ?>
        <p>Livro não encontrado.</p>
    <?php endif; ?>
</main>
<?php include 'includes/footer.php'; ?>
