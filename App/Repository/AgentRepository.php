<?php

namespace App\Repository;

use App\Entity\Agent;
use App\Db\Mysql;

class AgentRepository {

    public function findOneById(int $id){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT * FROM agent WHERE id = :id');
        $query->bindValue(':id', $id, $pdo::PARAM_INT);
        $query->execute();
        $agent = $query->fetch();

        $agentSpecialityRepo = new AgentSpecialityRepository;
        $specialities = $agentSpecialityRepo->findSpecialitiesByAgentId($id);

        $birthDate = new \DateTime($agent[3]);

        $agentEntity = new Agent();
        $agentEntity->setId($agent[0]);
        $agentEntity->setFirstName($agent[1]);
        $agentEntity->setLastName($agent[2]);
        $agentEntity->setBirthDate($birthDate);
        $agentEntity->setCode($agent[4]);
        $agentEntity->setNationality($agent[5]);
        $agentEntity->setSpecialities($specialities);

        return $agentEntity;
    }

    public function findOneByCode(int $code){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT * FROM agent WHERE code = :code');
        $query->bindValue(':code', $code, $pdo::PARAM_INT);
        $query->execute();
        $agent = $query->fetch();

        $birthDate = new \DateTime($agent[3]);

        $agentEntity = new Agent();
        $agentEntity->setId($agent[0]);
        $agentEntity->setFirstName($agent[1]);
        $agentEntity->setLastName($agent[2]);
        $agentEntity->setBirthDate($birthDate);
        $agentEntity->setCode($agent[4]);
        $agentEntity->setNationality($agent[5]);

        $agentSpecialityRepo = new AgentSpecialityRepository;
        $specialities = $agentSpecialityRepo->findSpecialitiesByAgentId($agent[0]);

        $agentEntity->setSpecialities($specialities);

        return $agentEntity;
    }

    public function findAll(){
        
        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        $query = $pdo->prepare('SELECT * FROM agent');
        $query->execute();
        $agents = $query->fetchAll();

        $agentEntities = [];

        foreach ($agents as $agent) {

            $agentId = $agent[0];
            $agentSpecialityRepo = new AgentSpecialityRepository;
            $specialities = $agentSpecialityRepo->findSpecialitiesByAgentId($agentId);

            $birthDate = new \DateTime($agent[3]);
            $agentEntity = new Agent();
            $agentEntity->setId($agent[0]);
            $agentEntity->setFirstName($agent[1]);
            $agentEntity->setLastName($agent[2]);
            $agentEntity->setBirthDate($birthDate);
            $agentEntity->setCode($agent[4]);
            $agentEntity->setNationality($agent[5]);
            $agentEntity->setSpecialities($specialities);
            
            $agentEntities[] = $agentEntity;
        }

        return $agentEntities;
    }


    public function delete(int $id): bool {

    $mysql = Mysql::getIsntance();
    $pdo = $mysql->getPDO();
    $query = $pdo->prepare('DELETE FROM agent WHERE id = :id');
    $query->bindValue(':id', $id, \PDO::PARAM_INT);
    $result = $query->execute();
    return $result;

    }

    public function update(Agent $agent): bool
    {

        $mysql = Mysql::getIsntance();
        $pdo = $mysql->getPDO();
        
        $query = $pdo->prepare('UPDATE agent SET firstName = :firstName, lastName = :lastName, birthDate = :birthDate, code = :code, nationality = :nationality WHERE id = :id');
        
        $query->bindValue(':id', $agent->getId(), \PDO::PARAM_INT);
        $query->bindValue(':firstName', $agent->getFirstName(), \PDO::PARAM_STR);
        $query->bindValue(':lastName', $agent->getLastName(), \PDO::PARAM_STR);
        $query->bindValue(':birthDate', $agent->getBirthDate()->format('Y-m-d'), \PDO::PARAM_STR);
        $query->bindValue(':code', $agent->getCode(), \PDO::PARAM_INT);
        $query->bindValue(':nationality', $agent->getNationality(), \PDO::PARAM_STR);
        
        $result = $query->execute();

        return $result;
    }


    public function create(Agent $agent) {

    $mysql = Mysql::getIsntance();
    $pdo = $mysql->getPDO();

    $query = $pdo->prepare('INSERT INTO agent (firstName, lastName, birthDate, code, nationality) VALUES (:firstName, :lastName, :birthDate, :code, :nationality)');
    $query->bindValue(':firstName', $agent->getFirstName());
    $query->bindValue(':lastName', $agent->getLastName());
    $query->bindValue(':birthDate', $agent->getBirthDate()->format('Y-m-d'));
    $query->bindValue(':code', $agent->getCode());
    $query->bindValue(':nationality', $agent->getNationality());

    $query->execute();
}

}