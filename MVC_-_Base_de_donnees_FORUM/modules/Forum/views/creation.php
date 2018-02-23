<div class="flex-wrapper vertical justify">
    <h3 class="legend">Création d'un message</h3>

        <aside class="x2" role="complementary" style="order:1">
            <br>


    <form action="<?php echo DOMAIN.'forum/creation/'?>" method="post">
        <div>
        <label for="idconversation"> Choix de la conversation : </label>
        <select type="text" name="idconversation" id="idconversation">
        <?php
                    echo $out;
        ?>
        </div>
        <label for="contenu"> Message : </label>
        <textarea name="contenu" id="contenu" cols="100px" rows="20px"></textarea>
        
        <input type="submit">
    </form>

<br>
<?php echo (isset($message)? $message:'');?>

        </aside>
    </div>