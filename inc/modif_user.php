<?php
$id = $_SESSION['user']['id'];

$sql = "SELECT *
        FROM v5_users
        WHERE id = :id";
$query = $pdo -> prepare($sql);
$query-> bindvalue(':id' , $id , PDO::PARAM_INT );
$query -> execute();
$user = $query -> fetch();

$error = array();
// Lors de la soumission du formulaire
if (!empty($_POST['submitted'])) {

// fonction declarant et nettoyant (expace au debut et à la fin & supprimant les caractère pouvant créer un script) une variable

  $nom      = clean('nom');
  $prenom   = clean('prenom');
  $mail     = clean('mail');
  $date_naissance = clean('date_naissance');
  $sexe     = clean('sexe');


  if(!empty($nom)) {
    if(strlen($nom) < 3 ) {
      $error['nom'] = 'Ce champs est trop court.(minimum 3 caractères)';
    } elseif(strlen($nom) > 20) {
        $error['nom'] = 'Ce champs est trop long.(maximum 20 caractères)';
      }
  } else {
      $error['nom'] = 'Veuillez renseigner ce champs';
    }
  if(!empty($prenom)) {
    if(strlen($prenom) < 3 ) {
      $error['prenom'] = 'Ce champs est trop court.(minimum 3 caractères)';
    } elseif(strlen($prenom) > 20) {
        $error['prenom'] = 'Ce champs est trop long.(maximum 20 caractères)';
      }
      } else {
          $error['prenom'] = 'Veuillez renseigner ce champs';
        }

  if(!empty($mail)) {
    if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $error['mail'] = 'Ceci n\'est pas une adresse mail.';
    }
  } else {
    $error['mail'] = 'Veuillez renseigner ce champs';
  }

// A verifier ? comment ? checkdate() necessite 3 paramètreds
  // if(!empty($date_naissance)) {
  //   if(!is_numeric($date_naissance)) {
  //     $error['date_naissance'] = 'ceci n\'est pas une date';
  //   }
  // } else {
  //     $error['date_naissance'] = 'Veuillez renseigner ce champs';
  //   }


  if (count($error)==0) {

      $sql = "INSERT INTO `v5_relation`( `user_id`, `vaccin_id`, `created_at`, `updated_at`) VALUES ()";
      $query = $pdo->prepare($sql);
      $query->bindValue(':user_id', $id, PDO::PARAM_STR);
      $query->execute();

      header("Location: index.php");

  }
}
