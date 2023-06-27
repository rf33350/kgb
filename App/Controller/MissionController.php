<?php

namespace App\Controller;

use App\Repository\MissionAgentRepository;
use App\Repository\MissionContactRepository;
use App\Repository\MissionHideoutRepository;
use App\Repository\MissionRepository;
use App\Repository\MissionTargetRepository;
use App\Repository\SpecialityRepository;

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

        $missionRepository = new MissionRepository();
        $missions = $missionRepository->findAll();
        
        $params = [
            'missions' => $missions,
        ];

        $this->render('/templates/missions/list.php', $params);
    }

    protected function show() {

        try {
            if(isset($_GET['id'])) {
                
                $id = (int)$_GET['id'];
                
                $missionRepository = new MissionRepository();
                $mission = $missionRepository->findOneById($id);

                $specialityId = $mission->getSpeciality_id();
                $specialityRepository = new SpecialityRepository();
                $speciality = $specialityRepository->findOneById($specialityId);

                $missionAgentRepo = new MissionAgentRepository();
                $agents = $missionAgentRepo->findAgentsByMissionId($id);

                $missionContactRepo = new MissionContactRepository();
                $contacts = $missionContactRepo->findContactsByMissionId($id);

                $missionHideoutRepo = new MissionHideoutRepository();
                $hideouts = $missionHideoutRepo->findHideoutsByMissionId($id);

                $missionTargetRepo = new MissionTargetRepository();
                $targets = $missionTargetRepo->findTargetsByMissionId($id);

                $params = [
                    'mission' => $mission,
                    'speciality' => $speciality,
                    'agents' => $agents,
                    'contacts' => $contacts,
                    'hideouts' => $hideouts,
                    'targets' => $targets,
                ];
        
                $this->render('/templates/missions/show.php', $params);

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
        var_dump('On supprime la mission');
    }

    protected function update() {
        var_dump('On met à jour la mission');
    }

    protected function create() {
        var_dump('On crée la mission');
    }

}