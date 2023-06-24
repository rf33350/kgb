<?php

namespace App\Controller;

Class Controller {
    public function route() :void {

        try {
           if (isset($_GET['controller'])) {
            switch ($_GET['controller']) {
                case 'page':
                    $pageController = new HomeController();
                    $pageController->route();
                break;
                case 'mission':
                    $pageController = new MissionController();
                    $pageController->route();
                break;
                case 'agent':
                    $pageController = new AgentController();
                    $pageController->route();
                break;
                case 'target':
                    $pageController = new TargetController();
                    $pageController->route();
                break;
                case 'contact':
                    $pageController = new ContactController();
                    $pageController->route();
                break;
                case 'hideout':
                    $pageController = new HideOutController();
                    $pageController->route();
                break;
                case 'auth':
                    $pageController = new AuthController();
                    $pageController->route();
                break;
                default:
                    throw new \Exception('Le controleur n\'existe pas');
                break;
            }
        } else {
            //si pas d'argument on charge la page d'accueil
            $pageController = new HomeController();
            $pageController->route();
        }
        } catch (\Exception $e) {
            $this->render('/templates/error.php', [
                'error'=> $e->getMessage(),
            ]);
        }

        

    }

    protected function render(string $path, array $params = []):void {

        $filePath = _ROOTPATH_.$path;

        try {
            if (file_exists($filePath)) {
                extract($params);
                require $filePath;
            }
            else {
                throw new \Exception("Fichier non trouvé: ".$filePath);
            }
        } catch (\Exception $e) {
            $this->render('/templates/error.php', [
                'error'=> $e->getMessage(),
            ]);
        }
    }
 
}