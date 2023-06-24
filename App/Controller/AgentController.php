<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Repository\AgentRepository;
use App\Repository\AgentSpecialityRepository;
use App\Repository\SpecialityRepository;

class AgentController extends Controller {
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
        $agentRepository = new AgentRepository;
        $agents = $agentRepository->findAll();

        $params = [
            'agents' => $agents
        ];

        $this->render('/templates/agent/list.php', $params);
    }

    protected function show() {
        try {
            if(isset($_GET['id'])) {

                $id = (int)$_GET['id'];
                
                $agentRepository = new AgentRepository;
                $agent = $agentRepository->findOneById($id);

                $params = [
                    'agent'=>$agent,
                ];
        
                $this->render('/templates/agent/show.php', $params);

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
                
                $agentSpecialityRepository = new AgentSpecialityRepository;
                $agentSpecialityRepository->deleteAgentSpecialitiesByAgentId($id);

                $agentRepository = new AgentRepository;
                $agentRepository->delete($id);
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
                
                $agentRepository = new AgentRepository();
                $agent = $agentRepository->findOneById($id); // Récupère la cible

                if (!$agent) {
                    throw new \Exception('Cible introuvable');
                }

                if (isset($_POST['agentId'])) {

                    $agentModified = new Agent;

                    // Met à jour les propriétés de la cible avec les valeurs du formulaire
                    $agentModified->setId($id);
                    $agentModified->setFirstName($_POST['firstName']);
                    $agentModified->setLastName($_POST['lastName']);
                    $agentModified->setBirthDate(new \DateTime($_POST['birthDate']));
                    $agentModified->setCode((int)$_POST['code']);
                    $agentModified->setNationality($_POST['nationality']);
                    
                    $agentRepository->update($agentModified);
                    
                    $selectedSpecialities = $_POST['specialities'];

                    if(!is_null($selectedSpecialities)) {

                        $agentSpecialityRepo = new AgentSpecialityRepository();
                        $agentSpecialities = $agentSpecialityRepo->findSpecialitiesByAgentId($id);

                        foreach ($agentSpecialities as $key => $agentSpeciality) {

                            $new_speciality_id = intval($selectedSpecialities[$key]);

                            if ($selectedSpecialities[$key] !== "") {
                                $agentSpecialityRepo = new AgentSpecialityRepository;
                                $agentSpecialityRepo->update($id, $agentSpeciality->getId(), $new_speciality_id);
                            }
                        }
                    
                    }
                    $this->list();
                }

                $specialityRepo = new SpecialityRepository;
                $specialities = $specialityRepo->findAll();

                $agentSpecialityRepo = new AgentSpecialityRepository;
                $agentSpecialities = $agentSpecialityRepo->findSpecialitiesByAgentId($id);


                $params = [
                    'agent' => $agent,
                    'specialities' => $specialities,
                    'agentSpecialities' => $agentSpecialities,
                ];

                $this->render('/templates/agent/update.php', $params);

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
            if (isset($_POST['createAgent'])) {
                
                $agent = new Agent;

                // Met à jour les propriétés de la cible avec les valeurs du formulaire
                $agent->setFirstName($_POST['firstName']);
                $agent->setLastName($_POST['lastName']);
                $agent->setBirthDate(new \DateTime($_POST['birthDate']));
                $agent->setCode((int)$_POST['code']);
                $agent->setNationality($_POST['nationality']);
                
                $agentRepository = new AgentRepository;
                $agentRepository->create($agent);
                
                $createdAgent = new Agent;
                $createdAgent = $agentRepository->findOneByCode($_POST['code']);
                $createdAgentId = $createdAgent->getId();

                $selectedSpecialities = $_POST['specialities'];
                var_dump($selectedSpecialities);
                if(!is_null($selectedSpecialities)) {

                    foreach ($selectedSpecialities as $selectedSpeciality) {
                        $agentSpecialityRepo = new AgentSpecialityRepository;
                        $agentSpecialityRepo->create($createdAgentId, $selectedSpeciality);
                    }
                    
                }
                
                return $this->list();

            } else {

                $specialityRepo = new SpecialityRepository;
                $specialities = $specialityRepo->findAll();

                $params = [
                    'specialities' => $specialities,
                ];
                
                $this->render('/templates/agent/create.php', $params);
            }
        } catch (\Exception $e) {
            $this->render('/templates/error.php', [
                'error' => $e->getMessage(),
            ]);
        }
    }
}