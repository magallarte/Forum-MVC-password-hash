<?php

class ClassConversation
{
    private $id;
    private $dateconv;
    private $heure;
    private $termine;
    private $nbmessages;

    // private static $conversations=$array();

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
        if(ctype_digit($id))
        {
        $this->id = $id;
        }
        return $this;
    }

    /**
     * Get the value of dateconv
     */ 
    public function getDateconv()
    {
        return $this->dateconv;
    }

    /**
     * Set the value of dateconv
     *
     * @return  self
     */ 
    public function setDateconv($dateconv)
    {
        $this->dateconv = $dateconv;

        return $this;
    }

    /**
     * Get the value of termine
     */ 
    public function getTermine()
    {
        return $this->termine;
    }

    /**
     * Set the value of termine
     *
     * @return  self
     */ 
    public function setTermine($termine)
    {
        $this->termine = $termine;

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

    /**
     * Get the value of nbmessages
     */ 
    public function getNbmessages()
    {
        return $this->nbmessages;
    }

    /**
     * Set the value of nbmessages
     *
     * @return  self
     */ 
    public function setNbmessages($nbmessages)
    {
        $this->nbmessages = $nbmessages;

        return $this;
    }

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

    public function __construct( $settings )
    {
        $this->hydrate( $settings ); // On hydrate l'instance
        // self::conversations[]=$this;
    }

    // public function ShowAll()
    //  {
    //     if( isset(self::conversations) && is_array(self::conversations) && count(self::conversations)>0) 
    //     {
    //     echo '<table>
    //         <thead>
    //             <tr>
    //             <th>ID de la conversation</th>
    //             <th>Date de la conversation</th>
    //             <th>Heure de la conversation</th>
    //             <th>Nombre de messages</th>
    //             <th>Lien Page Conversation</th>
    //             </tr>   
    //         </thead>
    //         <tbody>';
    //                 foreach( self::conversations as $conversation )
    //                 {
    //                     echo '<tr class="'.($conversation->getTermine()==1?'red':'green').'">
    //                     <td>'.$conversation->getId().'</td>
    //                     <td>'.$conversation->getDateconv().'</td>
    //                     <td>'.$conversation->getHeure().'</td>
    //                     <td>'.($conversation->getNbmessages()==0?'Cette conversation est vide pour le moment':$conversation->getNbmessages()).'</td>
    //                     <td class="link"><a href="page_affichage_message.php?idconversation='.$conversation->getId().'">Page conversation'.$conversation->getId().'</a></td>
    //                     </tr>';
    //                 }
    //           echo '
    //         </tbody>
    //     </table>';
    //     }
    // }


}