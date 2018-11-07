<?php
  include('inc/fonctions.php');

  $title = 'ACCUEIL';
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

         <form class="register-form">
           <input type="text" placeholder="Nom"/>
           <input type="text" placeholder="Mail"/>
           <input type="password" placeholder="Mot de passe"/>
           <input type="password2" placeholder="Confirmation du mot de passe"/>
           <button>Créer</button>
           <p class="message">Déjà inscrit ? <a href="#">Connectez-vous</a></p>
         </form>

         <form class="login-form">
           <input type="text" placeholder="Nom"/>
           <input type="password" placeholder="Mot de passe"/>
           <button>Connexion</button>
           <p class="message">Pas de compte ? <a href="#">Créer un compte</a></p>
           <p class="pwdoublie"> <a href="#">Mot de passe oublié</a></p>
         </form>
       </div>
     </div>
   </div>

 </div>
<div class="clear"></div>


<?php include('inc/footer.php');?>
