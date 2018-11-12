<?php
  include('inc/pdo.php');
  include('inc/fonctions.php');
  include('inc/connexion.php');
  include('inc/inscription.php');
  $title = 'ACCUEIL';


  $inscrit = '';
  include('inc/header.php');

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
