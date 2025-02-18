<?php require_once _TEMPLATEPATH_ . '/header.php';
/** @var \App\Entity\Article $article */
?>

<h1><?= $pageTitle; ?></h1>
<h2><?= $article->getTitle(); ?></h2>
<p><?= $article->getDescription(); ?></p>
<a href="index.php?controller=article&action=list" class="btn btn-primary">Retour</a>

<?php require_once _TEMPLATEPATH_ . '/footer.php'; ?>