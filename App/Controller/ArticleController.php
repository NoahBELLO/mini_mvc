<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use App\Entity\Comment;

class ArticleController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'list':
                        $this->list();
                        break;
                    case 'show':
                        if (isset($_GET['id'])) {
                            $this->showId($_GET['id']);
                        } else {
                            throw new \Exception("Aucun id détecté");
                        }
                        break;
                    case 'comment':
                        $this->comment();
                        break;
                    default:
                        throw new \Exception("Cette action n'existe pas : " . $_GET['action']);
                        break;
                }
            } else {
                throw new \Exception("Aucune action détectée");
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function list()
    {
        try {
            $articleRepository = new ArticleRepository();
            $articles = $articleRepository->findAll();

            $this->render('article/list', [
                'articles' => $articles,
                'pageTitle' => 'Liste d\'articles',
                'errors' => ''
            ]);

        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }

    }

    protected function showId(int $id)
    {
        try {
            $articleRepository = new ArticleRepository();
            $article = $articleRepository->findOneById($id);

            $commentRepository = new CommentRepository();
            $comments = $commentRepository->findOneByArticleId($id);

            $this->render('article/show', [
                'article' => $article,
                'comments' => $comments,
                'pageTitle' => 'Détail article',
                'errors' => ''
            ]);

        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }

    }

    protected function comment()
    {
        $errors = [];

        if (isset($_POST['comment'])) {
            $commentRepository = new CommentRepository();

            $comment = new Comment();
            $comment->setComment($_POST['comment']);
            $comment->setUserId($_POST['user_id']);
            $comment->setArticleId($_POST['article_id']);

            $commentPost = $commentRepository->persist($comment);

            if ($commentPost) {
                header('location: index.php?controller=article&action=show&id=' . $comment->getArticleId());
            } else {
                $errors[] = 'Problème lors de l\'ajout du commentaire.';
            }
        }

        $this->render('article/comment', [
            'errors' => $errors,
        ]);

    }
}
