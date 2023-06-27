<?php

namespace App\Controller;

use App\Repository\MissionRepository;

class HomeController extends Controller {
    public function route() :void {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'home':
                    $this->home();
                break;
                default:
                    //
                break;
            }
        } else {
            //charger la page d'accueil
            $this->home();
        }
    }

    protected function home() {

        $missionRepository = new MissionRepository();
        $missions = $missionRepository->findAll();
        
        $params = [
            'missions' => $missions,
        ];

        $this->render('/templates/pages/home.php', $params);
    }

}