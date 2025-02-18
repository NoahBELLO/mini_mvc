<?php

namespace App\Entity;


class Comment extends Entity
{
    protected ?int $id = null;
    protected ?string $comment = '';
    protected ?int $user_id = null;
    protected ?int $article_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(?int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getArticleId(): ?int
    {
        return $this->article_id;
    }

    public function setArticleId(?int $article_id): self
    {
        $this->article_id = $article_id;

        return $this;
    }

    /*
        Pourrait être déplacé dans une classe ArticleValidator
    */
    public function validate(): array
    {
        $errors = [];
        if (empty($this->getComment())) {
            $errors['comment'] = 'Le champ commentaire ne doit pas être vide';
        }
        return $errors;
    }
}
