<?php

namespace App\Repository;

use App\Entity\Contact;
use App\Db\Mysql;

class ContactRepository {

    public function findOneById(int $id){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT * FROM contact WHERE id = :id');
        $query->bindValue(':id', $id, $pdo::PARAM_INT);
        $query->execute();
        $contact = $query->fetch();

        /*$target = [1, 'Rémi', 'FAURE', '1984-03-04', 1234, 'Française'];*/

        $birthDate = new \DateTime($contact[3]);

        $contactEntity = new Contact();
        $contactEntity->setId($contact[0]);
        $contactEntity->setFirstName($contact[1]);
        $contactEntity->setLastName($contact[2]);
        $contactEntity->setBirthDate($birthDate);
        $contactEntity->setCode($contact[4]);
        $contactEntity->setNationality($contact[5]);
        return $contactEntity;
    }

    public function findAll(){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT * FROM contact');
        $query->execute();
        $contacts = $query->fetchAll();

        /*$target = [1, 'Rémi', 'FAURE', '1984-03-04', 1234, 'Française'];*/
        $contactEntities = [];

        foreach ($contacts as $contact) {
            $birthDate = new \DateTime($contact[3]);
            $contactEntity = new Contact();
            $contactEntity->setId($contact[0]);
            $contactEntity->setFirstName($contact[1]);
            $contactEntity->setLastName($contact[2]);
            $contactEntity->setBirthDate($birthDate);
            $contactEntity->setCode($contact[4]);
            $contactEntity->setNationality($contact[5]);
            
            $contactEntities[] = $contactEntity;
        }

        return $contactEntities;
    }


    public function delete(int $id): bool {

    $mysql = Mysql::getIsntance();
    $pdo = $mysql->getPDO();
    $query = $pdo->prepare('DELETE FROM contact WHERE id = :id');
    $query->bindValue(':id', $id, \PDO::PARAM_INT);
    $result = $query->execute();
    return $result;

    }

    public function update(Contact $contact): bool
    {

        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        
        $query = $pdo->prepare('UPDATE contact SET firstName = :firstName, lastName = :lastName, birthDate = :birthDate, code = :code, nationality = :nationality WHERE id = :id');
        
        $query->bindValue(':id', $contact->getId(), \PDO::PARAM_INT);
        $query->bindValue(':firstName', $contact->getFirstName(), \PDO::PARAM_STR);
        $query->bindValue(':lastName', $contact->getLastName(), \PDO::PARAM_STR);
        $query->bindValue(':birthDate', $contact->getBirthDate()->format('Y-m-d'), \PDO::PARAM_STR);
        $query->bindValue(':code', $contact->getCode(), \PDO::PARAM_INT);
        $query->bindValue(':nationality', $contact->getNationality(), \PDO::PARAM_STR);
        
        $result = $query->execute();

        return $result;
    }


    public function create(Contact $contact) {

    $mysql = Mysql::getIsntance();
    $pdo = $mysql->getPDO();

    $query = $pdo->prepare('INSERT INTO contact (firstName, lastName, birthDate, code, nationality) VALUES (:firstName, :lastName, :birthDate, :code, :nationality)');
    $query->bindValue(':firstName', $contact->getFirstName());
    $query->bindValue(':lastName', $contact->getLastName());
    $query->bindValue(':birthDate', $contact->getBirthDate()->format('Y-m-d'));
    $query->bindValue(':code', $contact->getCode());
    $query->bindValue(':nationality', $contact->getNationality());

    $query->execute();
}

}