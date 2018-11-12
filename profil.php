<?php
include('inc/fonctions.php');
include('inc/pdo.php');
// titre de la page
$title = 'profil';

// si la personne est connecté
if(is_logged()){

// requete on selectionne tout de la table v5_users de la personne connecté selon son id
    $id = $_SESSION['user']['id'];
    $sql = " SELECT *
             FROM v5_users
             WHERE id = $id";

// preparation de la bdd
    $query =$pdo ->prepare($sql);
    $query -> execute();
    $profil= $query -> fetch();

    if(!empty($profil)) {
// a virer
      $sql = "SELECT *
              FROM v5_vaccin
              WHERE obligatoire = 1";
      $query = $pdo -> prepare($sql);
      $query -> execute();
      $listVaccinObligatoires= $query -> fetchAll();

// Requete des vaccins non obligatoires
      $sql = $sql = "SELECT * FROM v5_vaccin AS v
              LEFT JOIN v5_relation AS pivot
              ON v.id = pivot.vaccin_id
              WHERE pivot.user_id = $id
              AND v.obligatoire = 0";
      $query = $pdo -> prepare($sql);
      $query -> execute();
      $vaccinNonObligatoires = $query -> fetchAll();



// Requete des vaccins obligatoires
      $sql = "SELECT * FROM v5_vaccin AS v
              LEFT JOIN v5_relation AS pivot
              ON v.id = pivot.vaccin_id
              WHERE pivot.user_id = $id
              AND v.obligatoire = 1";
      $query = $pdo -> prepare($sql);
      $query -> execute();
      $vaccinObligatoires= $query -> fetchall();

      $tableauId = array();
      foreach ($vaccinObligatoires as $v) {
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


<ul class="description">
      <li>  Nom : <?php echo $profil['nom'] ;?> </li>
      <li>  Prenom : <?php echo $profil['prenom'] ; ?></li>
      <li>  Sexe : <?php echo $profil['sexe'] ; ?> </li>
      <li>  mail :<?php echo $profil['mail'] ; ?> </li>
      <li>  Date de Naissance : <?php echo $profil['date_naissance'] ;?></li>
</ul>
<a href="modifier_profil.php">Modifier profil</a>

<h2>obligatoire</h2>
<table classe="vaccinObligatoires">

  <?php foreach ($listVaccinObligatoires as $listVaccinObligatoire):
    ?> <tr> <?php
    echo '<td>' .$listVaccinObligatoire['nom']. '</td>';

      if(in_array($listVaccinObligatoire['id'],$tableauId)) {
        echo '<td><img src="assets/image/icon_fait.svg" alt="Fait"></td>';
      } else {
        echo '<td><img src="assets/image/icon_non_fait.svg" alt="Fait"></td>';
      }

    echo '<td>' .$listVaccinObligatoire['frequences_injections']. '</td>';
    echo '<td>' .$listVaccinObligatoire['rappel']. '</td>';
       ?> </tr> <?php
      endforeach; ?>



</table>

<br>
<h2>non obligatoire</h2>
<table classe="vaccinNonObligatoires">

  <?php foreach ($vaccinNonObligatoires as $vaccinNonObligatoire):
    ?> <tr> <?php
echo '<td>' .$vaccinNonObligatoire['nom']. '</td>';
echo '<td>' .$vaccinNonObligatoire['frequences_injections']. '</td>';
echo '<td>' .$vaccinNonObligatoire['rappel']. '</td>';
   ?> </tr> <?php
  endforeach; ?>

</table>

<?php debug($_SESSION['user']['id']) ?>
<?php include('inc/footer.php');
