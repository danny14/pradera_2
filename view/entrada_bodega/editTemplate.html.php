<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<div class="container container-fluid">
    <div class="row">
<h1><?php echo i18n::__('edit')." "; echo i18n::__('entrance_cellar')?></h1>
<?php view::includePartial('entrada_bodega/form',array('objEntradaBodega'=> $objEntradaBodega))?>
    </div>
</div>
