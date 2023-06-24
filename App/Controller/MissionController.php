<?php

namespace App\Controller;

class MissionController extends Controller {
    public function route() :void {

        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'list':
                        $this->list();
                    break;
                    case 'show':
                        $this->show();
                    break;
                    case 'delete':
                        $this->delete();
                    break;
                    case 'update':
                        $this->update();
                    break;
                    case 'create':
                        $this->create();
                    break;
                    default:
                        throw new \Exception('L\'action '.$_GET['action'].' n\'existe pas');
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

    protected function list() {
        $params = [
            'mission1'=>'Tempete du désert',
            'mission2'=>'Tango Charly',
            'mission3'=>'Fly me',
        ];

        $this->render('/templates/missions/list.php', $params);
    }

    protected function show() {
        $params = [
            'mission'=>'Tango Charly',
        ];

        $this->render('/templates/missions/show.php', $params);
    }

    protected function delete() {
        var_dump('On supprime la mission');
    }

    protected function update() {
        var_dump('On met à jour la mission');
    }

    protected function create() {
        var_dump('On crée la mission');
    }

}