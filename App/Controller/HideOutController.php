<?php

namespace App\Controller;

use App\Entity\HideOut;
use App\Repository\HideOutRepository;

class HideOutController extends Controller {
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
        $hideoutRepository = new HideOutRepository;
        $hideouts = $hideoutRepository->findAll();

        $params = [
            'planques' => $hideouts
        ];

        $this->render('/templates/hideout/list.php', $params);
    }

    protected function show() {
        try {
            if(isset($_GET['id'])) {

                $id = (int)$_GET['id'];
                
                $hideoutRepository = new HideOutRepository();
                $hideout = $hideoutRepository->findOneById($id);

                $params = [
                    'planque'=>$hideout,
                ];
        
                $this->render('/templates/hideout/show.php', $params);

            } else {
                throw new \Exception('id introuvable');
            }
        } catch (\Exception $e) {
            $this->render('/templates/error.php', [
                'error'=> $e->getMessage(),
            ]);
        }
    }

    protected function delete() {
        try {
            if(isset($_GET['id'])) {

                $id = (int)$_GET['id'];
                
                $hideoutRepository = new HideOutRepository();
                $hideoutRepository->delete($id);
                $this->list();

            } else {
                throw new \Exception('id introuvable');
            }
        } catch (\Exception $e) {
            $this->render('/templates/error.php', [
                'error'=> $e->getMessage(),
            ]);
        }
    }

    protected function update()
    {
        try {
            if (isset($_GET['id'])) {
                $id = (int)$_GET['id'];
                
                $hideoutRepository = new HideOutRepository();
                $hideout = $hideoutRepository->findOneById($id); // Récupère la cible

                if (!$hideout) {
                    throw new \Exception('Cible introuvable');
                }

                if (isset($_POST['hideoutId'])) {
                    // Met à jour les propriétés de la cible avec les valeurs du formulaire
                    $hideout->setAddress($_POST['address']);
                    $hideout->setCountry($_POST['country']);
                    $hideout->setCode((int)$_POST['code']);
                
                    $hideoutRepository->update($hideout); // Met à jour la cible avec les nouvelles valeurs

                    $this->list();
                    return;
                }

                $params = [
                    'planque' => $hideout,
                ];

                $this->render('/templates/hideout/update.php', $params);
            } else {
                throw new \Exception('ID introuvable');
            }
        } catch (\Exception $e) {
            $this->render('/templates/error.php', [
                'error' => $e->getMessage(),
            ]);
        }
    }


    protected function create() {
        
        try {
            if (isset($_POST['createHideout'])) {
                
                $hideout = new HideOut;

                // Met à jour les propriétés de la cible avec les valeurs du formulaire
                $hideout->setAddress($_POST['address']);
                $hideout->setCountry($_POST['country']);
                $hideout->setCode((int)$_POST['code']);
                
                $hideoutRepository = new HideOutRepository();
                $hideoutRepository->create($hideout);
                
                return $this->list();

            } else {
                $this->render('/templates/hideout/create.php');
            }
        } catch (\Exception $e) {
            $this->render('/templates/error.php', [
                'error' => $e->getMessage(),
            ]);
        }
    }

}