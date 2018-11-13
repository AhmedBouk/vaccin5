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
}
else {
    header("Location: 404.php");
}

// creation d'un lien Modifier qui emmene vers une nouvelle page ou il ya un formulaire avec nom prenom etc pour modifier les informations


include('inc/header.php');
?>

<style media="screen">
  table tr, table tr td{
    padding : 15px;
  }
</style>
<!-- Il y a une id class container autour du body  -->



            <div class="">
              <table class="">
                <tr>
                  <th>Nom</th>
                  <th>Obligatoire</th>
                  <th>Effectué</th>
                  <th>Fréquences d'injection</th>
                  <th>Ajouter</th>
                </tr>
                <?php foreach ($listVaccins as $listVaccin) {
                    echo '<tr><td>'.$listVaccin['nom'].'</td>';

                    if ($listVaccin['obligatoire'] == 1) {
                       echo '<td>Obligatoire</td>';
                    } else {
                      echo '<td>Non obligatoire</td>';
                    }

                    if(in_array($listVaccin['id'],$tableauId)) {
                      echo '<td><img src="assets/image/icon_fait.svg" alt="Fait"></td>';
                    } else {
                      echo '<td><img src="assets/image/icon_non_fait.svg" alt="Fait"></td>';
                    }

                    echo '</td><td>'.$listVaccin['frequences_injections'].'</td>' ;
                    echo '<td>';
                    ?>

                    <input type="submit" name="" value="Ajouter"><?php echo '</td></tr>' ;
                  } ?>
              </table>
            </div>

<?php include('inc/footer.php');
