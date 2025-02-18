<?php require_once _TEMPLATEPATH_ . '/header.php';
/** @var \App\Entity\Article $articles */

?>

<h1><?= $pageTitle; ?></h1>

<table>
    <caption>Liste des articles</caption>
    <thead>
        <tr>
            <th scope='col'>Titre</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articles as $row): ?>
            <tr>
                <th scope='row'><?= $row->getTitle() ?></th>                
                <th scope='row'>
                    <a href="index.php?controller=article&action=show&id=<?= $row->getId(); ?>" class="btn btn-primary">Lire plus</a>
                </th>                
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<?php require_once _TEMPLATEPATH_ . '/footer.php'; ?>