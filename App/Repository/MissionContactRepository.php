<?php

namespace App\Repository;

use App\Db\Mysql;


class MissionContactRepository {

    public function findContactsByMissionId(int $mission_id){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT contact_id FROM mission_contact WHERE mission_id = :mission_id');
        $query->bindValue(':mission_id', $mission_id, $pdo::PARAM_INT);
        $query->execute();
        $contactsId = $query->fetchAll();

        $contactEntities = [];

        foreach ($contactsId as $contactId) {
            
            $contactRepo = new ContactRepository();

            $agentEntity = $contactRepo->findOneById($contactId['contact_id']);

            $contactEntities[] = $agentEntity;
        }

        return $contactEntities;
    }

    public function findMissionByContactId(int $contact_id){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT mission_id FROM mission_contact WHERE contact_id = :contact_id');
        $query->bindValue(':contact_id', $contact_id, $pdo::PARAM_INT);
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

    public function create(int $mission_id, int $contact_id) {

        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
    
        $query = $pdo->prepare('INSERT INTO mission_contact (mission_id, contact_id) VALUES (:mission_id, :contact_id)');
        $query->bindValue(':mission_id', $mission_id, $pdo::PARAM_INT);
        $query->bindValue(':contact_id', $contact_id, $pdo::PARAM_INT);
    
        $query->execute();
    }

    function deleteByMissionId($missionId) {
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('DELETE FROM mission_contact WHERE mission_id = :mission_id');
        $query->bindValue(':mission_id', $missionId, $pdo::PARAM_INT);
        $query->execute();
    }

    function deleteByContactId($contact_id) {
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('DELETE FROM mission_contact WHERE contact_id = :contact_id');
        $query->bindValue(':agent_id', $contact_id, $pdo::PARAM_INT);
        $query->execute();
    }

    public function update(int $mission_id, int $old_contact_id, int $new_contact_id): bool
    {

        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        
        $query = $pdo->prepare('UPDATE mission_contact SET contact_id = :new_agent_id WHERE mission_id = :mission_id AND contact_id = :old_contact_id');
        
        $query->bindValue(':mission_id', $mission_id, $pdo::PARAM_INT);
        $query->bindValue(':new_contact_id', $new_contact_id, $pdo::PARAM_INT);
        $query->bindValue(':old_contact_id', $old_contact_id, $pdo::PARAM_INT);
        
        $result = $query->execute();

        return $result;
    }
}