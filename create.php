<?php
include_once("templates/header.php");
?>

<div class="container">
    <?php
    include_once("templates/backbtn.html");
    ?>
    <h1 id="main-title">
        Criar contato
    </h1>
    <form id="create-form" action="<?= $BASE_URL ?>config/process.php" method="post">
    <input type="hidden" name="type" value="create">
        <div class="form-group">
            <label for="name">Nome do contato:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Digite seu nome" required>
        </div>
        <div class="form-group">
            <label for="email">Email do contato:</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Digite seu email" required>
        </div>
        <div class="form-group">
            <label for="observations">Observações do contato:</label>
            <textarea type="text" class="form-control" id="observations" name="observations" placeholder="Insira suas observações" rows="3">
            </textarea>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>
<?php
include_once("templates/footer.php");
?>