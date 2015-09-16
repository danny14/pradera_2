<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php view::includePartial('animal/menuPrincipal')?>
<?php view::includePartial('animal/formTraductor')?>
<?php $descripcion = estadoTableClass::DESCRIPCION ;?>
<div class="container container-fluid">
    <div class="row">
        <h1><i class="fa fa-lightbulb-o"><?php echo i18n::__('edit')." "; echo i18n::__('status')." "; echo $objEstado[0]->$descripcion ?></i></h1>
<?php view::includePartial('estado/form',array('objEstado' => $objEstado,'descripcion' => $descripcion))?>
    </div>
</div>