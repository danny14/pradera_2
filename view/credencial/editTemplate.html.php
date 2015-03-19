<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php $nombre = credencialTableClass::NOMBRE ?>
<div class="container container-fluid">
    <div class="row">
<h1><?php echo i18n::__('edit')." "; echo i18n::__('credencial')." ";echo $objCredencial[0]->$nombre?></h1>
<?php view::includePartial('credencial/form',array('objCredencial'=> $objCredencial,'nombre'=>$nombre))?>
    </div>
</div>
