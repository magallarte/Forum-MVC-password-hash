  <div class="flex-wrapper vertical justify">
    <h3 class="legend">Connection</h3>

        <aside class="x2" role="complementary" style="order:1">
            <br>
            <form action="<?php '.DOMAIN./user/connection'?>" method="post">
                <!-- <input type="text" name="u_login" placeholder="Email" value="<?php echo (isset($emailuser)? $emailuser: 'Email');?>">
                <input type="text" name="u_pwd" placeholder="Mot de passe" value="<?php echo ''.(isset($pwduser)? $pwduser: 'Mot de passe').'';?>"> -->
                <input type="text" name="u_login" placeholder="Email">
                <input type="text" name="u_pwd" placeholder="Mot de passe">

                <input type="submit">
            </form>
        
        <?php
        if (isset($erreur))
        { 
            echo $erreur.'
            <h3 class="legend"> Création de votre profil : </h3>
        <div>
            <form action=" '.DOMAIN.'/user/connection" method="post">
                <input type="text" name="u_prenom" placeholder="Prénom">
                <input type="text" name="u_nom" placeholder="Nom">
                <input type="email" name="u_login" placeholder="Email">
                <input type="text" name="u_pwd" placeholder="Mot de passe">
                <input type="date" name="u_date_naissance" placeholder="Date de naissance">
                <input type="submit">
            </form>
        </div>';
        }
        else
            {
                echo $message2;
            }

        ?>
        </aside>
    </div>