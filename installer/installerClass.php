<?php
/**
 * Description of installerClass
 *
 * @author Danny Steven
 */
class installerClass {
  public function install() {
    if (isset($_GET['step']) !== true) {
      include_once 'view/index.html.php';
    } else {
      switch ($_GET['step']) {
        case 2:
          include_once 'view/dataBase.html.php';
          break;
        case 3:
          try {
            $dsn = $_POST['driver'] . ':dbname=' . $_POST['dbName'] . ';host=' . $_POST['host'] . ';port=' . $_POST['port'];
            $usuario = $_POST['dbUser'];
            $contrasena = $_POST['dbPass'];
            
            /**
             * Validaciones para la configuracion de base de datos
             */
//            if($_POST['host'] === '' or $_POST['host'] === NULL ){
//                $error_message = "Por favor ingrese el host";
//                throw new PDOException($error_message);
//            } else if(!ereg("^[a-zA-Z0-9\-_]{3,20}$",$_POST['host'])){
//                $error_message = "el campo no puede contener caracteres especiales";
//                throw new PDOException($error_message);
//            }else if($_POST['host'] !== 'localhost' or $_POST['host'] !== '127.0.0.1'){
//                $error_message = "el host es incorrecto";
//                throw new PDOException($error_message);
//            } else if($_POST['driver'] === '' or $_POST['driver'] === NULL ){
//                $error_message = "Seleccione un driver";
//                throw new PDOException($error_message);               
//            } else if($_POST['driver'] !== 'pgsql' or $_POST['driver'] !== 'mysql'){
//                $error_message = "el driver es incorrecto";
//                throw new PDOException($error_message);                
//            }else
//            if($_POST['port'] === '' or $_POST['port'] === NULL){
//                $error_message = "el campo puerto no puede estar vacio";
//                throw new PDOException($error_message);
//            }else if(!is_numeric($_POST['port'])){
//                $error_message = "el campo puerto debe ser numerico";
//                throw new PDOException($error_message);
//            }
//            
//            if($_POST['dbName'] === '' or $_POST['dbName'] === NULL){
//                $error_message = "Por favor digite el nombre de la Base de datos";
//                throw new PDOException($error_message);
//            }
//            
//
//            if(!is_numeric($_POST['host'])){
//                
//            }
//            
//            if($_POST['dbUser'] === '' or  $_POST['dbUser'] === NULL){
//                
//            }
//            if($_POST['dbPass'] === '' or $_POST['dbPass'] === NULL){
//                
//            }
            
            /**
             * Conexion a la Base de Datos
             */
            $gbd = new PDO($dsn, $usuario, $contrasena);
            

            $_SESSION['driver'] = $_POST['driver'];
            $_SESSION['host'] = $_POST['host'];
            $_SESSION['port'] = $_POST['port'];
            $_SESSION['dbUser'] = $_POST['dbUser'];
            $_SESSION['dbPass'] = $_POST['dbPass'];
            $_SESSION['dbName'] = $_POST['dbName'];
            
            include_once 'view/configuration.html.php';
          } catch (PDOException $exc) {
            $_GET['error'] = true;
            $_GET['error_message'] = $exc->getMessage();
            include_once 'view/dataBase.html.php';
          }
          break;
        case 4:
            try{
          $flag = true;
          
          /*
           * realizar las validaciones
           */
          
          if($flag === true) {
            $driver = $_SESSION['driver'];
            $host = $_SESSION['host'];
            $port = $_SESSION['port'];
            $dbUser = $_SESSION['dbUser'];
            $dbPass = $_SESSION['dbPass'];
            $dbName = $_SESSION['dbName'];
            $RowGrid = $_POST['RowGrid'];
            $PathAbsolute = $_POST['PathAbsolute'];
            $UrlBase = $_POST['UrlBase'];
            $Scope = $_POST['Scope'];
            $idioma = $_POST['idioma'];
            $FormatTimestamp = $_POST['FormatTimestamp'];
            $CookiePath = str_replace('httt:/', '', $UrlBase);
            $CookieDomain = $UrlBase ;
            $CookieTime = $_POST['CookieTime'];
            $archivo = $_FILES['file']['tmp_name'];
            
            include_once 'plantilla.php';
            
        /**
         * Validaciones para los datos
         */
                            if ($RowGrid < 0 or $RowGrid == '' or !isset($RowGrid) or !is_numeric($RowGrid)) {
                                $error_message = "El numero ingresado para la rejilla es incorrecto";
                                throw new Exception($error_message);
                            }

                            if (!file_exists($PathAbsolute) and $PathAbsolute !== '' ) {
                                $error_message = "La ruta del proyecto no existe";
                                throw new Exception($error_message);
                            }

                            if (!filter_var($UrlBase, FILTER_VALIDATE_URL)) {
                                $error_message = 'La direccion ingresada es incorrecta';
                                throw new Exception($error_message);
                            }

                            if ($Scope !== 'dev' and $Scope !== 'prod') {
                                $error_message = 'Se ha seleccionado un modo de instalacion incorrecto';
                                throw new Exception($error_message);
                            }

                            if ($idioma !== 'en' and $idioma !== 'es'){
                                $error_message = 'El idioma seleccionado no existe';
                                throw new Exception($error_message);
                            }
                            
                            
                            $fileType = pathinfo(basename($_FILES['file']['name']),PATHINFO_EXTENSION);
                            
                            if($fileType != 'sql'){
                                $error_message = 'La extension del archivo no es .sql';
                                throw new Exception($error_message);
                            }
         /**
          * Fin de las validaciones
          */
            
            
            
            
            
            
            
            
            $file = fopen('../config/config.php', 'w');
            fputs($file, $config);
            fclose($file);
            
            $dsn2 = $driver . ':dbname=' . $dbName . ';host=' . $host . ';port=' . $port;
            
            $gbd2 = new PDO($dsn2, $dbUser, $dbPass);
            $sql = file_get_contents($archivo);
            $gbd2->beginTransaction();
            $gbd2->exec($sql);
            $gbd2->commit();
            
            include_once 'view/felicidades.html.php';
            
          } else {
            include_once 'view/configuration.html.php';
          }
            }  catch (Exception $exc) {
                $_GET['error'] = TRUE;
                $_GET['error_message'] = $exc->getMessage();
                include_once 'view/configuration.html.php';
            }   
          break;
      }
    }
  }
}
