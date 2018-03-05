<?php

/**
 * This file is part of the framework
 *
 * The DefaultController class is used to prevent default actions
 *
 * @package {__PACKAGE_NAME__}
 * @copyright {__PACKAGE_LICENSE__}
 * @author {__PACKAGE_AUTHOR__}
 */
class UserController extends KernelController {
    /**
     * --------------------------------------------------
     * CONSTANTS
     * --------------------------------------------------
     */
    const PAGE_ID = 'user';
    const PAGE_TITLE = 'Utilisateur';

    /**
     * --------------------------------------------------
     * ACTIONS
     * --------------------------------------------------
     */
    /**
     * defaultAction
     * @param  PDO|null     $db     The database object
     * @return void
     */
    public function defaultAction( PDO $db = null ) {
        $this->init( __FILE__, __FUNCTION__, $db ); // Adds third paramater for database usage

        $this->setProperty( 'title', self::PAGE_TITLE );
        $this->setProperty( 'ariane', $this->ariane( _( self::PAGE_TITLE ) ) );
        $this->render( true );
    }

     public function SelectPwdAll()
     {
        $usersdetails = $this->getModel()->get();
             
            foreach ($usersdetails as $userdetails)
            {
                $user=new ClassUser($userdetails);
                $userPwdlist[]=$user->getPwd();
            }
            return $userPwdlist;
    }

    public function SelectLoginAll()
     {
       $usersdetails = $this->getModel()->get();
       
            foreach ($usersdetails as $userdetails)
            {
                $user=new ClassUser($userdetails);
                $userLoginlist[]=$user->getLogin();
            }
        return $userLoginlist;
    }

    /**
     * connectionAction checks the login and password
     * @param  PDO|null     $db     The database object
     * @return void
     */
    public function connectionAction( PDO $db = null ) {
        $this->init(  __FILE__, __FUNCTION__, $db ); // Adds third paramater for database usage
        
    
        $userPwdlist=$this->SelectPwdAll();
        $userLoginlist=$this->SelectLoginAll();

        if($this->getRequest()->post('u_login') && $this->getRequest()->post('u_pwd')!==false)
        {
            $this->getRequest()->session('user', $this->getRequest()->post('u_login'));
            $pwduser=$this->getRequest()->post('u_pwd');
            $userdetails=$this->getModel()->get($this->getRequest()->session('user'));
            $user= new ClassUser ($userdetails);
            $this->getRequest()->session('id', $user->getId());
            
            foreach ($userPwdlist as $userPwd) {
                 $check[]=password_verify($pwduser,$userPwd);
            }
            
            if ( (in_array($this->getRequest()->session('user'), $userLoginlist)==true && (in_array('true', $check )==true)))
            {
            $message2= '
            <br>
            <p>Vous êtes bien connecté !</p>
            <br>
            <div> 
            <form action="'.DOMAIN.'/forum/creation" method="POST">
            <input type="submit" value="Créer un message" name="creation">
            </form> 
            </div>
            ';
            }
            else
            {
                $erreur = 'Créez votre profil  !';
                if(($this->getRequest()->post('u_nom') && $this->getRequest()->post('u_prenom') && $this->getRequest()->post('u_login') && $this->getRequest()->post('u_date_naissance'))!==false)
                {
                $this->getModel()->add($this->getRequest()->post('u_login'), password_hash($this->getRequest()->post('u_pwd'), PASSWORD_BCRYPT),$this->getRequest()->post('u_prenom'), $this->getRequest()->post('u_nom'), $this->getRequest()->post('u_date_naissance'));
                $message= 'Votre profil a bien été crée !';
                }
                
            }
        }

        $this->setProperty( 'user',  $this->getRequest()->session('user') );

        $this->setProperty( 'loginuser',  $loginuser );
        $this->setProperty( 'erreur',  $erreur );
        $this->setProperty( 'message',  $message );
        $this->setProperty( 'message2',  $message2 );
        $this->render( true );
        
    }

     /**
     * deconnectionAction unset the session
     
     * @return void
     */
    public function deconnectionAction( PDO $db = null ) {
        $this->init(  __FILE__, __FUNCTION__, $db ); // Adds third paramater for database usage
        
        
        $this->getRequest()->unset(session,'user');
        $this->getRequest()->unset(session,'id');
      
        $message= '
            <br>
            <p>Vous êtes déconnecté ! A bientôt</p>';
           
        $this->setProperty( 'message',  $message );
        $this->render( true );
        
    }
  
}