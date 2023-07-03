<?php

namespace App\Repository;

use App\Db\Mysql;


class MissionAgentRepository {

    public function findAgentsByMissionId(int $mission_id){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT agent_id FROM mission_agent WHERE mission_id = :mission_id');
        $query->bindValue(':mission_id', $mission_id, $pdo::PARAM_INT);
        $query->execute();
        $agentsId = $query->fetchAll();
        
        $agentEntities = [];
        foreach ($agentsId as $agentId) {
            
            $agentRepo = new AgentRepository();

            $agentEntity = $agentRepo->findOneById($agentId['agent_id']);

            $agentEntities[] = $agentEntity;
        }

        return $agentEntities;
    }

    public function findMissionByAgentId(int $agent_id){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT mission_id FROM mission_agent WHERE agent_id = :agent_id');
        $query->bindValue(':agent_id', $agent_id, $pdo::PARAM_INT);
        $query->execute();
        $missionsId = $query->fetchAll();

        $missionEntities = [];

        foreach ($missionsId as $missionId) {
            
            $missionRepo = new MissionRepository();

            $missionEntity = $missionRepo->findOneById($missionId);

            $missionEntities[] = $missionEntity;
        }

        return $missionEntities;
    }

    public function create(int $mission_id, int $agent_id) {

        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
    
        $query = $pdo->prepare('INSERT INTO mission_agent (mission_id, agent_id) VALUES (:mission_id, :agent_id)');
        $query->bindValue(':mission_id', $mission_id, $pdo::PARAM_INT);
        $query->bindValue(':agent_id', $agent_id, $pdo::PARAM_INT);
    
        $query->execute();
    }

    function deleteByMissionId($missionId) {
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('DELETE FROM mission_agent WHERE mission_id = :mission_id');
        $query->bindValue(':mission_id', $missionId, $pdo::PARAM_INT);
        $query->execute();
    }

    function deleteByAgentId($agentId) {
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('DELETE FROM mission_agent WHERE agent_id = :agent_id');
        $query->bindValue(':agent_id', $agentId, $pdo::PARAM_INT);
        $query->execute();
    }

    function deleteByMissionIdAgentId($missionId, $agentId) {
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('DELETE FROM mission_agent WHERE mission_id = :mission_id AND agent_id = :agent_id');
        $query->bindValue(':mission_id', $missionId, $pdo::PARAM_INT);
        $query->bindValue(':agent_id', $agentId, $pdo::PARAM_INT);
        $query->execute();
    }

    public function update(int $mission_id, int $old_agent_id, int $new_agent_id): bool
    {

        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        
        $query = $pdo->prepare('UPDATE mission_agent SET agent_id = :new_agent_id WHERE mission_id = :mission_id AND agent_id = :old_agent_id');
        
        $query->bindValue(':mission_id', $mission_id, $pdo::PARAM_INT);
        $query->bindValue(':new_agent_id', $new_agent_id, $pdo::PARAM_INT);
        $query->bindValue(':old_agent_id', $old_agent_id, $pdo::PARAM_INT);
        
        $result = $query->execute();

        return $result;
    }
}