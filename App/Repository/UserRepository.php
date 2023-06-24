<?php

namespace App\Repository;

use App\Entity\User;
use App\Db\Mysql;

class UserRepository {

    public function findOneByEmail(string $email){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT * FROM user WHERE email = :email');
        $query->bindValue(':email', $email, $pdo::PARAM_STR);
        $query->execute();
        $user = $query->fetch();

        /*$target = [1, 'Rémi', 'FAURE', '1984-03-04', 1234, 'Française'];*/

        $creationDate = new \DateTime($user[6]);

        $userEntity = new User();
        $userEntity->setId($user[0]);
        $userEntity->setFirstName($user[1]);
        $userEntity->setLastName($user[2]);
        $userEntity->setEmail($user[3]);
        $userEntity->setPassword($user[4]);
        $userEntity->setRole($user[5]);
        $userEntity->setCreationDate($creationDate);
        
        return $userEntity;
    }

    

}