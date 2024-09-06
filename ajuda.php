<?php include 'includes/header.php'; ?>
<main>
    <h2>Central de Ajuda e Suporte</h2>
    <section>
        <h3>FAQ</h3>
        <p>Aqui você encontrará as perguntas mais frequentes.</p>
        <!-- Adicione FAQ aqui -->
    </section>
    <section>
        <h3>Formulário de Contato</h3>
        <form action="enviar_suporte.php" method="post">
            <p><strong>Nome:</strong> <input type="text" name="nome" required></p>
            <p><strong>E-mail:</strong> <input type="email" name="email" required></p>
            <p><strong>Mensagem:</strong></p>
            <textarea name="mensagem" rows="5" required></textarea>
            <button type="submit">Enviar</button>
        </form>
    </section>
</main>
<?php include 'includes/footer.php'; ?>
