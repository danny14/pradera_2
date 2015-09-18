<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php $nombre = animalTableClass::NOMBRE ?>
<?php view::includePartial('animal/menuPrincipal')?>
<?php view::includePartial('animal/formTraductor')?>
<div class="container container-fluid">
    <div class="row">
    
        <h1><i class="fa fa-bug"><?php echo i18n::__('edit')." "; echo i18n::__('animal')." ";echo $objAnimal[0]->$nombre?></i></h1>
<?php view::includePartial('animal/form',array('objAnimal'=> $objAnimal,'objRaza'=>$objRaza,'objEstado' => $objEstado))?>
    </div>
</div>
