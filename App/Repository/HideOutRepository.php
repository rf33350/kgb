<?php

namespace App\Repository;

use App\Entity\HideOut;
use App\Db\Mysql;

class HideOutRepository {

    public function findOneById(int $id){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT * FROM hideout WHERE id = :id');
        $query->bindValue(':id', $id, $pdo::PARAM_INT);
        $query->execute();
        $hideout = $query->fetch();

        $hideoutEntity = new HideOut();
        $hideoutEntity->setId($hideout[0]);
        $hideoutEntity->setAddress($hideout[1]);
        $hideoutEntity->setCountry($hideout[2]);
        $hideoutEntity->setCode($hideout[3]);
        return $hideoutEntity;
    }

    public function findAll(){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT * FROM hideout');
        $query->execute();
        $hideouts = $query->fetchAll();

        /*$target = [1, 'Rémi', 'FAURE', '1984-03-04', 1234, 'Française'];*/
        $hideoutEntities = [];

        foreach ($hideouts as $hideout) {
            $hideoutEntity = new HideOut();
            $hideoutEntity->setId($hideout[0]);
            $hideoutEntity->setAddress($hideout[1]);
            $hideoutEntity->setCountry($hideout[2]);
            $hideoutEntity->setCode($hideout[3]);
            
            $hideoutEntities[] = $hideoutEntity;
        }

        return $hideoutEntities;
    }


    public function delete(int $id): bool {

    $mysql = Mysql::getIsntance();
    $pdo = $mysql->getPDO();
    $query = $pdo->prepare('DELETE FROM hideout WHERE id = :id');
    $query->bindValue(':id', $id, \PDO::PARAM_INT);
    $result = $query->execute();
    return $result;

    }

    public function update(HideOut $hideout): bool
    {

        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        
        $query = $pdo->prepare('UPDATE hideout SET address = :address, country = :country, code = :code WHERE id = :id');
        
        $query->bindValue(':id', $hideout->getId(), \PDO::PARAM_INT);
        $query->bindValue(':address', $hideout->getAddress(), \PDO::PARAM_STR);
        $query->bindValue(':country', $hideout->getCountry(), \PDO::PARAM_STR);
        $query->bindValue(':code', $hideout->getCode(), \PDO::PARAM_INT);

        $result = $query->execute();

        return $result;
    }


    public function create(HideOut $hideout) {

    $mysql = Mysql::getIsntance();
    $pdo = $mysql->getPDO();

    $query = $pdo->prepare('INSERT INTO hideout (address, country, code) VALUES (:address, :country, :code)');
    $query->bindValue(':address', $hideout->getAddress());
    $query->bindValue(':country', $hideout->getCountry());
    $query->bindValue(':code', $hideout->getCode());

    $query->execute();
}

}