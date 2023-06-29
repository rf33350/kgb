<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Repository\AgentRepository;
use App\Repository\ContactRepository;
use App\Repository\HideOutRepository;
use App\Repository\MissionAgentRepository;
use App\Repository\MissionContactRepository;
use App\Repository\MissionHideoutRepository;
use App\Repository\MissionRepository;
use App\Repository\MissionTargetRepository;
use App\Repository\SpecialityRepository;
use App\Repository\StatusRepository;
use App\Repository\TargetRepository;
use App\Repository\TypeRepository;

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

                $typeId =  $mission->getType_id();
                $typeRepo = new TypeRepository();
                $type = $typeRepo->findOneById($typeId);     
                
                $statusId =  $mission->getStatus_id();
                $statusRepo = new StatusRepository();
                $status = $statusRepo->findOneById($statusId); 

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
                    'type' => $type,
                    'status' => $status,
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
        try {
            if(isset($_GET['id'])) {

                $id = (int)$_GET['id'];
                
                $missionAgentRepository = new MissionAgentRepository();
                $missionAgentRepository->deleteByMissionId($id);

                $missionContactRepository = new MissionContactRepository();
                $missionContactRepository->deleteByMissionId($id);

                $missionTargetRepository = new MissionTargetRepository();
                $missionTargetRepository->deleteByMissionId($id);

                $missionHideoutRepository = new MissionHideoutRepository();
                $missionHideoutRepository->deleteByMissionId($id);

                $missionRepository = new MissionRepository();
                $missionRepository->delete($id);
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

    protected function update() {
        var_dump('On met à jour la mission');
    }

    protected function create() {
        try {
            if (isset($_POST['createMission'])) {
                
                $mission = new Mission();

                $mission->setTitle($_POST['title']);
                $mission->setDescription($_POST['description']);
                $mission->setCodeName($_POST['codeName']);
                $mission->setCountry($_POST['country']);
                $mission->setStartDate(new \DateTime($_POST['startDate']));
                
                if ($_POST['endDate']){
                    $mission->setEndDate(new \DateTime($_POST['endDate']));
                }

                $mission->setType_id($_POST['type']);
                $mission->setStatus_id($_POST['status']);
                $mission->setSpeciality_id($_POST['speciality']);
                
                $missionRepository = new MissionRepository();
                $missionRepository->create($mission);
                
                $createdMission = new Mission();
                $createdMission = $missionRepository->findOneByTitle($_POST['title']);
                $createdMissionId = $createdMission->getId();

                $selectedAgents = $_POST['agents'];
                $selectedContacts = $_POST['contacts'];
                $selectedTargets = $_POST['targets'];
                $selectedHideouts = $_POST['hideouts'];

                if(!is_null($selectedAgents)) {

                    foreach ($selectedAgents as $selectedAgent) {
                        $mission_agentRepo = new MissionAgentRepository();
                        $mission_agentRepo->create($createdMissionId, $selectedAgent);
                    }
                    
                }

                if(!is_null($selectedContacts)) {

                    foreach ($selectedContacts as $selectedContact) {
                        $mission_contactRepo = new MissionContactRepository();
                        $mission_contactRepo->create($createdMissionId, $selectedContact);
                    }
                    
                }

                if(!is_null($selectedTargets)) {

                    foreach ($selectedTargets as $selectedTarget) {
                        $mission_targetRepo = new MissionTargetRepository();
                        $mission_targetRepo->create($createdMissionId, $selectedTarget);
                    }
                    
                }

                if(!is_null($selectedHideouts)) {

                    foreach ($selectedHideouts as $selectedHideout) {
                        $mission_hideoutRepo = new MissionHideoutRepository();
                        $mission_hideoutRepo->create($createdMissionId, $selectedHideout);
                    }
                    
                }
                
                return $this->list();

            } else {

                $typeRepo = new TypeRepository();
                $types = $typeRepo->findAll();

                $statusRepo = new StatusRepository();
                $statuses = $statusRepo->findAll();

                $specialityRepo = new SpecialityRepository();
                $specialities = $specialityRepo->findAll();

                $agentRepo = new AgentRepository();
                $agents = $agentRepo->findAll();

                $contactRepo = new ContactRepository();
                $contacts = $contactRepo->findAll();

                $targetRepo = new TargetRepository();
                $targets = $targetRepo->findAll();

                $hideoutRepo = new HideOutRepository();
                $hideouts = $hideoutRepo->findAll();

                $params = [
                    'specialities' => $specialities,
                    'types' => $types,
                    'statuses' => $statuses,
                    'agents' => $agents,
                    'contacts' => $contacts,
                    'targets' => $targets,
                    'hideouts' => $hideouts,
                ];
                
                $this->render('/templates/missions/create.php', $params);
            }
        } catch (\Exception $e) {
            $this->render('/templates/error.php', [
                'error' => $e->getMessage(),
            ]);
        }
    
    }

}