<?php
  include('inc/pdo.php');
  include('inc/fonctions.php');
  include('inc/connexion.php');
  include('inc/inscription.php');
  $title = 'ACCUEIL';


  $inscrit = '';
  include('inc/header.php');

// Inscription:

// Lors de la soumission du formulaire
if (!empty($_POST['submit_register'])) {

// fonction declarant et nettoyant (expace au debut et à la fin & supprimant les caractère pouvant créer un script) une variable

  $nom      = clean('nom');
  $prenom   = clean('prenom');
  $mail     = clean('mail');
  $pwd1     = clean('pwd1');
  $pwd2     = clean('pwd2');


  if(!empty($nom)) {
    if(strlen($nom) < 3 ) {
      $error_reg['nom'] = 'Ce champs est trop court.(minimum 3 caractères)';
    } elseif(strlen($nom) > 20) {
        $error_reg['nom'] = 'Ce champs est trop long.(maximum 20 caractères)';
      } $inscrit = 1;
  } else {
      $error_reg['nom'] = 'Veuillez renseigner ce champs';
    }
  if(!empty($prenom)) {
    if(strlen($prenom) < 3 ) {
      $error_reg['prenom'] = 'Ce champs est trop court.(minimum 3 caractères)';
    } elseif(strlen($prenom) > 20) {
        $error_reg['prenom'] = 'Ce champs est trop long.(maximum 20 caractères)';
      } $inscrit .= 2;
      } else {
          $error_reg['prenom'] = 'Veuillez renseigner ce champs';
        }

  if(!empty($mail)) {
    if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $error_reg['mail'] = 'Ceci n\'est pas une adresse mail.';
    } else {
      $sql="SELECT mail FROM v5_users WHERE mail = :mail";
      $query= $pdo -> prepare($sql) ;
      $query-> bindValue(':mail' , $mail , PDO::PARAM_STR );
      $query-> execute();
      $testmail = $query -> fetch();

      if (!empty($testmail)) {
          $error_reg['mail'] =  'Cet email est déjà pris';
      } $inscrit .= 3;
    }
  } else {
    $error_reg['mail'] = 'Veuillez renseigner ce champs';
  }

  // test le mot de passe si il peut être inclut dans la base de donnée
  if(!empty($pwd1) && !empty($pwd2)) {
    if($pwd1 != $pwd2) {
      $error_reg['pwd1'] = 'Les mots de passe sont différents';
    }
    $inscrit .= 4;
    }

if (validationEmail($error_reg,$mail,'mail')) {
  $sql="SELECT mail FROM v5_users WHERE mail = :mail";
  $query= $pdo -> prepare($sql) ;
  $query-> bindValue(':mail' , $mail , PDO::PARAM_STR );
  $query-> execute();
  $testmail = $query -> fetch();

 }else  {

       $error_reg['pwd1'] = 'Veuillez renseigner ce champs';
  }


  if (count($error_reg)==0) {
    $hash     = password_hash($pwd1 , PASSWORD_DEFAULT);
    $token    = generateRandomString(120);



    $sql = "INSERT INTO `v5_users`(`nom`, `prenom`,`mail`, `token`, `mdp`, `role`, `created_at`) VALUES (:nom , :prenom , :mail , :token, :pwd1 ,'utilisateur' , now()) ";


    $query= $pdo -> prepare($sql) ;
    $query-> bindvalue(':nom' , $nom , PDO::PARAM_STR );
    $query-> bindvalue(':prenom' , $prenom , PDO::PARAM_STR );
    $query-> bindvalue(':mail' , $mail , PDO::PARAM_STR );
    $query-> bindvalue(':pwd1' , $hash , PDO::PARAM_STR );
    $query-> bindvalue(':token' , $token , PDO::PARAM_STR );
    $query-> execute();
  }
}

