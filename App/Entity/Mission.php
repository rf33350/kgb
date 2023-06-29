<?php

namespace App\Entity;

class Mission {
    protected ?int $id = null;
    protected string $title;
    protected string $description;
    protected string $codeName;
    protected string $country;
    protected \DateTime $startDate;
    protected ? \DateTime $endDate = null;
    protected int $type_id;
    protected int $status_id;
    protected int $speciality_id;



    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of codeName
     */ 
    public function getCodeName()
    {
        return $this->codeName;
    }

    /**
     * Set the value of codeName
     *
     * @return  self
     */ 
    public function setCodeName($codeName)
    {
        $this->codeName = $codeName;

        return $this;
    }

    /**
     * Get the value of country
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */ 
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the value of startDate
     */ 
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set the value of startDate
     *
     * @return  self
     */ 
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get the value of endDate
     */ 
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set the value of endDate
     *
     * @return  self
     */ 
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get the value of type_id
     */ 
    public function getType_id()
    {
        return $this->type_id;
    }

    /**
     * Set the value of type_id
     *
     * @return  self
     */ 
    public function setType_id($type_id)
    {
        $this->type_id = $type_id;

        return $this;
    }

    /**
     * Get the value of status_id
     */ 
    public function getStatus_id()
    {
        return $this->status_id;
    }

    /**
     * Set the value of status_id
     *
     * @return  self
     */ 
    public function setStatus_id($status_id)
    {
        $this->status_id = $status_id;

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