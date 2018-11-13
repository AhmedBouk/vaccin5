<?php
include('inc/header.php');
include('inc/fonctions.php');
include('inc/pdo.php');
$title = 'Contact';
$error = array();

if (!empty($_POST['submit'])) {

// fonction declarant et nettoyant (expace au debut et à la fin & supprimant les caractère pouvant créer un script) une variable

  $nom      = trim(strip_tags($_POST[$nom]));
  $mail     = trim(strip_tags($_POST[$mail]));
  $objet    = trim(strip_tags($_POST[$objet]));
  $message  = trim(strip_tags($_POST[$message]));

  if(!empty($nom)) {
    if(strlen($nom) < 3 ) {
      $error['nom'] = 'Ce champs est trop court. (minimum 3 caractères)';
    } elseif(strlen($nom) > 20) {
        $error['nom'] = 'Ce champs est trop long. (maximum 20 caractères)';
      }
  } else {
      $error['nom'] = 'Veuillez renseigner ce champs.';
    }

  if(!empty($mail)) {
    if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $error['mail'] = 'Ceci n\'est pas une adresse mail valide.';
    }
  }else {
      $error['mail'] = 'Veuillez renseigner ce champs.';
    }

    if(!empty($objet)) {
      if(strlen($objet) < 3 ) {
        $error['objet'] = 'Ce champs est trop court. (minimum 3 caractères)';
      } elseif(strlen($objet) > 20) {
          $error['objet'] = 'Ce champs est trop long. (maximum 20 caractères)';
        }
    } else {
        $error['objet'] = 'Veuillez renseigner ce champs.';
      }

      if(!empty($message)) {
        if(strlen($message) < 30 ) {
          $error['message'] = 'Votre message est trop court, il faut minimum 30 caractères';
        } elseif(strlen($message) > 500) {
            $error['message'] = 'Votre message est trop long.';
          }
      } else {
          $error['message'] = 'Veuillez renseigner ce champs.';
        }

    $sql = "INSERT INTO v5_contact ('id', 'nom', 'mail', 'objet', 'message', 'created_at') VALUES ('id,:nom,:mail,:objet,:message,now())";

    $query= $pdo -> prepare($sql) ;
    $query-> bindvalue(':nom' , $nom , PDO::PARAM_STR );
    $query-> bindvalue(':mail' , $mail , PDO::PARAM_STR );
    $query-> bindvalue(':objet' , $objet , PDO::PARAM_STR );
    $query-> bindvalue(':message' , $message , PDO::PARAM_STR );
    $query-> execute();
  }

?>
<!-- Il y a une id class container autour du body  -->

<div class="contact">

  <h2>Formulaire de contact</h2>

    <div class="form">
      <form class="formulaire" action="" method="post">
        <input type="text" name="nom" placeholder="Nom" value="<?php value('nom') ?>" />
        <span><?php spanError($error,'nom') ?></span>

        <input type="text" name="mail" placeholder="Mail" value="<?php value('mail') ?>" />
        <span><?php spanError($error,'mail') ?></span>

        <input type="text" name="objet" placeholder="Objet" value="<?php value('objet') ?>" />
        <span><?php spanError($error,'objet') ?></span>

        <textarea name="msg" rows="8" cols="80" placeholder="Votre Message"><?php spanError($error,'nom') ?></textarea>

        <input class="button" type="submit" name="submit" value="Envoyer">

      </form>
    </div>
  </div>











<?php include('inc/footer.php');
