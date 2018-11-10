<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="" />
   <meta name="keywords" content="" />
   <meta name="author" content="" />
   <meta name="robots" content=""/>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- Le commentaire suivant fait en sorte que Internet expolorer 9 fonctionne avec html 5 -->
<!--[if lt IE 9]>
<script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

  </head>
  <body>
      <header>
        <div class="wrapHF">
          <a href="index.php"><img src="assets/image/logo.png" alt="logo"></a>
          <div class="titre">
            <h2>Mon Carnet de Vaccination</h2>
          </div>
          <div class="bienvenue">
          <p>
            <?php
              if (is_logged()) {

                echo '<p>Bienvenue : '. $_SESSION['user']['prenom'] .' </p> <br/>
                <p> <a href="deconnexion.php"> Deconnexion </a> </p>';
                // header('refresh: 1; URL=index.php');
              }
              if (is_admin()) {
                echo '<a href="dashboard_vaccin/index.php">back office</a>';
              }
            ?>
          </p>
          <a href="contact.php">Contact</a>


        </div>
      </div>
      </header>
    <div id="wrapper">
<a href="#"></a>
