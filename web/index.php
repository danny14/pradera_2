<?php

// genera copia de seguridad
// shell_exec('"C:\Program Files\PostgreSQL\9.4\bin\pg_dump.exe" -i -h localhost -p 5432 -U postgres -F c -b -f "C:\copia\desdePHP.backup" pradera_2');

// restaura
// shell_exec('"C:\Program Files\PostgreSQL\9.4\bin\pg_restore.exe" --host localhost --port 5432 --username "postgres" --dbname "desdephp" --no-password "C:\copia\desdePHP.backup"');

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

