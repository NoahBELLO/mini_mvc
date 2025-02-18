<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\User;


class UserController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'register':
                        $this->register();
                        break;
                    case 'delete':
                        // Appeler méthode delete()
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

    protected function register()
    {
        $errors = [];

        if (isset($_POST['saveUser'])) {
            $userRepository = new UserRepository();

            $user = new User();
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user->setFirstName($_POST['first_name']);
            $user->setLastName($_POST['last_name']);

            $userPost = $userRepository->persist($user);

            if ($userPost) {
                header('location: index.php');
            } else {
                $errors[] = 'Problème lors de l\'ajout du commentaire.';
            }
        }

        $this->render('user/add_edit', [
            'user' => '',
            'pageTitle' => 'Inscription',
            'errors' => ''
        ]);
    }

}
