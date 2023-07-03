<?php

namespace App\Repository;

use App\Entity\Mission;
use App\Db\Mysql;
use PDO;

class MissionRepository {

    public function findOneById(int $id){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT * FROM mission WHERE id = :id');
        $query->bindValue(':id', $id, $pdo::PARAM_INT);
        $query->execute();
        $mission = $query->fetch();

        $startDate = new \DateTime($mission[5]);
        $endDate = new \DateTime($mission[6]);

        $missionEntity = new Mission();
        $missionEntity->setId($mission[0]);
        $missionEntity->setTitle($mission[1]);
        $missionEntity->setDescription($mission[2]);
        $missionEntity->setCodeName($mission[3]);
        $missionEntity->setCountry($mission[4]);
        $missionEntity->setStartDate($startDate);
        $missionEntity->setEndDate($endDate);
        $missionEntity->setType_id($mission[7]);
        $missionEntity->setStatus_id($mission[8]);
        $missionEntity->setSpeciality_id($mission[9]);

        return $missionEntity;
    }

    public function findOneByTitle(string $title){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT * FROM mission WHERE title = :title');
        $query->bindValue(':title', $title, $pdo::PARAM_STR);
        $query->execute();
        $mission = $query->fetch();

        $startDate = new \DateTime($mission[5]);
        $endDate = new \DateTime($mission[6]);

        $missionEntity = new Mission();
        $missionEntity->setId($mission[0]);
        $missionEntity->setTitle($mission[1]);
        $missionEntity->setDescription($mission[2]);
        $missionEntity->setCodeName($mission[3]);
        $missionEntity->setCountry($mission[4]);
        $missionEntity->setStartDate($startDate);
        $missionEntity->setEndDate($endDate);
        $missionEntity->setType_id($mission[7]);
        $missionEntity->setStatus_id($mission[8]);
        $missionEntity->setSpeciality_id($mission[9]);

        return $missionEntity;
    }

    public function findAll(){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT * FROM mission');
        $query->execute();
        $missions = $query->fetchAll();

        /*$target = [1, 'Rémi', 'FAURE', '1984-03-04', 1234, 'Française'];*/
        $missionEntities = [];

        foreach ($missions as $mission) {

            $startDate = new \DateTime($mission[5]);
            $endDate = new \DateTime($mission[6]);

            $missionEntity = new Mission();
            $missionEntity->setId($mission[0]);
            $missionEntity->setTitle($mission[1]);
            $missionEntity->setDescription($mission[2]);
            $missionEntity->setCodeName($mission[3]);
            $missionEntity->setCountry($mission[4]);
            $missionEntity->setStartDate($startDate);
            $missionEntity->setEndDate($endDate);
            $missionEntity->setType_id($mission[7]);
            $missionEntity->setStatus_id($mission[8]);
            $missionEntity->setSpeciality_id($mission[9]);
            
            $missionEntities[] = $missionEntity;

        }

        return $missionEntities;
    }


    public function delete(int $id): bool {

    $mysql = Mysql::getIsntance();
    $pdo = $mysql->getPDO();
    $query = $pdo->prepare('DELETE FROM mission WHERE id = :id');
    $query->bindValue(':id', $id, \PDO::PARAM_INT);
    $result = $query->execute();
    return $result;

    }

    public function update(Mission $mission): bool
    {

        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('UPDATE mission SET title = :title, description = :description, codeName = :codeName , country = :country, startDate = :startDate, endDate = :endDate, type_id = :type_id, status_id = :status_id, speciality_id = :speciality_id WHERE id = :id');
        
        $query->bindValue(':id', $mission->getId(), $pdo::PARAM_INT);
        $query->bindValue(':title', $mission->getTitle(), $pdo::PARAM_STR);
        $query->bindValue(':description', $mission->getDescription(), $pdo::PARAM_STR);
        $query->bindValue(':codeName', $mission->getCodeName(), $pdo::PARAM_STR);
        $query->bindValue(':country', $mission->getCountry(), $pdo::PARAM_STR);
        $query->bindValue(':startDate', $mission->getStartDate()->format('Y-m-d'));
        if ($mission->getEndDate() == "") {
            $query->bindValue(':endDate', null, PDO::PARAM_NULL);
        } else {
            $query->bindValue(':endDate', $mission->getEndDate()->format('Y-m-d'));
        }
        $query->bindValue(':type_id', $mission->getType_id(), $pdo::PARAM_INT);
        $query->bindValue(':status_id', $mission->getStatus_id(), $pdo::PARAM_INT);
        $query->bindValue(':speciality_id', $mission->getSpeciality_id(), $pdo::PARAM_INT);
        
        
        $result = $query->execute();

        return $result;
    }


    public function create(Mission $mission): bool {

    $mysql = Mysql::getIsntance();
    $pdo = $mysql->getPDO();

    $query = $pdo->prepare('INSERT INTO mission (title, description, codeName, country, startDate, endDate, type_id, status_id, speciality_id) VALUES (:title, :description, :codeName, :country, :startDate, :endDate, :type_id, :status_id, :speciality_id)');
    
    $query->bindValue(':title', $mission->getTitle(), PDO::PARAM_STR);
    $query->bindValue(':description', $mission->getDescription(), PDO::PARAM_STR);
    $query->bindValue(':codeName', $mission->getCodeName(), PDO::PARAM_STR);
    $query->bindValue(':country', $mission->getCountry(), PDO::PARAM_STR);
    $query->bindValue(':startDate', $mission->getStartDate()->format('Y-m-d'));
    if ($mission->getEndDate() == "") {
        $query->bindValue(':endDate', null, PDO::PARAM_NULL);
    } else {
        $query->bindValue(':endDate', $mission->getEndDate()->format('Y-m-d'));
    }
    $query->bindValue(':type_id', $mission->getType_id(), PDO::PARAM_INT);
    $query->bindValue(':status_id', $mission->getStatus_id(), PDO::PARAM_INT);
    $query->bindValue(':speciality_id', $mission->getSpeciality_id(), PDO::PARAM_INT);

    $result = $query->execute();
    return $result;
}

}