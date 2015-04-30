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
          <div class="page page-header text-center">
              <h1>Configuracion de Servicio</h1>
          </div>
      <form action="index.php?step=4" method="POST" enctype="multipart/form-data">
          
        <div class="form-group form-group-lg form-group-sm">
             <input class="form-control" type="text" name="RowGrid" placeholder="Numero de lineas por regilla"><br>
        </div>
        
        <div class="form-group form-group-lg form-group-sm">
            <input class="form-control" type="text" name="PathAbsolute" placeholder="Dirección en servidor de la carpeta raíz"><br>
        </div>
        
        <div class="form-group form-group-lg form-group-sm">
            <input class="form-control" type="text" name="UrlBase" placeholder="Dirección de la web"><br>
        </div>
        
        <div class="form-group form-group-lg form-group-sm">
        <select name="Scope" class="form-control">
        <option value="">Seleccione modo de instalación</option>
        <option value="dev">Desarrollo</option>
        <option value="prod">Producción</option>
      </select><br>
        </div>
        
        <div class="form-group form-group-lg form-group-sm">
            <select name="idioma" class="form-control">
        <option value="">Seleccione idioma</option>
        <option value="es">Español</option>
        <option value="en">English</option>
      </select><br>
        </div>
        
        <div class="form-group form-group-lg form-group-sm">
            <input class="form-control" type="text" name="FormatTimestamp" value="Y-m-d H:i:s" placeholder="Formato de fecha y hora"><br>
        </div>
          
          <div class="form-group form-group-lg form-group-sm">
              <input class="form-control" type="text" name="CookieTime" placeholder="Ingrese el tiempo de duracion de la cookie por hora">
          </div>
          
          <div class="form-group">
              <input class="btn btn-info" type="file" name="file" placeholder="Subir Archivo">
          </div>
        
        <div class="form-group form-group-lg form-group-sm">
            <a class="btn btn-info" href="index.html.php?step=2">Volver</a>
            <input class="btn btn-success" type="submit" value="Instalar">
        </div>
        
    </form>
      </div>
  </body>
</html>