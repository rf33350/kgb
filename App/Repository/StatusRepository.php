<?php

namespace App\Repository;

use App\Entity\Status;
use App\Db\Mysql;

class StatusRepository {

    public function findOneById(int $id){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT * FROM status WHERE id = :id');
        $query->bindValue(':id', $id, $pdo::PARAM_INT);
        $query->execute();
        $status = $query->fetch();

        $statusEntity = new Status();
        $statusEntity->setId($status[0]);
        $statusEntity->setTitle($status[1]);

        return $statusEntity;
    }

    public function findOneByTitle(string $title){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT * FROM status WHERE title = :title');
        $query->bindValue(':title', $title, $pdo::PARAM_STR);
        $query->execute();
        $status = $query->fetch();

        $statusEntity = new Status();
        $statusEntity->setId($status[0]);
        $statusEntity->setTitle($status[1]);

        return $statusEntity;
    }

    public function findAll(){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT * FROM status');
        $query->execute();
        $statuses = $query->fetchAll();

        $statusEntities = [];
        foreach ($statuses as $status) {
            
            $statusEntity = new Status;
            $statusEntity->setId($status[0]);
            $statusEntity->setTitle($status[1]);
            
            $statusEntities[] = $statusEntity;
        }

        return $statusEntities;
    }
}