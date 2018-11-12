<?php
include('../inc/pdo.php');
include('../inc/fonctions.php');
include('inc/request.php');
is_logged();
if (is_admin()){

}else {
  header("Location: ../403.php");
}

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
                  <th>Delete</th>
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
                    .'</td><td><a href="modification_utilisateurs.php?id='.$tableauUser['id'].'" class=".btn.btn-app"><i class="fa fa-edit"></i></a></td><td><a href="delete_user.php?id='
                    .$tableauUser['id']
                    .'"><i class="fa fa-trash-o"></i></a><td></tr>';
                } ?>
              </table>
              <div class="col-sm-7">
                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                  <ul class="pagination">
                    <li class="paginate_button previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0">Previous</a>
                    </li>

                    <li class="paginate_button active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0">1</a></li>

                    <li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0">3</a></li>

                    <li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0">5</a></li>

                    <li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0">6</a></li>

                    <li class="paginate_button next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0">Next</a></li>
                    </ul>
                  </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
<?php
    include('inc/footer.php');
