<?php
//$db = fopen('var/www/html/pradera_2/config/config.php', "r");
$dbHost = "Hola mundo";
$db = fopen('C:\xampp\htdocs\xampp\pradera_2\config\config.php', "r+");
//fputs($db, "config::setDbHost('".$dbHost."');");
$linea = '' ;

while (!feof($db)){
    $linea = fgets($db);
    echo $linea ."<BR />";
//    if(fgets($db) == 3){
//      
//    }

}
fclose($db);


//use mvc\interfaces\controllerActionInterface;
//use mvc\controller\controllerClass;
//use mvc\config\configClass as config;
//use mvc\request\requestClass as request;
//use mvc\routing\routingClass as routing;
//use mvc\session\sessionClass as session;
//use mvc\i18n\i18nClass as i18n;
//
//class indexActionClass extends controllerClass implements controllerActionInterface{
//    public function execute() {
//        try {
//            
//            $files = request::getInstance()->getPost($param);
//            $this->defineView('index', 'config',  session::getInstance()->getFormatOutput());
//        } catch (PDOException $exc) {
//            echo $exc->getMessage();
//            echo "<br>";
//            echo $exc->getTraceAsString();
//            
//        }
//    }
//}

