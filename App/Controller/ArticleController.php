<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Entity\Article;


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
                            $this->show($_GET['id']);
                        } else {
                            throw new \Exception("Aucun id détecté");
                        }
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

    protected function show(int $id)
    {
        try {
            $articleRepository = new ArticleRepository();

            $article = $articleRepository->findOneById($id);

            $this->render('article/show', [
                'article' => $article,
                'pageTitle' => 'Détail article',
                'errors' => ''
            ]);

        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }

    }

}
