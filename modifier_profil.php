<?php
include('inc/fonctions.php');
include('inc/pdo.php');
include('inc/modif_user.php');
$title = 'Modification du profil';


include('inc/header.php');

?>
<!-- Il y a une id class container autour du body  -->
<h2>Modification du profil</h2>

<form class="" action="" method="post">

  <input type="text" name="nom" placeholder="Nom" value="<?php valueofvariable($user,'nom') ?>">
  <span><?php spanError($error, 'nom') ?></span>
  <input type="text" name="prenom" placeholder="Prénom" value="<?php valueofvariable($user,'prenom') ?>">
  <span><?php spanError($error, 'prenom') ?></span>

  <input type="radio" id="homme" name="sexe"
<?php
    if ($user['sexe'] === 'homme') {
      echo 'checked ="checked"';
    }
 ?> value="homme">
  <label for="homme">Homme</label>

  <input type="radio" id="femme" name="sexe" <?php
      if ($user['sexe'] == 'femme') {
        echo 'checked ="checked"';
      }

    ?> value="femme">
  <label for="femme">Femme</label>

  <input type="mail" name="mail" placeholder="Email" value="<?php valueofvariable($user,'mail') ?>">
  <span><?php spanError($error, 'mail') ?></span>

  <input type="date" name="date_naissance" value="<?php valueofvariable($user,'date_naissance') ?>">
  <span><?php spanError($error, 'date_naissance') ?></span>

  <input type="submit" name="submitted" value="Modifier">

</form>




<?php include('inc/footer.php');
