<?php

namespace App\Repository;

use App\Entity\Type;
use App\Db\Mysql;

class TypeRepository {

    public function findOneById(int $id){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT * FROM type WHERE id = :id');
        $query->bindValue(':id', $id, $pdo::PARAM_INT);
        $query->execute();
        $type = $query->fetch();

        $typeEntity = new Type();
        $typeEntity->setId($type[0]);
        $typeEntity->setTitle($type[1]);

        return $typeEntity;
    }

    public function findOneByTitle(string $title){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT * FROM type WHERE title = :title');
        $query->bindValue(':title', $title, $pdo::PARAM_STR);
        $query->execute();
        $type = $query->fetch();

        $typeEntity = new Type();
        $typeEntity->setId($type[0]);
        $typeEntity->setTitle($type[1]);

        return $typeEntity;
    }

    public function findAll(){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT * FROM type');
        $query->execute();
        $types = $query->fetchAll();

        $typeEntities = [];
        foreach ($types as $type) {
            
            $typeEntity = new Type();
            $typeEntity->setId($type[0]);
            $typeEntity->setTitle($type[1]);
            
            $typeEntities[] = $typeEntity;
        }

        return $typeEntities;
    }
}