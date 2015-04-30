<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../../css/installer.css">
    <script src="../../js/jquery-1.11.1.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
  </head>
  <body><br><br><br><br>
      <div class="container container-fluid">
          <div class="row">
              <div class="page-header text-center">
              <h1>Requisitos del sistema</h1>
              </div>
      <table class="table table-responsive table-bordered table-striped table-hover"> 
        <tr>
            <th>Extensiones Necesarias</th>
            <th>Extension Instalada</th>
            <th>Si</th>
            <th>No</th>
        </tr>
        <tr>
            <td>PHP 5.4 o Superior</td>
            <td><?php echo PHP_VERSION?></td>
            <td><?php echo ((PHP_VERSION > 5.4) ? '<i class="glyphicon glyphicon-ok"></i>' : '') ?></td>
            <td><?php echo ((PHP_VERSION > 5.4) ? '' : '<i class="glyphicon glyphicon-remove"></i>') ?></i></td>
            
        </tr>
        <tr>
            <td>JSON</td>
            <td><?php echo get_loaded_extensions()[array_search('json', get_loaded_extensions())] ?></td>
            <?php if (get_loaded_extensions()[array_search('json', get_loaded_extensions())] === 'json') : ?>
            <td><i class="glyphicon glyphicon-ok"></i></td>
            <td></td>
            <?php else : ?>
            <td></td>
            <td><i class="glyphicon glyphicon-remove"></i></td>
            <?php endif ?>
        </tr>
        <tr>
            <td>PDO</td>
            <td><?php echo get_loaded_extensions()[array_search('PDO', get_loaded_extensions())] ?></td>
            <?php if(get_loaded_extensions()[array_search('PDO', get_loaded_extensions())] === 'PDO') : ?>
            <td><i class="glyphicon glyphicon-ok"></i></td>
            <td></td>
            <?php else : ?>
            <td></td>
            <td><i class="glyphicon glyphicon-remove"></i></td>
            <?php endif;?>
        </tr>
        <tr>
            <td>PDO_PGSQL</td>
            <td><?php echo get_loaded_extensions()[array_search('pdo_pgsql', get_loaded_extensions())] ?></td>
            <?php if(get_loaded_extensions()[array_search('pdo_pgsql', get_loaded_extensions())] === 'pdo_pgsql') : ?>
            <td><i class="glyphicon glyphicon-ok"></i></td>
            <td></td>
            <?php else : ?>
            <td></td>
            <td><i class="glyphicon glyphicon-remove"></i></td>
            <?php endif;?>
        </tr>
        <tr>
            <td>PDO_MYSQL</td>
            <td><?php echo get_loaded_extensions()[array_search('pdo_mysql', get_loaded_extensions())] ?></td>
            <?php if(get_loaded_extensions()[array_search('pdo_mysql', get_loaded_extensions())] === 'pdo_mysql') : ?>
            <td><i class="glyphicon glyphicon-ok"></i></td>
            <td></td>
            <?php else : ?>
            <td></td>
            <td><i class="glyphicon glyphicon-remove"></i></td>
            <?php endif;?>
        </tr>
    </table>
              <a class="btn btn-success btn-xs" href="index.php?step=2" >Siguiente</a>
          </div>
      </div>
  </body>
</html>
