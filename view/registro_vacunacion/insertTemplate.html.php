<?php use mvc\routing\routingClass as routing?>
<?php use mvc\i18n\i18nClass as i18n?>
<?php use mvc\view\viewClass as view ?>
<div class="container container-fluid">
    <div class="row">
        <h1><?php echo i18n::__('new'). " "; echo i18n::__('register_vacunacion')?></h1>
        <?php view::includeHandlerMessage()?>
        <?php view::includePartial('registro_vacunacion/form',array('objTrabajador'=>$objTrabajador,'objAnimal'=>$objAnimal,'objInsumo'=>$objInsumo))?>
        </div>
</div>


