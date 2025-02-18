<?php require_once _TEMPLATEPATH_ . '/header.php';
use App\Entity\User;
?>


<h1>Ajouter un commentaire</h1>

<?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $error; ?>
    </div>
<?php } ?>

<form method="POST">
    <div class="mb-3">
        <label for="comment" class="form-label">Commentaire</label>
        <textarea name="comment" id="comment" class="form-control" row="3"></textarea>
    </div>

    <div class="mb-3" hidden>
        <label for="user_id" class="form-label">UserID</label>
        <input type="text" class="form-control" id="user_id" name="user_id" value="<?= User::getCurrentUserId() ?>">
    </div>

    <div class="mb-3" hidden>
        <label for="article_id" class="form-label">ArticleID</label>
        <?php if (isset($_GET["id"])): ?>
            <input type="text" class="form-control" id="article_id" name="article_id" value="<?= $_GET["id"] ?>">
        <?php endif; ?>
    </div>

    <input type="submit" name="commentaire" class="btn btn-primary" value="Ajouter">

</form>

<?php require_once _TEMPLATEPATH_ . '/footer.php'; ?>