<?php

namespace App\Repository;

use App\Db\Mysql;
use App\Entity\AgentSpeciality;
use App\Entity\Speciality;
use App\Repository\SpecialityRepository;

class AgentSpecialityRepository {

    public function findSpecialitiesByAgentId(int $agent_id){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT speciality_id FROM agent_speciality WHERE agent_id = :id');
        $query->bindValue(':id', $agent_id, $pdo::PARAM_INT);
        $query->execute();
        $specialitiesId = $query->fetchAll();

        $specialityEntities = [];

        foreach ($specialitiesId as $specialitysId) {
            
            $specialityRepo = new SpecialityRepository;

            $specialityEntity = $specialityRepo->findOneById($specialitysId['speciality_id']);

            $specialityEntities[] = $specialityEntity;
        }

        return $specialityEntities;
    }

    public function create(int $agent_id, int $speciality_id) {

        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
    
        $query = $pdo->prepare('INSERT INTO agent_speciality (agent_id, speciality_id) VALUES (:agent_id, :speciality_id)');
        $query->bindValue(':agent_id', $agent_id, $pdo::PARAM_INT);
        $query->bindValue(':speciality_id', $speciality_id, $pdo::PARAM_INT);
    
        $query->execute();
    }

    function deleteAgentSpecialitiesByAgentId($agentId) {
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('DELETE FROM agent_speciality WHERE agent_id = :id');
        $query->bindValue(':id', $agentId, $pdo::PARAM_INT);
        $query->execute();
    }

    public function update(int $agent_id, int $old_speciality_id, int $new_speciality_id): bool
    {

        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        
        $query = $pdo->prepare('UPDATE agent_speciality SET speciality_id = :new_speciality_id WHERE agent_id = :agent_id AND speciality_id = :old_speciality_id');
        
        $query->bindValue(':agent_id', $agent_id, $pdo::PARAM_INT);
        $query->bindValue(':new_speciality_id', $new_speciality_id, $pdo::PARAM_INT);
        $query->bindValue(':old_speciality_id', $old_speciality_id, $pdo::PARAM_INT);
        
        $result = $query->execute();

        return $result;
    }
}