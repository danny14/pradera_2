<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php $id = entradaBodegaTableClass::ID ?>
<?php view::includePartial('animal/menuPrincipal')?>
<?php view::includePartial('animal/formTraductor')?>
<div class="container container-fluid">
    <div class="row">
    
        <h1><i class="fa fa-truck"><?php echo i18n::__('edit')." "; echo i18n::__('entry_cellar')." ";echo $objEntradaBodega[0]->$id?></i></h1>
<?php view::includeHandlerMessage() ?>
<?php view::includePartial('entrada_bodega/form',array('objEntradaBodega' => $objEntradaBodega,'objTrabajador'=> $objTrabajador,'objProveedor'=>$objProveedor))?>
    </div>
</div>
