<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php view::includePartial('animal/menuPrincipal')?>
<?php view::includePartial('animal/formTraductor')?>
<div class="container container-fluid">
    <div class="row">
<h1><?php echo i18n::__('new')." "; echo i18n::__('report')?></h1>
<?php if(isset($objRaza)):?>
    <?php view::includePartial('reportes/form',array('reporteId' => $reporteId,'objRaza'=>$objRaza))?>
<?php endif;?>
    <?php view::includePartial('reportes/form',array('reporteId' => $reporteId))?>
    </div>
</div>