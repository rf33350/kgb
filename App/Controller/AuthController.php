<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;

class AuthController extends Controller {

    public function route() :void {
          
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'login':
                        $this->login();
                    break;
                    case 'logout':
                        $this->logout();
                    break;
                    default:
                        throw new \Exception('L\'action '.$_GET['action'].' n\'existe pas');
                    break;
                }
            } else {
                //si pas d'argument on charge la page d'accueil
                header("Location: index.php?controller=page&action=home");
            }        
        } catch (\Exception $e) {
            $this->render('/templates/error.php', [
                'error'=> $e->getMessage(),
            ]);
        }       
    }

    protected function login() {

        try {
            if (isset($_POST['loginUser'])) {

                $userRepository = new UserRepository;

                $email = $_POST['email'];
                $password = $_POST['password'];

                $user = new User;
                $user = $userRepository->findOneByEmail($email);

                if (isset($user)) {
                    // Vérifier le mot de passe hashé
                    $hashedPassword = $user->getPassword();

                    if (password_verify($password, $hashedPassword)) {
                        // Authentification réussie
                        session_start();
                        $_SESSION['user'] = $user;
                        
                        /*header("Location: index.php?controller=page&action=home");*/
                        $params = [
                            'test'=>'abc',
                            'test2'=>'def',
                            'test3'=>'ghi',
                        ];
                
                        $this->render('/templates/pages/home.php', $params);
                    } else {
                        // Mot de passe incorrect, afficher un message d'erreur ou effectuer une action appropriée
                        $errors[] = 'Mot de passe ou email incorrect. Veuillez réessayer.';
                        $this->render('/templates/login.php', ['errors' => $errors]);
                    }
                }
            } else {
                $this->render('/templates/login.php');
            }
        } catch (\Exception $e) {
            $this->render('/templates/error.php', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    protected function logout()
{
    session_start();
    session_destroy();

    unset($_SESSION);

    header("Location: index.php?controller=page&action=home");
}



}