<?php

/*
$fechaCreacion = '03/11/2015';
$fechaVencimiento = '05/01/2015';

if (strtotime($fechaCreacion) < strtotime($fechaVencimiento)) echo 'OK';

echo '<br>';
echo strtotime($fechaCreacion);
echo '<br>';
echo strtotime($fechaVencimiento);
exit();
*/

$GLOBALS['timeIni'] = microtime(true);
session_name('mvcSite');
session_start();
ob_start();
if(is_file('../config/config.php') !== TRUE ){
  include_once '../installer/installerClass.php';
  $installer = new installerClass();
  $installer->install();
}else{
include_once __DIR__ . '/../libs/vendor/autoLoadClass.php';
mvc\autoload\autoLoadClass::getInstance()->autoLoad();
mvc\dispatch\dispatchClass::getInstance()->main();
}

