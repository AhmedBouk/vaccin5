<?php
include('inc/pdo.php');
include('inc/fonctions.php');
$title = 'MDP oublié';
$body = '';

$error = array();

if(!empty($_POST['submitted'])) {

  $mail = clean('mail');


  if(!empty($mail)) {
    if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $error['mail'] = 'Ceci n\'est pas une adresse mail.';
    } else {
      $sql="SELECT mail, token FROM v5_users WHERE mail = :mail"; //requete à modifier
      $query= $pdo -> prepare($sql) ;//preparer la requete
      $query-> bindValue(':mail' , $mail , PDO::PARAM_STR );
      $query-> execute(); //execute la requete
      $user = $query -> fetch();

      if (!empty($user)) {
        $body = '<p>Veuillez cliquer sur ce lien</p>';
        $body .= '<a href="mdpOublieNew.php?mail='.urlencode($user['mail']) .'&token='.  urlencode($user['token']).'">ici</a>';

      }else {
        $error['mail'] = 'Mail non existant';
      }
    }
  } else {
    $error['mail'] = 'Veuillez renseigner ce champs';
  }
}





include('inc/header.php');


?>
<!-- Il y a une div class container autour du body  -->


<form  action="" method="post">
  <label for="mail">Votre email</label>
  <input type="text" name="mail" value="<?php value('mail') ?>">
  <span><?php spanError($error,'mail') ?></span>
  <input type="submit" name="submitted" value="Modifier le mot de passe">
</form>




<?php
echo $body;
 include('inc/footer.php'); ?>
