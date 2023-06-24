<?php

namespace App\Repository;

use App\Entity\Target;
use App\Db\Mysql;

class TargetRepository {

    public function findOneById(int $id){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT * FROM target WHERE id = :id');
        $query->bindValue(':id', $id, $pdo::PARAM_INT);
        $query->execute();
        $target = $query->fetch();

        /*$target = [1, 'Rémi', 'FAURE', '1984-03-04', 1234, 'Française'];*/

        $birthDate = new \DateTime($target[3]);

        $targetEntity = new Target();
        $targetEntity->setId($target[0]);
        $targetEntity->setFirstName($target[1]);
        $targetEntity->setLastName($target[2]);
        $targetEntity->setBirthDate($birthDate);
        $targetEntity->setCode($target[4]);
        $targetEntity->setNationality($target[5]);
        return $targetEntity;
    }

    public function findAll(){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT * FROM target');
        $query->execute();
        $targets = $query->fetchAll();

        /*$target = [1, 'Rémi', 'FAURE', '1984-03-04', 1234, 'Française'];*/
        $targetEntities = [];

        foreach ($targets as $target) {
            $birthDate = new \DateTime($target[3]);
            $targetEntity = new Target();
            $targetEntity->setId($target[0]);
            $targetEntity->setFirstName($target[1]);
            $targetEntity->setLastName($target[2]);
            $targetEntity->setBirthDate($birthDate);
            $targetEntity->setCode($target[4]);
            $targetEntity->setNationality($target[5]);
            
            $targetEntities[] = $targetEntity;
        }

        return $targetEntities;
    }


    public function delete(int $id): bool {

    $mysql = Mysql::getIsntance();
    $pdo = $mysql->getPDO();
    $query = $pdo->prepare('DELETE FROM target WHERE id = :id');
    $query->bindValue(':id', $id, \PDO::PARAM_INT);
    $result = $query->execute();
    return $result;

    }

    public function update(Target $target): bool
    {

        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        
        $query = $pdo->prepare('UPDATE target SET firstName = :firstName, lastName = :lastName, birthDate = :birthDate, code = :code, nationality = :nationality WHERE id = :id');
        
        $query->bindValue(':id', $target->getId(), \PDO::PARAM_INT);
        $query->bindValue(':firstName', $target->getFirstName(), \PDO::PARAM_STR);
        $query->bindValue(':lastName', $target->getLastName(), \PDO::PARAM_STR);
        $query->bindValue(':birthDate', $target->getBirthDate()->format('Y-m-d'), \PDO::PARAM_STR);
        $query->bindValue(':code', $target->getCode(), \PDO::PARAM_INT);
        $query->bindValue(':nationality', $target->getNationality(), \PDO::PARAM_STR);
        
        $result = $query->execute();

        return $result;
    }


    public function create(Target $target) {

    $mysql = Mysql::getIsntance();
    $pdo = $mysql->getPDO();

    $query = $pdo->prepare('INSERT INTO target (firstName, lastName, birthDate, code, nationality) VALUES (:firstName, :lastName, :birthDate, :code, :nationality)');
    $query->bindValue(':firstName', $target->getFirstName());
    $query->bindValue(':lastName', $target->getLastName());
    $query->bindValue(':birthDate', $target->getBirthDate()->format('Y-m-d'));
    $query->bindValue(':code', $target->getCode());
    $query->bindValue(':nationality', $target->getNationality());

    $query->execute();
}

}