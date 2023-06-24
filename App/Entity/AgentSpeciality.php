<?php

namespace App\Entity;

class AgentSpeciality {
    protected ?int $agent_id;
    protected string $speciality_id;

   

    /**
     * Get the value of agent_id
     */ 
    public function getAgent_id()
    {
        return $this->agent_id;
    }

    /**
     * Set the value of agent_id
     *
     * @return  self
     */ 
    public function setAgent_id($agent_id)
    {
        $this->agent_id = $agent_id;

        return $this;
    }

    /**
     * Get the value of speciality_id
     */ 
    public function getSpeciality_id()
    {
        return $this->speciality_id;
    }

    /**
     * Set the value of speciality_id
     *
     * @return  self
     */ 
    public function setSpeciality_id($speciality_id)
    {
        $this->speciality_id = $speciality_id;

        return $this;
    }
}