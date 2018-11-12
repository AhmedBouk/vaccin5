<?php
include('inc/fonctions.php');
include('inc/pdo.php');
$title = 'profil';

if(is_logged()){
  if(!empty($_GET['id'])){

    $id = $_GET['id'];
    $sql = " SELECT nom,
                    prenom,
                    sexe,
                    mail,
                    date_naissance
             FROM v5_users
             WHERE id = $id ";
             // WHERE id = :id AND nom = :nom AND prenom = :prenom
             // AND sexe = :sexe AND date_naissance = :date_naissance;


    $query =$pdo ->prepare($sql);
    $query -> bindValue(':id',$id, PDO ::PARAM_STR);
    // $query -> bindValue(':nom',$nom, PDO ::PARAM_STR);
    // $query -> bindValue(':prenom',$prenom, PDO ::PARAM_STR);
    // $query -> bindValue(':sexe',$sexe, PDO ::PARAM_STR);
    // $query -> bindValue(':mail',$mail, PDO ::PARAM_STR);
    // $query -> bindValue(':date_naissance',$date_naissance, PDO ::PARAM_STR);
    $query -> execute();
    $profil= $query -> fetchAll();

 // debug($profil);
 if (!empty($_Get['id'])) {
   $id =$_GET['id'];
   $sql = "SELECT `nom`,`obligatoire`,`rappel` FROM `v5_vaccin` WHERE id = $id";
  $query = $pdo -> prepare($sql);
  $query -> bindValue(':id',$id, PDO ::PARAM_STR);
  $query -> bindValue(':obligatoire',1, PDO ::PARAM_STR);
  $query -> execute();
  $vaccin= $query -> fetchAll();
  // debug($vaccin);


}else {
  // header("Location: 404.php");
}
  }else {
          // header("Location: 404.php");
  }
}else {
    header("Location: 404.php");
}


//si $_GET ['id'] est renseigné et pas vide  on faite une {
// et si elle est connecté {

/* requete  avec son $_Get['id'] affiché
nom, prenom,sexe, date de naissance,mail de la table users
preparation requete
requete SELECT * FROM USERS WHERE id =:id etc
$query = $pdo ->prepare($sql);
protection injection sql
$query -> bindValue(':id',$id, PDO ::PARAM_STR);
$query -> bindValue(':nom',$nom, PDO ::PARAM_STR);
$query -> bindValue(':prenom',$prenom, PDO ::PARAM_STR);
$query -> bindValue(':sexe',$sexe, PDO ::PARAM_STR);
$query -> bindValue(':mail',$mail, PDO ::PARAM_STR);
$query -> bindValue(':date_naissance',$date_naissance, PDO ::PARAM_STR);

execution de la requete preparé
$query -> execute();
$profil = $query -> fetchAll();
}
}





creation d'un lien Modifier qui emmene vers une nouvelle page ou il ya un formulaire avec nom prenom etc pour modifier les informations

requete update





*/






include('inc/header.php');

?>




<ul class="description">
      <li>  Nom : <?php echo $_SESSION['user']['nom'] ;?> </li>
      <li>  Prenom : <?php echo $_SESSION['user']['prenom'] ;?></li>
      <li>  Sexe : <?php echo $_SESSION['user']['sexe'] ;?> </li>
      <li>  mail :<?php echo $_SESSION['user']['mail'] ;?> </li>
      <li>  Date de Naissance : <?php echo $_SESSION['user']['date_naissance'] ;?></li>
</ul>




<?php include('inc/footer.php');