// Connexion
// Lors de la soumission du formulaire
if(!empty($_POST['submit_login'])){

// fonction declarant et nettoyant (expace au debut et à la fin & supprimant les caractère pouvant créer un script) une variable
$mail_login  = clean('mail');
$pwd_loggin  = clean('pwd');

// test si le mail existe
$sql="SELECT * FROM v5_users WHERE mail =:mail "; //requete à modifier
$query= $pdo -> prepare($sql) ;//preparer la requete
$query-> bindvalue(':mail' , $mail_login , PDO::PARAM_STR );
$query-> execute(); //execute la requete
$user = $query -> fetch(); // $a variable retourner / fetchall() pour les requetes avec multiple array sinon fetch()

// test si le mot de passe existe
if(!empty($user)) {
  if (!password_verify ($pwd_loggin , $user['mdp'] )) {
    $error_log['mdp'] = 'Mauvais mot de passe';
  }
  }else{
    $error_mdp['mdp'] = 'Veuillez vous inscrire';
}

if (count($error_log) == 0) {
  $_SESSION['user'] = array(
    'id'      =>$user['id'],
    'nom'     =>$user['nom'],
    'prenom'  =>$user['prenom'],
    'mail'    =>$user['mail'],
    'sexe'    =>$user['sexe'],
    'date_naissance'    =>$user['date_naissance'],
    'role'    =>$user['role'],
    'ip'      =>$_SERVER["REMOTE_ADDR"]

  );
}

}

 ?>
 <div class="contenu">

   <div class="sliders">
      <div id="slider">
        <figure>
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/4273/austin-fireworks.jpg" alt>
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/4273/taj-mahal_copy.jpg" alt>
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/4273/ibiza.jpg" alt>
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/4273/ankor-wat.jpg" alt>
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/4273/austin-fireworks.jpg" alt>
        </figure>
      </div>
   </div>

   <div class="inscription">
     <div class="login-page">
       <div class="form">

         <form class="register-form" action="" method="post">
           <input type="text" name="nom" placeholder="Nom" value="<?php value('nom') ?>" />
           <span><?php spanError($error_reg,'nom') ?></span>

           <input type="text" name="prenom" placeholder="Prénom" value="<?php value('prenom') ?>" />
           <span><?php spanError($error_reg,'prenom') ?></span>

           <input type="text" name="mail" placeholder="Mail" value="<?php value('mail') ?>">
           <span><?php spanError($error_reg,'mail') ?></span>

           <input type="password" name="pwd1" placeholder="Mot de passe">
           <span><?php spanError($error_reg,'pwd1') ?></span>

           <input type="password" name="pwd2" placeholder="Confirmation du mot de passe">
           <span><?php spanError($error_reg,'pwd1') ?></span>

           <input class="button" type="submit" name="submit_register" value="Créer">
           <span><?php if ($inscrit =1234) {
             echo $inscrit;
           }
            ?></span>

           <p class="message">Déjà inscrit ? <a href="#">Connectez-vous</a></p>

         </form>


         <form class="login-form" action="" method="post">
           <input type="text" name="mail"  placeholder="Mail"/>
           <span><?php spanError($error_log,'mail') ?></span>
           <input type="password" name="pwd" placeholder="Mot de passe"/>
           <span><?php spanError($error_log,'pwd') ?></span>
           <input class="button" type="submit" name="submit_login" value="Connexion">
           <p class="message">Pas de compte ? <a href="#">Créer un compte</a></p>
           <p class="pwdoublie"> <a href="mdpoublie.php">Mot de passe oublié</a></p>
         </form>
       </div>
     </div>
   </div>

 </div>
<div class="clear"></div>






<div class="comment-users">
  <h2>Commentaires de nos utilisateurs satisfaits</h2>
  <div class="commentaires">

    <div class="commentaire">
      <p>Michel</p>
      <p>Je trouve ce service utile et d'utilité publique</p>
      <p>inscrit depuis le 10/05/2017</p>
    </div>

    <div class="commentaire">
      <p>Berénice</p>
      <p>Je l'utilise pour mes enfants, plus de risque d'oublié</p>
      <p>inscrite depuis le 21/09/2017</p>
    </div>

    <div class="commentaire">
      <p>Rashid</p>
      <p>Simple et utile, je le recommande et bla bla bla</p>
      <p>inscrit depuis le 01/02/2018</p>
    </div>

    <div class="commentaire">
      <p>Joseph</p>
      <p>Super Cool, youp salla boule et bla bla bla</p>
      <p>inscrit depuis le 30/10/2017</p>
    </div>

    <div class="clear"></div>
  </div>

</div>



<?php include('inc/footer.php');?>
