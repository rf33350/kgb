<?php

namespace App\Entity;

class MissionContact {
    protected ?int $mission_id;
    protected ?int $contact_id;


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
     * Get the value of contact_id
     */ 
    public function getContact_id()
    {
        return $this->contact_id;
    }

    /**
     * Set the value of contact_id
     *
     * @return  self
     */ 
    public function setContact_id($contact_id)
    {
        $this->contact_id = $contact_id;

        return $this;
    }
}