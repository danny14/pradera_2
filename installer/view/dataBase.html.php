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
  <body>
      <div class="container container-fluid">
      <div class="page-header text-center">
          <h1> Configuracion de la BASE de DATOS</h1>
      </div>
    <?php if(isset($_GET['error']) and $_GET['error'] === true): ?>
    Ocurrio un error
    <?php endif ?>
    <form action="index.php?step=3" method="POST">
        
        <div class="form-group">
        <input class="form-control" value="<?php echo (isset($_POST['host'])) ? $_POST['host'] : '' ?>" type="text" name="host" placeholder="Inserte el host de la base de datos ej (localhost/127.0.0.1)" required><br>
        </div>
        
        <div class="form-group">
            <select name="driver" required class="form-control">
        <option value="">Seleccione un controlador</option>
        <option value="pgsql" <?php echo (isset($_POST['driver']) and $_POST['driver'] === 'pgsql') ? 'selected' : '' ?>>PostgreSQL</option>
        <option value="mysql" <?php echo (isset($_POST['driver']) and $_POST['driver'] === 'mysql') ? 'selected' : '' ?>>MySQL</option>
      </select><br>
        </div>
        
        <div class="form-group">
      <input class="form-control" type="text" name="port" placeholder="Digite el puerto ej: (5432 para Postgres o 3306 para MYSQL)" required><br>
        </div>
        
        <div class="form-group">
      <input class="form-control" type="text" name="dbName" placeholder="Nombre de la base de datos" required><br>
        </div>
        
        <div class="form-group">
      <input class="form-control" type="text" name="dbUser" placeholder="Usuario de la base de datos" required><br>
        </div>
        
        <div class="form-group">
      <input class="form-control" type="password" name="dbPass" placeholder="Contraseña de la base de datos" required><br>
        </div>
        
        <div class="form-group">
      <a href="index.html.php" class="btn btn-info">Volver</a>
      <input class="btn btn-success"  type="submit" value="Continuar">
        </div>
        
    </form>
    <?php if(isset($_GET['error']) and $_GET['error'] === true): ?>
    <?php echo $_GET['error_message'] ?>
    <?php endif ?>
      </div>
  </body>
</html>