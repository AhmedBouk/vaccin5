<?php
include('../inc/pdo.php');
include('../inc/fonctions.php');
include('inc/request.php');

  $error = array();

  if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];} else { $id= ''; }

  // Condition de soumission du formulaire

    if (!empty($_POST['submitted'])){

      //Protection contre les failles xss
      $nom = clean('nom');
      $prenom = clean('prenom');
      $mail = clean('mail');
      $role = clean('role');

      //Verification contenu
      if(!empty($nom)) {
        if(strlen($nom) < 3 ) {
          $error['nom'] = 'Ce champs est trop court.(minimum 3 caractères)';
        } elseif(strlen($nom) > 20) {
            $error['nom'] = 'Ce champs est trop long.(maximum 20 caractères)';
          }
      } else {
          $error['nom'] = 'Veuillez renseigner ce champs';
        }
      //verification content
      if(!empty($prenom)) {
        if(strlen($prenom) < 3 ) {
          $error['prenom'] = 'Ce champs est trop court.(minimum 3 caractères)';
        } elseif(strlen($prenom) > 20) {
            $error['prenom'] = 'Ce champs est trop long.(maximum 20 caractères)';
          }
          } else {
              $error['prenom'] = 'Veuillez renseigner ce champs';
            }
        if(!empty($mail)) {
          if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $error['mail'] = 'Ceci n\'est pas une adresse mail.';
          } else {
                $sql="SELECT mail FROM v5_users WHERE mail = :mail";
                $query= $pdo -> prepare($sql) ;
                $query-> bindValue(':mail' , $mail , PDO::PARAM_STR );
                $query-> execute();
                $testmail = $query -> fetch();

                if (!empty($testmail)) {
                    $error['mail'] =  'Cet email est déjà pris';
              }
            }
          } else {
              $error['mail'] = 'Veuillez renseigner ce champs';
            }


      //Condition pas d'erreur
    if (count($error) == 0){

      $sql = "UPDATE v5_users SET nom = :nom, prenom = :prenom, mail = :mail, role = :role, updated_at = NOW() WHERE id = :id";
      // preparation de la requête
      $stmt = $pdo->prepare($sql);
      // Protection injections SQL
      $stmt->bindValue(':nom',$nom, PDO::PARAM_STR);
      $stmt->bindValue(':prenom',$prenom, PDO::PARAM_STR);
      $stmt->bindValue(':role',$role, PDO::PARAM_STR);
      $stmt-> bindValue(':mail' , $mail , PDO::PARAM_STR );
      $stmt->bindValue(':id',$id, PDO::PARAM_INT);
      // execution de la requête preparé
      $stmt->execute();

      header("Location: liste_utilisateurs.php");

    }
  }else {
    $sql= "SELECT * FROM v5_users WHERE id=:id";
    $query = $pdo -> prepare($sql);
    $query->bindValue(':id',$id, PDO::PARAM_STR);
    $query -> execute();
    $users= $query -> fetch();


    if(!empty($users)) {
      $nom = $users['nom'];
      $prenom = $users['prenom'];
      $mail = $users['mail'];
    }

  }
  include('inc/header.php');
  include('inc/sidebar.php');
?>
<section class="content-header">
  <h1>
    Modification utilisateurs
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
         <li class="active">Modification utilisateurs</li>
  </ol>
</section>

<section class="content">
  <div class="box box-primary">
    <!-- /.box-header -->
    <!-- debut du formulaire -->
    <form action="" method="POST" role="form">
      <div class="box-body">
        <!-- input du nom -->
        <div class="form-group">
          <label for="nom">Nom</label>
          <input type="text" class="form-control" id="inputError" name="nom" placeholder="Nom..." value="<?php if(!empty($_POST['nom'])) { echo $_POST['nom']; } else { echo $nom; } ?>">
          <span class="error"><?php spanError($error,'nom');?></span>
        </div>
        <div class="form-group">
          <label for="prenom">Prenom</label>
          <input type="text" class="form-control" id="inputError" name="prenom" placeholder="Prenom..." value="<?php if(!empty($_POST['prenom'])) { echo $_POST['prenom']; } else { echo $prenom; } ?>">
          <span class="error"><?php spanError($error,'prenom');?></span>
        </div>
        <div class="form-group">
          <label for="mail">Email</label>
          <input type="mail" class="form-control" id="inputError" name="mail" placeholder="Email..." value="<?php if(!empty($_POST['mail'])) { echo $_POST['mail']; } else { echo $mail; } ?>">
          <span class="error"><?php spanError($error,'mail');?></span>
        </div>
        <div class="form-group">

          <label>Select</label>
          <select name ="role" class="form-control">
              <option>utilisateur</option>
              <option>administrateur</option>
        </select>


          </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">

        <input type="submit" name="submitted" class="btn btn-primary" value="Sauvegarder" >
      </div>
    </form>
  </div>



</section>





















</div>

<?php
  include('inc/footer.php');
?>
