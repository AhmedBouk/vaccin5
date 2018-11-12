<?php
include('../inc/pdo.php');
include('inc/fonctions.php');
include('inc/request.php');


$tableauUsers=requeteListeUser();


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
                  <th>Modifier</th>
                </tr>
                <?php foreach ($tableauUsers as $tableauUser) {
                    echo '<tr><td>'.$tableauUser['id']
                    .'</td><td>'
                    .$tableauUser['mail']
                    .'</td><td>'
                    .$tableauUser['nom']
                    .'</td><td>'
                    .$tableauUser['prenom']
                    .'</td><td>';
                    changementDate($tableauUser,'created_at');
                    echo '</td><td>';
                    changementDate($tableauUser,'updated_at');
                    echo '</td><td>'
                    .$tableauUser['role']
                    .'</td><td><a href="modification_utilisateurs.php?id='.$tableauUser['id'].'" class=".btn.btn-app"><i class="fa fa-edit"></i></a><td></tr>';
                } ?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

<?php
    include('inc/footer.php');
