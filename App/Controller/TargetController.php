<?php

namespace App\Controller;

use App\Entity\Target;
use App\Repository\TargetRepository;

class TargetController extends Controller {
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
        $targetRepository = new TargetRepository();
        $targets = $targetRepository->findAll();

        $params = [
            'cibles' => $targets
        ];

        $this->render('/templates/target/list.php', $params);
    }

    protected function show() {
        try {
            if(isset($_GET['id'])) {

                $id = (int)$_GET['id'];
                
                $targetRepository = new TargetRepository();
                $target = $targetRepository->findOneById($id);

                $params = [
                    'cible'=>$target,
                ];
        
                $this->render('/templates/target/show.php', $params);

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
                
                $targetRepository = new TargetRepository();
                $targetRepository->delete($id);
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
                
                $targetRepository = new TargetRepository();
                $target = $targetRepository->findOneById($id); // Récupère la cible

                if (!$target) {
                    throw new \Exception('Cible introuvable');
                }

                if (isset($_POST['targetId'])) {
                    // Met à jour les propriétés de la cible avec les valeurs du formulaire
                    $target->setFirstName($_POST['firstName']);
                    $target->setLastName($_POST['lastName']);
                    $target->setBirthDate(new \DateTime($_POST['birthDate']));
                    $target->setCode((int)$_POST['code']);
                    $target->setNationality($_POST['nationality']);

                    $targetRepository->update($target); // Met à jour la cible avec les nouvelles valeurs

                    $this->list();
                    return;
                }

                $params = [
                    'cible' => $target,
                ];

                $this->render('/templates/target/update.php', $params);
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
            if (isset($_POST['createTarget'])) {
                
                
                $target = new Target;

                
                // Met à jour les propriétés de la cible avec les valeurs du formulaire
                $target->setFirstName($_POST['firstName']);
                $target->setLastName($_POST['lastName']);
                $target->setBirthDate(new \DateTime($_POST['birthDate']));
                $target->setCode((int)$_POST['code']);
                $target->setNationality($_POST['nationality']);
                
                $targetRepository = new TargetRepository();
                $targetRepository->create($target);
                
                return $this->list();;

            } else {
                $this->render('/templates/target/create.php');
            }
        } catch (\Exception $e) {
            $this->render('/templates/error.php', [
                'error' => $e->getMessage(),
            ]);
        }
    }

}