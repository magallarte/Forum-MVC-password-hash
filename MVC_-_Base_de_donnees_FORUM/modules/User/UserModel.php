<?php
/**
 * This file is part of the framework
 *
 * The PostModel class
 *
 * @package POST
 * @copyright ©2018 tous droits réservés
 * @author Damien TIVELET
 */
class UserModel extends KernelModel {
    /**
     * --------------------------------------------------
     * CONSTANTS
     * --------------------------------------------------
     */
    const ALL = '-1';
    const TYPE = 'user';

    /**
     * --------------------------------------------------
     * METHODS
     * --------------------------------------------------
     */
    /**
     * get Performs a database query to select all or a specific post
     * @param  integer|null     $id     The id of a post
     * @return array                    The result of the query
     */
    public function get( $login = null ) {
        if( !empty( $login ) ) :
            $query = 'SELECT * FROM `user` WHERE `u_login`=:login';

            return $this->query(
                $query,
                array(
                    'login'    => array(
                        'VAL'   => $login,
                        'TYPE'  => PDO::PARAM_INT
                    )
                )
            );

        else:
            $query = 'SELECT * FROM `user`';

            return $this->query(
                $query,
                array(),
                array(
                    self::ATTR_RETURNMODE   => self::RETURNMODE_FETCHALL
                )
            );
        endif;
    }

    /**
     * add Performs a database query to insert a post
     * @param  array            $post   The datas to insert
     * @param  string           $author The author of the post
     * @return integer|boolean          The last insert id if is numeric and with auto increment, boolean if not
     */
    public function add( $login,$pwd, $prenom, $nom, $datenaissance ) {
        $query = 'INSERT INTO `user` (`u_login`,`u_pwd`, `u_prenom`, `u_nom`, `u_date_naissance`, `u_date_inscription`, `u_rang_fk` ) VALUES (:login,:pwd,:prenom,:nom, :datenaissance, NOW(),"3")';
            return $this->query(
                $query,
                array(
                    'login'    => array(
                        'VAL'   => $login,
                        'TYPE'  => PDO::PARAM_INT
                    ),
                    'pwd'    => array(
                        'VAL'   => $pwd,
                        'TYPE'  => PDO::PARAM_INT
                    ),
                    'prenom'    => array(
                        'VAL'   => $prenom,
                        'TYPE'  => PDO::PARAM_INT
                    ),
                    'nom'    => array(
                        'VAL'   => $nom,
                        'TYPE'  => PDO::PARAM_INT
                    ),
                    'datenaissance'    => array(
                        'VAL'   => $datenaissance,
                        'TYPE'  => PDO::PARAM_INT
                    )
                )
            );
        
    }

    /**
     * update Performs a database query to update a post
     * @param  array            $post   The datas to insert
     * @param  string           $author The author of the update
     * @return integer|boolean          The last insert id if is numeric and with auto increment, boolean if not
     */
    public function update( $post, $author ) {}

    /**
     * delete Performs a database query to delete a post
     * @param  integer          $post   The datas to insert
     * @param  string           $author The author of the removal
     * @return integer|boolean          The last insert id if is numeric and with auto increment, boolean if not
     */
    public function delete( $post, $author ) {}
}
