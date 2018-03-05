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
class ForumController extends KernelController {
    /**
     * --------------------------------------------------
     * CONSTANTS
     * --------------------------------------------------
     */
    const PAGE_ID = 'forum';
    const PAGE_TITLE = 'Forum';

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

    /**
     * showAction Displays the conversations list view
     * @param  PDO|null     $db     The database object
     * @return void
     */
    public function showAction( PDO $db = null ) {
        $this->init(  __FILE__, __FUNCTION__, $db ); // Adds third paramater for database usage
        
        $datas=$this->getModel()->get();
        foreach ($datas as $key=>$value)
            {
            $conversation= new ClassConversation ($value);

            $out= ( isset( $out ) ? $out : '' ) . '<tr class="'.($conversation->getTermine()==1?'red':'green').'">
                        <td>'.$conversation->getId().'</td>
                        <td>'.$conversation->getDateconv().'</td>
                        <td>'.$conversation->getHeure().'</td>
                        <td>'.$conversation->getNbmessages().'</td>
                        <td><a href="'.DOMAIN.'forum/messages/'.$conversation->getId().'/">Page conversation  '.$conversation->getId().'</a></td>
                        </tr>';
            }
            
        $this->setProperty( 'out', $out );
        $this->render( true );
        
    }

    /**
     * MessagesAction Displays the messages list view of one conversation
     * @param  PDO|null     $db     The database object
     * @return void
     */
    public function messagesAction( PDO $db = null) {
        $this->init(  __FILE__, __FUNCTION__, $db ); // Adds third paramater for database usage

        $pas=NavigationManagement::walks(DOMAIN);
        
        
        if(count($pas)==3)
        {
        $idconversation=$pas[count($pas)-1];
        }
        elseif(count($pas)==4)
        {
        $idconversation=$pas[count($pas)-2];
        $idpage=$pas[count($pas)-1];
        $idtri='datetri';
        }
        else
        {
        $idconversation=$pas[count($pas)-3];
        $idpage=$pas[count($pas)-2];
        $idtri=$pas[count($pas)-1];
        }
        
    
        // tester si num de page saisie manuellement 
        $page = (isset( $idpage) ?  $idpage : 1);
        
        $limit = 20;
        $datas=$this->getModel()->get($idconversation);
        $conversation= new ClassConversation ($datas);
        $nombreDePages = ceil($conversation->getNbmessages()/$limit);
                
        $debut=($page-1)*$limit;
        
        if (isset ($idconversation) && $conversation->getNbmessages()==0)
            {
                echo 'Cette conversation est vide pour le moment !';
            }
            else
            {
                if(!in_array($idconversation, $this->getModel()->SelectAllIds() ))
                {
                    NavigationManagement::redirect( DOMAIN . 'error/404/');
                }
                    else
                    {
                    
                    if (isset ($this->getRequest()->post()['tri']) && isset ($idtri))
                        {
                        $tri=$this->getRequest()->post()['tri'];
                        }
                        else if (!isset ($this->getRequest()->post()['tri']) && isset ($idtri))
                        {
                        $tri=$idtri;
                        }
                        else
                        {
                            $tri="datetri";
                        }
                    
                    
                        $datas=$this->getModel()->SelectMessageDetails($idconversation, $limit, $debut, $tri);
                    
                        foreach ($datas as $key=>$value)
                        {
                        $messagedetail= new ClassMessage ($value);

                        $out= ( isset( $out ) ? $out : '' ) . '<tr>
                                    <td>'.$messagedetail->getDatemess().'</td>
                                    <td>'.$messagedetail->getHeure().'</td>
                                    <td>'.$messagedetail->getAuteur().'</td>
                                    <td>'.$messagedetail->getContenu().'</td>
                                    </tr>';
                        }
                        
                        $this->setProperty( 'page', $page );
                        $this->setProperty( 'idconversation', $idconversation );
                        $this->setProperty( 'tri', $tri );
                        $this->setProperty( 'nombreDePages', $nombreDePages );
                        $this->setProperty( 'idconversation', $idconversation );
                        $this->setProperty( 'out', $out );
                        $this->render( true );
                    
                    }
            }

     } 

     /**
     * CreationAction
     * @param  PDO|null     $db     The database object
     * @return void
     */
    public function creationAction( PDO $db = null ) {
        $this->init( __FILE__, __FUNCTION__, $db ); // Adds third paramater for database usage

        $ids=$this->getModel()-> SelectAllIds();
                    
        foreach ($ids as $key=>$id)
        {
        $out= ( isset( $out ) ? $out : '' ) . '<option value="'.$id.'">'.$id.'</option>';
        }
               
        if(($this->getRequest()->post('idconversation')!==null) && ($this->getRequest()->post('contenu')!==null))
        {
        $newMessage= $this->getModel()->CreateMessage($this->getRequest()->post('contenu'), $this->getRequest()->session('id'), $this->getRequest()->post('idconversation'));
        $message='Votre message a bien été rajouté à la conversation '.$this->getRequest()->post()['idconversation'].'!';
        }
                
        $this->setProperty( 'out', $out );
        $this->setProperty( 'message', $message );
        $this->render( true );
    
    }
}
