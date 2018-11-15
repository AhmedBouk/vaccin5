<?php
// Requete permettant de retourner tous les éléments d'une table + pagination
function requeteListe($nomTable,$offset,$itemPerPage){
  global $pdo;

  $sql = "SELECT * FROM $nomTable LIMIT $offset,$itemPerPage";
  $query= $pdo -> prepare($sql) ;
  $query-> execute();
  return $query -> fetchall();
}
//Fonction pour effacer une ligne dans la table
function delete($nomTable,$id){
  global $pdo;

  $sql="DELETE FROM $nomTable WHERE id=:id";
  $query = $pdo ->prepare($sql);
  $query -> bindValue(':id',$id,PDO::PARAM_INT);
  $query -> execute();
}
//Comptre le nombre de lignes dans une table
function compteItem($nomTable){
  global $pdo;

  $sql = "SELECT COUNT(id) FROM $nomTable ";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  return $stmt->fetchColumn();
}
?>
