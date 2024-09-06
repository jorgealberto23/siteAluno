<?php include 'includes/header.php'; ?>
<main>
    <h2>Pesquisa de Livros</h2>
    <form action="pesquisa.php" method="get">
        <input type="text" name="titulo" placeholder="Título">
        <input type="text" name="autor" placeholder="Autor">
        <input type="text" name="isbn" placeholder="ISBN">
        <button type="submit">Buscar</button>
    </form>

    <?php
    if (isset($_GET['titulo']) || isset($_GET['autor']) || isset($_GET['isbn'])) {
        // Consultar o banco de dados e exibir resultados
    }
    ?>
</main>
<?php include 'includes/footer.php'; ?>
