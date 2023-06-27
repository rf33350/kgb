<?php

namespace App\Repository;

use App\Db\Mysql;


class MissionTargetRepository {

    public function findTargetsByMissionId(int $mission_id){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT target_id FROM mission_target WHERE mission_id = :mission_id');
        $query->bindValue(':mission_id', $mission_id, $pdo::PARAM_INT);
        $query->execute();
        $targetsId = $query->fetchAll();

        $targetEntities = [];

        foreach ($targetsId as $targetId) {
            
            $targetRepo = new TargetRepository();

            $targetEntity = $targetRepo->findOneById($targetId['target_id']);

            $targetEntities[] = $targetEntity;
        }

        return $targetEntities;
    }

    public function findMissionByTargetId(int $target_id){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT mission_id FROM mission_target WHERE target_id = :target_id');
        $query->bindValue(':target_id', $target_id, $pdo::PARAM_INT);
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

    public function create(int $mission_id, int $target_id) {

        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
    
        $query = $pdo->prepare('INSERT INTO mission_target (mission_id, target_id) VALUES (:mission_id, :target_id)');
        $query->bindValue(':mission_id', $mission_id, $pdo::PARAM_INT);
        $query->bindValue(':target_id', $target_id, $pdo::PARAM_INT);
    
        $query->execute();
    }

    function deleteByMissionId($missionId) {
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('DELETE FROM mission_target WHERE mission_id = :mission_id');
        $query->bindValue(':mission_id', $missionId, $pdo::PARAM_INT);
        $query->execute();
    }

    function deleteByTargetId($target_id) {
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('DELETE FROM mission_target WHERE target_id = :target_id');
        $query->bindValue(':target_id', $target_id, $pdo::PARAM_INT);
        $query->execute();
    }

    public function update(int $mission_id, int $old_target_id, int $new_target_id): bool
    {

        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        
        $query = $pdo->prepare('UPDATE mission_target SET target_id = :new_target_id WHERE mission_id = :mission_id AND target_id = :old_target_id');
        
        $query->bindValue(':mission_id', $mission_id, $pdo::PARAM_INT);
        $query->bindValue(':new_target_id', $new_target_id, $pdo::PARAM_INT);
        $query->bindValue(':old_target_id', $old_target_id, $pdo::PARAM_INT);
        
        $result = $query->execute();

        return $result;
    }
}