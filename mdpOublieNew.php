<?php
include('inc/pdo.php');
include('inc/fonctions.php');
$title = 'MDP oublié New';

$error = array();

if(!empty($_GET['mail']) && !empty($_GET['token'])){
    $mail   = urldecode($_GET['mail']);
    $token  = urldecode($_GET['token']);

    $sql="SELECT id FROM v5_users WHERE mail = :mail AND token = :token"; //requete à modifier
    $query= $pdo -> prepare($sql) ;
    $query-> bindValue(':mail' , $mail , PDO::PARAM_STR );
    $query-> bindValue(':token' , $token , PDO::PARAM_STR );
    $query-> execute();
    $user = $query -> fetch();
    if(!empty($user)){

      if (!empty($_POST['submitted'])) {

        $password      = clean('password');
        $password2     = clean('password2');

        if(!empty($password) && !empty($password2)) {
          if($password != $password2) {
            $error['password'] = 'Les mots de passe sont différents';
          }
        }

        if (count($error)==0) {
          $hash     = password_hash($password , PASSWORD_DEFAULT);
          $token    = generateRandomString(120);

          $sql = "UPDATE v5_users set mdp= :password ,token= :token, updated_at= now() WHERE id= :id";
          $query= $pdo -> prepare($sql) ;
          $query-> bindvalue(':password' , $hash , PDO::PARAM_STR );
          $query-> bindvalue(':token' , $token , PDO::PARAM_STR );
          $query-> bindvalue(':id' , $user , PDO::PARAM_INT );
          $query-> execute();

debug($user);
          // header('location: index.php');

    }
  }
    }else{
      die('4041');
    }
  }else {
  die('4042');
  }




include('inc/header.php');


?>
<!-- Il y a une div class container autour du body  -->

<form  action="" method="post">
  <input type="text" name="password" placeholder="MDP 1" value="">
  <input type="text" name="password2" placeholder="MDP 2" value="">
  <span><?php spanError($error,'password') ?></span>

  <input type="submit" name="submitted" value="Envoyer">


</form>












<?php include('inc/footer.php'); ?>
