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

        $this->render('/templates/mission/list.php', $params);
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
        
                $this->render('/templates/mission/show.php', $params);

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
        try {
            if (isset($_GET['id'])) {

                $id = (int)$_GET['id'];
                
                $missionRepository = new MissionRepository();
                $mission = $missionRepository->findOneById($id);
                
                $TypeRepository = new TypeRepository();
                $missiontype = $TypeRepository->findOneById($mission->getType_id());

                $statusRepo = new StatusRepository();
                $missionstatus = $statusRepo->findOneById($mission->getStatus_id());

                $specialityRepo = new SpecialityRepository();
                $missionspeciality = $specialityRepo->findOneById($mission->getSpeciality_id());

                $mission_agentRepo = new MissionAgentRepository();
                $agentsInMission = $mission_agentRepo->findAgentsByMissionId($id);

                $mission_contactRepo = new MissionContactRepository();
                $contactsInMission = $mission_contactRepo->findContactsByMissionId($id);

                $mission_targetRepo = new MissionTargetRepository();
                $targetsInMission = $mission_targetRepo->findTargetsByMissionId($id);

                $mission_hideoutRepo = new MissionHideoutRepository();
                $hideoutsInMission = $mission_hideoutRepo->findHideoutsByMissionId($id);

                if (!$mission) {
                    throw new \Exception('Mission introuvable');
                }

                $types = $TypeRepository->findAll();
                
                $statuses = $statusRepo->findAll();
                
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
                    'mission' => $mission,
                    'missiontype' => $missiontype->getTitle(),
                    'types' => $types,
                    'missionstatus' => $missionstatus->getTitle(),
                    'statuses' => $statuses,
                    'missionspeciality' => $missionspeciality->getTitle(),
                    'specialities' => $specialities,
                    'agentsInMission' => $agentsInMission,
                    'agents' => $agents,
                    'contactsInMission' => $contactsInMission,
                    'contacts' => $contacts,
                    'targetsInMission' => $targetsInMission,
                    'targets' => $targets,
                    'hideoutsInMission' => $hideoutsInMission,
                    'hideouts' => $hideouts,
                ];

                if (isset($_POST['updateMission'])) {

                    if($_POST['title']){
                        $mission->setTitle($_POST['title']);
                    }
                    
                    if($_POST['description']){
                        $mission->setDescription($_POST['description']);
                        
                    }
                    if($_POST['codeName']){
                        $mission->setCodeName($_POST['codeName']);
                        
                    }
                    if($_POST['country']){
                        $mission->setCountry($_POST['country']);
                    }
                    if($_POST['startDate']){
                        $mission->setStartDate(new \DateTime($_POST['startDate']));
                    }
                    if ($_POST['endDate']){
                        $mission->setEndDate(new \DateTime($_POST['endDate']));
                    }
                    if($_POST['type']){
                        $mission->setType_id($_POST['type']);
                    }

                    if($_POST['status']){
                        $mission->setStatus_id($_POST['status']);
                    }
                    
                    if($_POST['speciality']){
                        $mission->setSpeciality_id($_POST['speciality']);
                    }

                    $missionRepository->update($mission);
                    
                    $selectedAgents = $_POST['agents'];
                    $agentsChanged = 0;
                    foreach($selectedAgents as $selectedAgent) {
                        if($selectedAgent !== ""){
                            $agentsChanged += 1;
                        } 
                    }
                    if($agentsChanged !== 0){
                        $mission_agentRepo->deleteByMissionId($id);
                        foreach($selectedAgents as $selectedAgent) {
                            $mission_agentRepo->create($id, intval($selectedAgent));
                        }
                    } 

                    $selectedContacts = $_POST['contacts'];
                    $contactsChanged = 0;
                    foreach($selectedContacts as $selectedContact) {
                        if($selectedContact !== ""){
                            $contactsChanged += 1;
                        } 
                    }
                    if($contactsChanged !== 0){
                        $mission_contactRepo->deleteByMissionId($id);
                        foreach($selectedContacts as $selectedContact) {
                            $mission_contactRepo->create($id, intval($selectedContact));
                        }
                    } 


                    $selectedTargets = $_POST['targets'];
                    $targetsChanged = 0;
                    foreach($selectedTargets as $selectedTarget) {
                        if($selectedTarget !== ""){
                            $targetsChanged += 1;
                        } 
                    }
                    if($targetsChanged !== 0){
                        $mission_targetRepo->deleteByMissionId($id);
                        foreach($selectedTargets as $selectedTarget) {
                            $mission_targetRepo->create($id, intval($selectedTarget));
                        }
                    } 

                    $selectedHideouts = $_POST['hideouts'];
                    $hideoutsChanged = 0;
                    foreach($selectedHideouts as $selectedHideout) {
                        if($selectedHideout !== ""){
                            $hideoutsChanged += 1;
                        } 
                    }
                    if($hideoutsChanged !== 0){
                        $mission_hideoutRepo->deleteByMissionId($id);
                        foreach($selectedHideouts as $selectedHideout) {
                            $mission_hideoutRepo->create($id, intval($selectedHideout));
                        }
                    }
                    
                    $this->list();
                }


                $this->render('/templates/mission/update.php', $params);

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
                
                $this->render('/templates/mission/create.php', $params);
            }
        } catch (\Exception $e) {
            $this->render('/templates/error.php', [
                'error' => $e->getMessage(),
            ]);
        }
    
    }

}