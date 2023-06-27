<?php

namespace App\Entity;

class MissionTarget {
    protected ?int $mission_id;
    protected ?int $target_id;


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
     * Get the value of target_id
     */ 
    public function getTarget_id()
    {
        return $this->target_id;
    }

    /**
     * Set the value of target_id
     *
     * @return  self
     */ 
    public function setTarget_id($target_id)
    {
        $this->target_id = $target_id;

        return $this;
    }
}