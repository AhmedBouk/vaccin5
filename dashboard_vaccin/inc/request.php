<?php

function requeteListe($nomTable,$offset,$itemPerPage){
  global $pdo;

  $sql = "SELECT * FROM $nomTable LIMIT $offset,$itemPerPage";
  $query= $pdo -> prepare($sql) ;
  $query-> execute();
  $tableau = $query -> fetchall();
  return $tableau;
}



//Fonction pour effacer un utilisateur en fonction de son id
function deleteUser($id){
  global $pdo;

  $sql="DELETE FROM v5_users WHERE id=:id";
  $query = $pdo ->prepare($sql);
  $query -> bindValue(':id',$id,PDO::PARAM_INT);
  $query -> execute();
}

function deleteVaccins($id){
  global $pdo;

  $sql="DELETE FROM v5_vaccin WHERE id=:id";
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
function compteVaccins(){
  global $pdo;
  $sql = "SELECT COUNT(id) FROM v5_vaccin ";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $count = $stmt->fetchColumn();
  return $count;
}


?>
