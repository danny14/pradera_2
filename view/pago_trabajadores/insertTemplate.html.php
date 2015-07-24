<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<div class="container container-fluid">
    <div class="row">
<h1><?php echo i18n::__('new')." "; echo i18n::__('pago_trabajadores')?></h1>
<?php view::includeHandlerMessage()?>
<?php view::includePartial('pago_trabajadores/form',array('objTrabajador' => $objTrabajador))?>
    </div>
</div>