<?php
/**
 * This file is part of the framework
 *
 * The DefaultModel class
 *
 * @package {__PACKAGE_NAME__}
 * @copyright {__PACKAGE_LICENSE__}
 * @author {__PACKAGE_AUTHOR__}
 */
class ForumModel extends KernelModel {
    /**
     * --------------------------------------------------
     * METHODS
     * --------------------------------------------------
     */
    /**
     * default
     * @return mixed    The result of the query
     */
    /**
     public function SelectAllConversations() {
        $query = '';

        return $this->query(
            $query,
            array(
                ''   => array(
                    'VAL'   => '',
                    'TYPE'  => PDO::PARAM_INT
                )
            )
        );
    }
    */

  /**
     * get Performs a database query to select all or a specific post
     * @param  integer|null     $id     The id of a post
     * @return array                    The result of the query
     */
    public function get( $id = null ) {
        if( !empty( $id ) ) :
            $query = 'SELECT `c_id` AS id, DATE_FORMAT(`c_date`,"%d/%m/%Y") AS dateconv, DATE_FORMAT(`c_date`, "%T") AS heure,`c_termine` AS termine, COUNT(`m_id`) AS nbmessages FROM `conversation` LEFT JOIN `message` ON `c_id`=`m_conversation_fk` WHERE `c_id`=:id';

            return $this->query(
                $query,
                array(
                    'id'    => array(
                        'VAL'   => $id,
                        'TYPE'  => PDO::PARAM_INT
                    )
                )
            );

        else:
            $query = 'SELECT `c_id`AS id, DATE_FORMAT(`c_date`, "%d/%m/%Y") AS dateconv, DATE_FORMAT(`c_date`, "%T") AS heure,`c_termine`AS termine, COUNT(`m_id`) AS nbmessages FROM `conversation` LEFT JOIN `message` ON `c_id`=`m_conversation_fk` GROUP BY `c_id`';

            return $this->query(
                $query,
                array(),
                array(
                    self::ATTR_RETURNMODE   => self::RETURNMODE_FETCHALL
                )
            );
        endif;
    }

    public function SelectAllIds()
    {
            $query = 'SELECT `c_id` AS id FROM `conversation`';
            $results=$this->query(
                $query,
                array(),
                array(
                    self::ATTR_RETURNMODE   => self::RETURNMODE_FETCHALL
                )
            );
            foreach($results as $result)
            { 
                $ids[]=$result['id'];
            }
            return $ids;
    }

   public function SelectMessageDetails($idconversation, $limit, $debut,$tri)
     {
            $query = 'SELECT `m_id` AS id, DATE_FORMAT(`m_date`, "%d/%m/%Y") AS datemess, `m_date` AS datetri,
             DATE_FORMAT(`m_date`, "%T") AS heure, CONCAT(`u_prenom`,"  ", `u_nom`) AS auteur, `m_contenu` AS contenu,
              `m_conversation_fk` AS idconversation
               FROM `message`
               INNER JOIN `user` ON `u_id`= `m_auteur_fk`
               WHERE `m_conversation_fk`=:idconversation ORDER BY '.$tri.' ASC LIMIT '.$debut.','.$limit.'';
            return $this->query(
                $query,
                array(
                'idconversation'   => array(
                    'VAL'   => $idconversation,
                    'TYPE'  => PDO::PARAM_INT
                    )
                )
            );
            
    }

public function CreateMessage($message, $auteur, $conversation)
    {
            $query = 'INSERT INTO `message` (`m_contenu`, `m_date`, `m_auteur_fk`, `m_conversation_fk`) VALUES (:message, NOW(),:auteur, :conversation)';
            return $this->query(
                $query,
                array(
                'message'   => array(
                    'VAL'   => $message,
                    'TYPE'  => PDO::PARAM_STR
                     ),
                'auteur'   => array(
                    'VAL'   => $auteur,
                    'TYPE'  => PDO::PARAM_STR
                    ),
                'conversation'   => array(
                    'VAL'   => $conversation,
                    'TYPE'  => PDO::PARAM_INT
                    )
                
                )
                );
    }

}
