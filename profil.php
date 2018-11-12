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
// protection injextion sql
// $query -> bindValue(':id',$id, PDO ::PARAM_STR);
// execution de la requete
    $query -> execute();
    $profil= $query -> fetch();
    //debug($profil);

    if(!empty($profil)) {


 // debug($profil);



  $sql = "SELECT *
          FROM v5_vaccin
          WHERE obligatoire = 1";
  $query = $pdo -> prepare($sql);

// $query -> bindValue(':obligatoire',1, PDO ::PARAM_STR);
  $query -> execute();
  $vaccinObligatoires= $query -> fetchAll();
//  debug($vaccinObligatoire);


$sql = "SELECT *
        FROM v5_vaccin
        WHERE obligatoire = 0";
$query = $pdo -> prepare($sql);

// $query -> bindValue(':obligatoire',1, PDO ::PARAM_STR);
$query -> execute();
$vaccinNonObligatoires= $query -> fetchAll();
 debug($vaccinNonObligatoire);



  $sql = "SELECT * FROM v5_vaccin AS v
          LEFT JOIN v5_relation AS pivot
          ON v.id = pivot.vaccin_id
          WHERE pivot.user_id = $id
          AND v.obligatoire = 1";

  $query = $pdo -> prepare($sql);
  $query -> execute();
  $vaccinfait= $query -> fetchAll();
      debug($vaccinfait);


    }else {
        header("Location: 404.php");
    }


}
else {
    header("Location: 404.php");
}







//
// creation d'un lien Modifier qui emmene vers une nouvelle page ou il ya un formulaire avec nom prenom etc pour modifier les informations
//
// requete update











include('inc/header.php');

?>




<ul class="description">
      <li>  Nom : <?php echo $profil['nom'] ;?> </li>
      <li>  Prenom : <?php echo $profil['prenom'] ;?></li>
      <li>  Sexe : <?php echo $profil['sexe'] ;?> </li>
      <li>  mail :<?php echo $profil['mail'] ;?> </li>
      <li>  Date de Naissance : <?php echo $profil['date_naissance'] ;?></li>
</ul>

<table classe="vaccinFait">

   <?php foreach ($vaccinObligatoires as $vaccinObligatoire):
     ?> <tr> <?php
 echo '<td>' .$vaccinObligatoire['nom']. '</td>';
 echo '<td>' .$vaccinObligatoire['rappel']. '</td>';
    ?> </tr> <?php
   endforeach; ?>

</table>
<br>
<table classe="vaccinFait">

   <?php foreach ($vaccinNonObligatoires as $vaccinNonObligatoire):
     ?> <tr> <?php
 echo '<td>' .$vaccinNonObligatoire['nom']. '</td>';
 echo '<td>' .$vaccinNonObligatoire['rappel']. '</td>';
    ?> </tr> <?php
   endforeach; ?>

</table>


<?php include('inc/footer.php');
