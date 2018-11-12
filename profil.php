<?php
include('inc/fonctions.php');
include('inc/pdo.php');
$title = 'profil';

if(is_logged()){


    $id = $_SESSION['user']['id'];
    $sql = " SELECT *
             FROM v5_users
             WHERE id = $id";
             // WHERE id = :id AND nom = :nom AND prenom = :prenom
             // AND sexe = :sexe AND date_naissance = :date_naissance;


    $query =$pdo ->prepare($sql);
    $query -> bindValue(':id',$id, PDO ::PARAM_STR);
    // $query -> bindValue(':nom',$nom, PDO ::PARAM_STR);
    // $query -> bindValue(':prenom',$prenom, PDO ::PARAM_STR);

    $query -> execute();
    $profil= $query -> fetch();
    //debug($profil);

    if(!empty($profil)) {


 // debug($profil);

   // $sql = "SELECT nom,
   //                obligatoire,
   //                rappel
   //         FROM v5_vaccin AS v, v5_users AS u
   //         WHERE v.v5_users_id = u.id";



  $sql = "SELECT * FROM v5_vaccin WHERE obligatoire = 1";
  $query = $pdo -> prepare($sql);
  //$query -> bindValue(':id',$id, PDO ::PARAM_STR);
  // $query -> bindValue(':obligatoire',1, PDO ::PARAM_STR);
  $query -> execute();
  $vaccinObligatoire= $query -> fetchAll();
//  debug($vaccinObligatoire);



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
      <li>  Sexe : <?php echo $profil['mail'] ;?> </li>
      <li>  mail :<?php echo $profil['sexe'] ;?> </li>
      <li>  Date de Naissance : <?php echo $profil['date_naissance'] ;?></li>
</ul>

<table classe="vaccinFait">

</table>


<?php include('inc/footer.php');
