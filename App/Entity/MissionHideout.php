<?php

namespace App\Entity;

class MissionHideout {
    protected ?int $mission_id;
    protected ?int $hideout_id;


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
     * Get the value of hideout_id
     */ 
    public function getHideout_id()
    {
        return $this->hideout_id;
    }

    /**
     * Set the value of hideout_id
     *
     * @return  self
     */ 
    public function setHideout_id($hideout_id)
    {
        $this->hideout_id = $hideout_id;

        return $this;
    }
}