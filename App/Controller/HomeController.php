<?php

namespace App\Controller;

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

        $params = [
            'test'=>'abc',
            'test2'=>'def',
            'test3'=>'ghi',
        ];

        $this->render('/templates/pages/home.php', $params);
    }

}