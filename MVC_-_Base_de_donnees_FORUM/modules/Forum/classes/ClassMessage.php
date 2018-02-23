<?php

class ClassMessage
{
    private $id;
    private $contenu;
    private $datemess;
    private $heure;
    private $auteur;
    private $conversation;


    public function hydrate($settings)
    {
        if(!is_null ($settings))
        {
            foreach ($settings as $property => $value)
             {
               $methodName='set'. ucwords($property);
               if(method_exists($this,$methodName))
                $this->$methodName($value);
            }
        }
    }

    public function __construct( $settings ) {
        $this->hydrate( $settings ); // On hydrate l'instance
    }

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
     * Get the value of contenu
     */ 
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set the value of contenu
     *
     * @return  self
     */ 
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get the value of datemess
     */ 
    public function getDatemess()
    {
        return $this->datemess;
    }

    /**
     * Set the value of datemess
     *
     * @return  self
     */ 
    public function setDatemess($datemess)
    {
        $this->datemess = $datemess;

        return $this;
    }

    /**
     * Get the value of auteur
     */ 
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set the value of auteur
     *
     * @return  self
     */ 
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get the value of conversation
     */ 
    public function getConversation()
    {
        return $this->conversation;
    }

    /**
     * Set the value of conversation
     *
     * @return  self
     */ 
    public function setConversation($conversation)
    {
        $this->conversation = $conversation;

        return $this;
    }

    /**
     * Get the value of heure
     */ 
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * Set the value of heure
     *
     * @return  self
     */ 
    public function setHeure($heure)
    {
        $this->heure = $heure;

        return $this;
    }
}