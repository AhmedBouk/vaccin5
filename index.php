<?php
  include('inc/pdo.php');
  include('inc/fonctions.php');
  $title = 'ACCUEIL';
  $error_reg = array();
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


if (validationText($error_reg,$nom,3,20,'nom')) {
  if(!empty($_POST['nom'])) {

  } else {
    $error_reg['nom'] = 'Veuillez renseigner ce champs';
    }
}
if (validationText($error_reg,$prenom,3,20,'prenom')) {
  if(!empty($_POST['prenom'])) {

  } else {
    $error_reg['prenom'] = 'Veuillez renseigner ce champs';
    }
}

if (validationEmail($error_reg,$mail,'mail')) {
  $sql="SELECT mail FROM users WHERE mail = :mail";
  $query= $pdo -> prepare($sql) ;
  $query-> bindValue(':mail' , $mail , PDO::PARAM_STR );
  $query-> execute();
  $testmail = $query -> fetch();

  if (!empty($testmail)) {
      $error_reg['mail'] =  'Cet email est déjà pris';
  }
  }
  else {
  $error_reg['mail'] = 'Veuillez renseigner ce champs';
  }

  validation2Password($error_reg,$pwd1,$pwd2,'pwd1');

  if (count($error_reg)==0) {
    $hash     = password_hash($pwd1 , PASSWORD_DEFAULT);
    $token    = generateRandomString(120);

    $sql = "INSERT INTO `users`(`nom`, `prenom`,`mail`, `token`, `mdp`, `role`, `created_at`) VALUES (:nom , :prenom , :mail , :token, :pwd1 ,'user' , now()) ";
    $query= $pdo -> prepare($sql) ;
    $query-> bindvalue(':nom' , $nom , PDO::PARAM_STR );
    $query-> bindvalue(':prenom' , $prenom , PDO::PARAM_STR );
    $query-> bindvalue(':mail' , $mail , PDO::PARAM_STR );
    $query-> bindvalue(':pwd1' , $hash , PDO::PARAM_STR );
    $query-> bindvalue(':token' , $token , PDO::PARAM_STR );
    $query-> execute();
  }
 }?>
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

           <p class="message">Déjà inscrit ? <a href="#">Connectez-vous</a></p>
           <p class="pwdoublie"> <a href="#">Mot de passe oublié</a></p>
         </form>

         <form class="login-form">
           <input type="text" placeholder="Nom"/>
           <input type="password" placeholder="Mot de passe"/>
           <input class="button" type="submit" name="submit_register" value="Connexion">
           <p class="message">Pas de compte ? <a href="#">Créer un compte</a></p>
           <p class="pwdoublie"> <a href="#">Mot de passe oublié</a></p>
         </form>
       </div>
     </div>
   </div>

 </div>
<div class="clear"></div>

<a href="dashboard_vaccin/index.php">back office</a>


<div class="commentaires">
  <h2>Commentaires de nos utilisateurs satisfaits</h2>
  <div class="photos">

    <div class="photo">
      <img src="http://www.jeromeoliveras.com/v3/wp-content/uploads/image-03-full-c.jpg" alt="camille">
      <p>J'ai adoré ce service</p>
      <p>Michel</p>
    </div>
    <div class="photo">
      <img src="http://www.jeromeoliveras.com/v3/wp-content/uploads/image-03-full-c.jpg" alt="jonathan">
      <p>J'ai adoré ce service</p>
      <p>Paul</p>
    </div>
    <div class="photo">
      <img src="http://www.jeromeoliveras.com/v3/wp-content/uploads/image-03-full-c.jpg" alt="ahmed">
      <p>J'ai adoré ce service</p>
      <p>Fatima</p>
    </div>
    <div class="photo">
      <img src="http://www.jeromeoliveras.com/v3/wp-content/uploads/image-03-full-c.jpg" alt="emilie">
      <p>J'ai adoré ce service</p>
      <p>Aurélie</p>
    </div>
    <div class="clear"></div>
  </div>

</div>



<?php include('inc/footer.php');?>
