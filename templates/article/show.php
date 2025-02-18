<?php require_once _TEMPLATEPATH_ . '/header.php';
use App\Entity\User;

/** @var \App\Entity\Article $article */
/** @var \App\Entity\Comment $comments */
?>

<h1><?= $pageTitle; ?></h1>
<h2><?= $article->getTitle(); ?></h2>
<p><?= $article->getDescription(); ?></p>
<!-- comment -->
<?php foreach ($comments as $row): ?>
    <p>Commentaire : <?= $row->getComment(); ?></p>
<?php endforeach; ?>

<?php if (User::isLogged()): ?>
    <a href="index.php?controller=article&action=comment&id=<?= $article->getId(); ?>" class="btn btn-primary">Ajouter un
        commentaire</a>
<?php endif; ?>
<a href="index.php?controller=article&action=list" class="btn btn-primary">Retour</a>

<?php require_once _TEMPLATEPATH_ . '/footer.php'; ?>