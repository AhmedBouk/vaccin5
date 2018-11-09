<?php
  include('inc/header.php');
  include('inc/sidebar.php');
?>
<section class="content-header">
  <h1>
    Tables
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
         <li class="active">Tables</li>
  </ol>
</section>

<div class="box">
            <div class="box-header">
              <h3 class="box-title">Responsive Hover Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Id</th> <!-- titre -->
                  <th>Nom</th>
                  <th>Obligatoire</th>
                  <th>Rappel du vaccin</th>
                  <th>Created_at</th>
                  <th>Uptaded_at</th>
                </tr>
                <tr>
                  <td>183</td>
                  <td>John Doe</td>
                  <td><span class="label label-success">Non obligatoire</span></td>
                  <td>11-7-2014</td>
                  <td>John Doe</td>
                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                </tr>

                <tr>
                  <td>175</td>
                  <td>Mike Doe</td>
                  <td><span class="label label-danger">Obligatoire</span></td>
                  <td>Mike Doe</td>
                  <td>11-7-2014</td>
                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

          <?php
            include('inc/footer.php');
          ?>
