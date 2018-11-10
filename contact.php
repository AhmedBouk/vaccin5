<?php
include('inc/fonctions.php');
include('inc/pdo.php');
$title = 'nextpage';
$error = array();

include('inc/header.php');

?>
<!-- Il y a une id class container autour du body  -->

<div class="contact">
  <div class="form">
    <form class="formulaire" action="" method="post">
      <input type="text" name="nom" placeholder="Nom" value="<?php value('nom') ?>" />
      <span><?php spanError($error,'nom') ?></span>

      <input type="text" name="mail" placeholder="Mail" value="<?php value('mail') ?>" />
      <span><?php spanError($error,'mail') ?></span>

      <textarea name="msg" rows="8" cols="80" placeholder="Votre Message"><?php spanError($error,'nom') ?></textarea>

      <input class="button" type="submit" name="submit_register" value="Créer">

    </form>
  </div>
</div>











<?php include('inc/footer.php');
