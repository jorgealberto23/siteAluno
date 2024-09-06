<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Virtual</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Ajuste o caminho se necessário -->
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <h2>Bem-vindo à Biblioteca Virtual</h2>
        <form action="pesquisa.php" method="get" aria-labelledby="search-form">
            <label id="search-form" for="search">Pesquisa rápida de livros:</label>
            <input type="text" id="search" name="search" placeholder="Digite o título, autor ou ISBN" required>
            <button type="submit">Buscar</button>
        </form>

        <nav>
            <ul>
                <li><a href="empréstimos_ativos.php" title="Veja seus empréstimos ativos">Empréstimos Ativos</a></li>
                <li><a href="reservas.php" title="Veja suas reservas">Reservas</a></li>
                <li><a href="perfil.php" title="Veja seu perfil">Perfil</a></li>
                <li><a href="notificacoes.php" title="Veja suas notificações">Notificações</a></li>
            </ul>
        </nav>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
