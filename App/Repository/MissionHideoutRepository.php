<?php

namespace App\Repository;

use App\Db\Mysql;


class MissionHideoutRepository {

    public function findHideoutsByMissionId(int $mission_id){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT hideout_id FROM mission_hideout WHERE mission_id = :mission_id');
        $query->bindValue(':mission_id', $mission_id, $pdo::PARAM_INT);
        $query->execute();
        $hideoutsId = $query->fetchAll();

        $hideoutEntities = [];

        foreach ($hideoutsId as $hideoutId) {
            
            $hideoutRepo = new HideoutRepository();

            $hideoutEntity = $hideoutRepo->findOneById($hideoutId['hideout_id']);

            $hideoutEntities[] = $hideoutEntity;
        }

        return $hideoutEntities;
    }

    public function findMissionByHideoutId(int $hideout_id){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT mission_id FROM mission_hideout WHERE hideout_id = :hideout_id');
        $query->bindValue(':hideout_id', $hideout_id, $pdo::PARAM_INT);
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

    public function create(int $mission_id, int $hideout_id) {

        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
    
        $query = $pdo->prepare('INSERT INTO mission_hideout (mission_id, hideout_id) VALUES (:mission_id, :hideout_id)');
        $query->bindValue(':mission_id', $mission_id, $pdo::PARAM_INT);
        $query->bindValue(':hideout_id', $hideout_id, $pdo::PARAM_INT);
    
        $query->execute();
    }

    function deleteByMissionId($missionId) {
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('DELETE FROM mission_hideout WHERE mission_id = :mission_id');
        $query->bindValue(':mission_id', $missionId, $pdo::PARAM_INT);
        $query->execute();
    }

    function deleteByhideoutId($hideout_id) {
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('DELETE FROM mission_hideout WHERE hideout_id = :hideout_id');
        $query->bindValue(':hideout_id', $hideout_id, $pdo::PARAM_INT);
        $query->execute();
    }

    public function update(int $mission_id, int $old_hideout_id, int $new_hideout_id): bool
    {

        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        
        $query = $pdo->prepare('UPDATE mission_hideout SET hideout_id = :new_hideout_id WHERE mission_id = :mission_id AND hideout_id = :old_hideout_id');
        
        $query->bindValue(':mission_id', $mission_id, $pdo::PARAM_INT);
        $query->bindValue(':new_hideout_id', $new_hideout_id, $pdo::PARAM_INT);
        $query->bindValue(':old_hideout_id', $old_hideout_id, $pdo::PARAM_INT);
        
        $result = $query->execute();

        return $result;
    }
}