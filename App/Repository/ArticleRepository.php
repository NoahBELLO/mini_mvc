<?php

namespace App\Repository;

use App\Entity\Article;
use App\Db\Mysql;
use App\Tools\StringTools;

class ArticleRepository extends Repository
{

    public function findOneById(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM article WHERE id = :id");
        $query->bindParam(':id', $id, $this->pdo::PARAM_STR);
        $query->execute();
        $article = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($article) {
            return Article::createAndHydrate($article);
        } else {
            return false;
        }
    }
    public function findAll()
    {
        $query = $this->pdo->prepare("SELECT * FROM article");
        $query->execute();
        $articles = $query->fetchAll($this->pdo::FETCH_ASSOC);
        $articlesObjects = [];
        foreach ($articles as $article) {
            $articlesObjects[] = Article::createAndHydrate($article);
        }
        return $articlesObjects;
    }
}