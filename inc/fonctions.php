<?php
// Saute eune ligne
function br(){
  echo '<br>';
}
//Affiche un tableau de façon claire
function debug($array){
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}
//Affiche une erreur dans le formulaire
function spanError($error, $key){
    if(!empty($error[$key])) {
    echo $error[$key]; }
}
//Ne prends pas en compte les balises html et php dans le champ
function clean($key){
  return trim(strip_tags($_POST[$key]));
}
