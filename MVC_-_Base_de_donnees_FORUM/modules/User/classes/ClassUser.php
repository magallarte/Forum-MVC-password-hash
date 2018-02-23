<?php

class ClassUser
{
    private $id;
    private $login;
    private $pwd;
    private $prenom;
    private $nom;
    private $datenaissance;
    private $dateinscription;
    private $rang;



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
     * Get the value of login
     */ 
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of login
     *
     * @return  self
     */ 
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of prenom
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of datenaissance
     */ 
    public function getDatenaissance()
    {
        return $this->datenaissance;
    }

    /**
     * Set the value of datenaissance
     *
     * @return  self
     */ 
    public function setDatenaissance($datenaissance)
    {
        $this->datenaissance = $datenaissance;

        return $this;
    }

    /**
     * Get the value of dateinscription
     */ 
    public function getDateinscription()
    {
        return $this->dateinscription;
    }

    /**
     * Set the value of dateinscription
     *
     * @return  self
     */ 
    public function setDateinscription($dateinscription)
    {
        $this->dateinscription = $dateinscription;

        return $this;
    }

    /**
     * Get the value of rang
     */ 
    public function getRang()
    {
        return $this->rang;
    }

    /**
     * Set the value of rang
     *
     * @return  self
     */ 
    public function setRang($rang)
    {
        $this->rang = $rang;

        return $this;
    }

    public function hydrate($settings)
    {
        if(!is_null ($settings))
        {
            foreach ($settings as $property => $value)
             {
                $property = str_replace( 'u_', '', $property );
                $property = str_replace( '_fk', '', $property );
                $property = str_replace( '_', '', $property );
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
     * Get the value of pwd
     */ 
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * Set the value of pwd
     *
     * @return  self
     */ 
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }
}