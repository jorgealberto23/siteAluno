<?php include 'includes/header.php'; ?>
<main>
    <h2>Notificações</h2>
    <form action="configurar_notificacoes.php" method="post">
        <label>
            <input type="checkbox" name="devolucao_alertas" checked>
            Alertas sobre Devolução
        </label>
        <br>
        <label>
            <input type="checkbox" name="novas_reservas" checked>
            Novas Reservas
        </label>
        <br>
        <button type="submit">Salvar Preferências</button>
    </form>
</main>
<?php include 'includes/footer.php'; ?>
