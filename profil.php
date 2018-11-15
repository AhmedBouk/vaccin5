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
    $query =$pdo ->prepare($sql);
    $query -> execute();
    $profil= $query -> fetch();

    if(!empty($profil)) {

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


<div class="modif_vaccin">


  <h2>Description</h2>
<div class="form table_vaccin">

  <ul class="description">
        <li>  Nom : <?php echo $profil['nom'] ;?> </li>
        <li>  Prenom : <?php echo $profil['prenom'] ; ?></li>
        <li>  Sexe : <?php echo $profil['sexe'] ; ?> </li>
        <li>  mail :  <?php echo $profil['mail'] ; ?> </li>
        <li>  Date de Naissance : <?php echo $profil['date_naissance'] ;?></li>
  </ul>

<div class="button_div">
  <a class="button" href="modifier_profil.php">Modifier profil</a>
</div>
</div>
</div>




<div class="modif_vaccin">

  <h2>Vaccins Obligatoires</h2>
    <table class="form table_vaccin">

      <tr>
        <th class="parent"><p class="enfant">Nom</p></th>
        <th class="parent"><p class="enfant">Fait</p></th>
        <th class="parent"><p class="enfant">Fréquences d'injection</p></th>
        <th class="parent"><p class="enfant">Rappel</p></th>
      </tr>

      <?php foreach ($listVaccinObligatoires as $listVaccinObligatoire):
        ?> <tr> <?php
        echo '<td class="parent"><p class="enfant">' .$listVaccinObligatoire['nom']. '</p></td>';

          if(in_array($listVaccinObligatoire['id'],$tableauId)) {
            echo '<td class="parent"><img class="enfant" src="assets/image/icon_fait.svg" alt="Fait"></td>';
          } else {
            echo '<td class="parent"><img class="enfant" src="assets/image/icon_non_fait.svg" alt="Fait"></td>';
          }

        echo '<td class="parent"><p class="enfant">' .$listVaccinObligatoire['frequences_injections']. '</p></td>';
        echo '<td class="parent"><p class="enfant">' .$listVaccinObligatoire['frequences_injections']. '</p></td>';
           ?> </tr> <?php
          endforeach; ?>
    </table>



<h2>Vaccins non obligatoires efféctués</h2>
<table class="form table_vaccin">

  <tr>
    <th class="parent"><p class="enfant">Nom</p></th>
    <th class="parent"><p class="enfant">Fréquences d'injection</p></th>
    <th class="parent"><p class="enfant">Rappel</p></th>
  </tr>

  <?php foreach ($vaccinNonObligatoires as $vaccinNonObligatoire):
    ?> <tr> <?php
echo '<td class="parent"><p class="enfant">' .$vaccinNonObligatoire['nom']. '</p></td>';
echo '<td class="parent"><p class="enfant">' .$vaccinNonObligatoire['frequences_injections']. '</p></td>';
echo '<td class="parent"><p class="enfant">' .$vaccinNonObligatoire['rappel']. '</p></td>';
   ?> </tr> <?php
  endforeach; ?>

</table>
<div class="button_div">
  <a class="button center" href="modif_vaccin.php">Ajout retrait de vaccin</a>
</div>

<div class="button_div">
  <a class="button" href="index.php">Retour</a>
</div>
</div>
<?php include('inc/footer.php');
