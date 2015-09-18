<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php $nombre = credencialTableClass::NOMBRE ?>
<?php view::includePartial('animal/menuPrincipal')?>
<?php view::includePartial('animal/formTraductor')?>
<div class="container container-fluid">
    <div class="row">
        <h1><i class="fa fa-tags"><?php echo i18n::__('edit')." "; echo i18n::__('credential')." ";echo $objCredencial[0]->$nombre?></i></h1>
<?php view::includePartial('credencial/form',array('objCredencial'=> $objCredencial))?> 
    </div>
</div>
