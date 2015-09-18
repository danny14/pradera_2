<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php view::includePartial('animal/menuPrincipal')?>
<?php view::includePartial('animal/formTraductor')?>
<div class="container container-fluid">
    <div class="row">
        <h1><i class="fa fa-paw"><?php echo i18n::__('new')." "; echo i18n::__('breed')?></i></h1>
<?php view::includePartial('raza/form')?>
    </div>
</div>