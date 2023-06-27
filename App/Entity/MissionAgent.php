<?php

namespace App\Entity;

class MissionAgent {
    protected ?int $mission_id;
    protected ?int $agent_id;


    /**
     * Get the value of mission_id
     */ 
    public function getMission_id()
    {
        return $this->mission_id;
    }

    /**
     * Set the value of mission_id
     *
     * @return  self
     */ 
    public function setMission_id($mission_id)
    {
        $this->mission_id = $mission_id;

        return $this;
    }

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
}