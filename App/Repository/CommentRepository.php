<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Db\Mysql;
use App\Tools\StringTools;

class CommentRepository extends Repository
{

    public function findOneByArticleId(int $article_id)
    {
        $query = $this->pdo->prepare("SELECT * FROM comment WHERE article_id = :article_id");
        $query->bindParam(':article_id', $article_id, $this->pdo::PARAM_INT);
        $query->execute();
        $comments = $query->fetchAll($this->pdo::FETCH_ASSOC);
        $commentsObjects = [];
        foreach ($comments as $comment) {
            $commentsObjects[] = Comment::createAndHydrate($comment);
        }
        return $commentsObjects;
    }

    public function persist(Comment $comment)
    {

        if ($comment->getId() !== null) {
            $query = $this->pdo->prepare('UPDATE comment SET comment = :comment WHERE id = :id');
            $query->bindValue(':id', $comment->getId(), $this->pdo::PARAM_INT);
        } else {
            $query = $this->pdo->prepare('INSERT INTO comment (comment, user_id, article_id) VALUES (:comment, :user_id, :article_id)');
            $query->bindValue(':user_id', $comment->getUserId(), $this->pdo::PARAM_INT);
            $query->bindValue(':article_id', $comment->getArticleId(), $this->pdo::PARAM_INT);
        }

        $query->bindValue(':comment', $comment->getComment(), $this->pdo::PARAM_STR);

        return $query->execute();
    }
}