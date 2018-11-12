<?php
include('inc/pdo.php');
include('inc/fonctions.php');


  $sql = "SELECT * FROM v5_users";

  $query= $pdo -> prepare($sql) ;
  $query-> execute();
  $tableauUsers = $query -> fetchall();



  include('inc/header.php');
  include('inc/sidebar.php');
?>
<section class="content-header">
  <h1>
    Listes des utilisateurs
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
         <li class="active">Listes des utilisateurs</li>
  </ol>
</section>

<div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Id</th> <!-- titre -->
                  <th>Email</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Created_at</th>
                  <th>Uptaded_at</th>
                  <th>Role</th>
                  <th>Status</th>
                </tr>
                <?php foreach ($tableauUsers as $tableauUser) {
                    echo '<tr><td>'.$tableauUser['id']
                    .'</td><td>'
                    .$tableauUser['mail']
                    .'</td><td>'
                    .$tableauUser['nom']
                    .'</td><td>'
                    .$tableauUser['prenom']
                    .'</td><td>'
                    .$tableauUser['created_at']
                    .'</td><td>';
                    if (!empty($tableauVaccin['updated_at'])) { //Création de la variable modifier pour la date de modif dans la BDD
                        $modifVaccin = date('d/m/Y', strtotime($tableauVaccin['updated_at']));
                    }else{
                        $modifVaccin = 'Il n\'a pas encore été modifié';
                    }
                    echo  $modifVaccin
                    .'</td><td>'
                    .$tableauUser['role']
                    .'</td><td><a href="modification_utilisateurs.php?id='.$tableauUser['id'].'" class=".btn.btn-app"><i class="fa fa-edit"></i></a><td></tr>';
                } ?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

<?php
    include('inc/footer.php');
