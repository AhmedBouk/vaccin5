<?php

function requeteListeUser(){
global $pdo;

$sql = "SELECT * FROM v5_users";
$query= $pdo -> prepare($sql) ;
$query-> execute();
$tableauUsers = $query -> fetchall();
return $tableauUsers;
}

function requeteListeVaccins(){
global $pdo;

$sql = "SELECT * FROM v5_vaccin";
$query= $pdo -> prepare($sql) ;
$query-> execute();
$tableauVaccins = $query -> fetchall();
return $tableauVaccins;
}


//Fonction pour effacer un utilisateur en fonction de son id
function deleteuser($id){
  global $pdo;

  $sql="DELETE FROM v5_users WHERE id=:id";
  $query = $pdo ->prepare($sql);
  $query -> bindValue(':id',$id,PDO::PARAM_INT);
  $query -> execute();
}

function compteUtilisateur(){
  global $pdo;
  $sql = "SELECT COUNT(id) FROM v5_users ";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $count = $stmt->fetchColumn();
  return $count;
}



?>
