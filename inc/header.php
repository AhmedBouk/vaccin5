<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="" />
     <meta name="keywords" content="" />
     <meta name="author" content="" />
     <meta name="robots" content=""/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="assets/slicknav/slicknav.css" />
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/flexslider/flexslider.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:900" rel="stylesheet">


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
            <h2 id="fittext2">Mon Carnet de Vaccination</h2>
          </div>

          <div class="bienvenue">


                <ul id="menu">
                        <?php
                          if (is_logged()) {

                            echo '<li> Bienvenue  '. $_SESSION['user']['prenom'] .'</li>' ;

                            echo '<li> <a href="profil.php"> Mon Profil </a></li>';
                            echo '<li> <a href="deconnexion.php"> Deconnexion </a></li>';

                            ?>
                            <style media="screen">
                              .inscription{display: none;}
                              .flexslider{width: 100%;margin: 40px 0;}
                            </style>
                            <?php
                            }
                        ?>

                            <li><a href="contact.php">Contact</a></li>

                      <?php
                          if (is_admin()) {
                            echo '<li><a href="dashboard_vaccin/index.php">back office</a></li>';
                          }
                      ?>
                    </ul>
        </div>

      </div>

      <div class="clear"></div> <!-- float header-->

      </header>
    <div id="wrapper">
