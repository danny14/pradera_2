<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php $nombre = proveedorTableClass::NOMBRE?>
<div class="container container-fluid">
    <div class="row">
<h1><?php echo i18n::__('edit')." "; echo i18n::__('provider'); echo $objProveedor[0]->$nombre?></h1>
<?php view::includePartial('proveedor/form',array( 'objProveedor' => $objProveedor))?>
    </div>
</div>