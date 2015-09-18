<?php use mvc\routing\routingClass as routing?>
<?php use mvc\i18n\i18nClass as i18n?>
<?php use mvc\view\viewClass as view ?>
<div class="container container-fluid">
    <div class="row">
        <h1><i class="fa fa-ship"><?php echo i18n::__('new'). " "; echo i18n::__('ordenno')?></i></h1>
        <?php view::includePartial('ordenno/form',array('objTrabajador'=>$objTrabajador,'objAnimal' =>$objAnimal))?>
        </div>
</div>



