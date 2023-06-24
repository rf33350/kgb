<?php

namespace App\Repository;

use App\Entity\Speciality;
use App\Db\Mysql;

class SpecialityRepository {

    public function findOneById(int $id){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT * FROM speciality WHERE id = :id');
        $query->bindValue(':id', $id, $pdo::PARAM_INT);
        $query->execute();
        $speciality = $query->fetch();

        $specialityEntity = new Speciality;
        $specialityEntity->setId($speciality[0]);
        $specialityEntity->setTitle($speciality[1]);

        return $specialityEntity;
    }

    public function findOneByName(string $title){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT * FROM speciality WHERE title = :title');
        $query->bindValue(':title', $title, $pdo::PARAM_STR);
        $query->execute();
        $speciality = $query->fetch();

        $specialityEntity = new Speciality;
        $specialityEntity->setId($speciality[0]);
        $specialityEntity->setTitle($speciality[1]);

        return $specialityEntity;
    }

    public function findAll(){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT * FROM speciality');
        $query->execute();
        $specialities = $query->fetchAll();

        $specialityEntities = [];
        foreach ($specialities as $speciality) {
            
            $specialityEntity = new Speciality();
            $specialityEntity->setId($speciality[0]);
            $specialityEntity->setTitle($speciality[1]);
            
            $specialityEntities[] = $specialityEntity;
        }

        return $specialityEntities;
    }
}