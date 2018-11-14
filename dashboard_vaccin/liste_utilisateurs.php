<?php
include('../inc/pdo.php');
include('../inc/fonctions.php');
include('inc/request.php');


require '../vendor/autoload.php';

use JasonGrimes\Paginator;

$nbreItem = compteUtilisateur();
$itemPerPage = 15;
$page = 1;
$offset = 0;
$urlPattern = '?page=(:num)';
$nomTable = 'v5_users';

if (!empty($_GET['page']) && is_numeric($_GET['page'])) {
    $page = $_GET['page'];
    $offset = $page * $itemPerPage - $itemPerPage;
}

$paginator = new Paginator($nbreItem, $itemPerPage, $page, $urlPattern);

$tableauUsers = requeteListe($nomTable,$offset,$itemPerPage);




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
            <div  class="box-body table-responsive no-padding">
              <table id="example2" class="table table-hover">
                <tr>
                  <th>Id</th> <!-- titre -->
                  <th>Email</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Created_at</th>
                  <th>Uptaded_at</th>
                  <th>Role</th>
                  <th>Modifier</th>
                  <th>Delete</th>
                </tr>
                <?php foreach ($tableauUsers as $tableauUser) {?>
                  <tr>
                      <td><?php echo $tableauUser['id'];?>
                  </td>
                  <td>
                        <?php echo $tableauUser['mail'];?>
                  </td>
                  <td>
                        <?php echo $tableauUser['nom'];?>
                  </td>
                  <td>
                          <?php echo $tableauUser['prenom'];?>
                  </td>
                  <td>
                        <?php changementDate($tableauUser,'created_at'); ?>
                  </td>
                    <td>
                          <?php changementDate($tableauUser,'updated_at'); ?>
                    </td>
                    <td>
                        <?php echo $tableauUser['role'];?>1
                    </td>
                    <td>
                      <a href="modification_utilisateurs.php?id=<?php echo $tableauUser['id'];?>" class=".btn.btn-app">
                        <i class="fa fa-edit"></i>
                      </a>
                    </td>
                    <td>
                      <a href="delete_user.php?id=<?php echo $tableauUser['id'];?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer?')">
                        <i class="fa fa-trash-o"></i>
                      </a>
                    </td>
                  </tr>
              <?php  } ?>
              </table>
            </div>
            <?php echo $paginator ?>
            <!-- /.box-body -->
          </div>
<?php
    include('inc/footer.php');
