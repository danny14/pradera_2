<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php $descripcion = razaTableClass::DESCRIPCION ?>
<?php view::includePartial('animal/menuPrincipal')?>
<div class="container container-fluid">
    <div class="row">
        <h1><i class="fa fa-paw"><?php echo i18n::__('edit')." "; echo i18n::__('breed')." ";echo $objRaza[0]->$descripcion?></i></h1>
<?php view::includePartial('raza/form',array('objRaza'=> $objRaza))?> 
    </div>
</div>
