<?php
include('inc/fonctions.php');
include('inc/pdo.php');
include('dashboard_vaccin/inc/request.php');
$title = 'Ajout de vaccin';

// si la personne est connecté
if(is_logged()){

// requete on selectionne tout de la table v5_users de la personne connecté selon son id
    $id = $_SESSION['user']['id'];
    $sql = " SELECT *
             FROM v5_users
             WHERE id = $id";
    $query =$pdo ->prepare($sql);
    $query -> execute();
    $profil= $query -> fetch();

    if(!empty($profil)) {

      $sql = "SELECT *
              FROM v5_vaccin";
      $query = $pdo -> prepare($sql);
      $query -> execute();
      $listVaccins= $query -> fetchAll();




// Requete des vaccins obligatoires
      $sql = "SELECT * FROM v5_vaccin AS v
              LEFT JOIN v5_relation AS pivot
              ON v.id = pivot.vaccin_id
              WHERE pivot.user_id = $id";
      $query = $pdo -> prepare($sql);
      $query -> execute();
      $vaccinfaits= $query -> fetchall();

      $tableauId = array();
      foreach ($vaccinfaits as $v) {
            $tableauId[] = $v['vaccin_id'];
      }



    }else {
        header("Location: 404.php");
    }
    $vaccin_id = $listVaccins['id'];

    if (!empty($_POST['submit_aj'])) {

      $sql = "INSERT INTO `v5_relation`(`user_id`, `vaccin_id`, `created_at`) VALUES (:user_id , :vaccin_id , now()) ";


      $query= $pdo -> prepare($sql) ;
      $query-> bindvalue(':user_id' , $id , PDO::PARAM_STR );
      $query-> bindvalue(':vaccin_id' , $vaccin_id , PDO::PARAM_STR );
      $query-> execute();
}



}

else {
    header("Location: 404.php");
}

// creation d'un lien Modifier qui emmene vers une nouvelle page ou il ya un formulaire avec nom prenom etc pour modifier les informations

debug($vaccin_id);
include('inc/header.php');
?>

<style media="screen">
  table tr, table tr td{
    padding : 15px;
  }
</style>
<!-- Il y a une id class container autour du body  -->



            <div class="modif_vaccin">
              <h2>Ajouts / Retrait vaccins</h2>
              <table class="form table_vaccin">
                <tr>
                  <th class="parent"><p class="enfant">Nom</p></th>
                  <th class="parent"><p class="enfant">Obligatoire / Recommandé</p></th>
                  <th class="parent"><p class="enfant">Effectué</p></th>
                  <th class="parent"><p class="enfant">Fréquences d'injection</p></th>
                  <th class="parent"><p class="enfant">Ajouter</p></th>
                </tr>
                <?php foreach ($listVaccins as $listVaccin) {
                    echo '<tr><td class="parent"><p class="enfant">'.$listVaccin['nom'].'</p></td>';

                    if ($listVaccin['obligatoire'] == 1) {
                       echo '<td class="parent"><p class="enfant">Obligatoire</p></td>';
                    } else {
                      echo '<td class="parent"><p class="enfant">Recommandé</p></td>';
                    }

                    if(in_array($listVaccin['id'],$tableauId)) {
                      echo '<td class="parent"><img class="enfant" src="assets/image/icon_fait.svg" alt="Fait"></td>';
                    } else {
                      echo '<td class="parent"><img class="enfant" src="assets/image/icon_non_fait.svg" alt="Fait"></td>';
                    }

                    echo '</td><td class="parent"><p class="enfant">'.$listVaccin['frequences_injections'].'</p></td>' ;
                    echo '<td>';
                    ?>

                    <form action="" method="post">
                    <input class="button" type="submit" name="submit_aj" value="Ajouter"></form><?php echo '</td></tr>' ;
                  } ?>
              </table>

              <div class="button_div">
                <a class="button" href="profil.php">Retour</a>
              </div>
            </div>


<?php include('inc/footer.php');
