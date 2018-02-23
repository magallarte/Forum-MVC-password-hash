<div class="flex-wrapper vertical justify">
    <h3 class="legend">Fiche conversation <?php echo $idconversation;?></h3>
    <p> Page<?php echo $page. ' sur ' .$nombreDePages;?>  </p>

        <aside class="x2" role="complementary" style="order:1">

        <div>
            <form action="<?php echo DOMAIN.'forum/messages/'.$idconversation.'/'.$page.'/'?>" method="post">
                <label for="tri"> TRIEZ PAR : </label>
                <select name="tri" id="id"> 
                <option  value="datetri" >Date</option>
                <option  value="id" >ID</option>
                <option  value="auteur" >Auteur</option>
                </select>
                <input type="submit">
            </form>
        </div>
        <br>
        <table>
            <thead>
                <tr>
                <th>Date du message</th>
                <th>Heure du message</th>
                <th>Prénom Nom</th>
                <th>Message</th>
                </tr>   
            </thead>
            <tbody>
                <?php
                    
                        echo $out;
                ?>
            </tbody>
        </table>

        <br>
        <div style=display:"block"; align="center">
            <?php
                if ($page > 1):
                ?>
                <a href="<?php echo DOMAIN.'forum/messages/'.$idconversation.'/'.($page - 1).'/'.$tri.'/'; ?>">Page précédente</a>
                <?php
                endif;
                for ($i = 1; $i <= $nombreDePages; $i++):
                ?>
                <a href="<?php echo DOMAIN.'forum/messages/'.$idconversation.'/'.$i.'/'.$tri.'/'; ?>"><?php echo $i; ?></a>

                <?php
                endfor;
                if ($page < $nombreDePages):
                ?>
                <a href="<?php echo DOMAIN.'forum/messages/'.$idconversation.'/'.($page + 1).'/'.$tri.'/'; ?>">Page suivante</a>
                <?php
                endif;
                ?>
        </div>
        </aside>
    </div>
