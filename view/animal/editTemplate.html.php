<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php $nombre = animalTableClass::NOMBRE ?>
<div class="container container-fluid">
    <div class="row">
       
<h1><?php echo i18n::__('edit')." "; echo i18n::__('animal')." ";echo $objAnimal[0]->$nombre?></h1>
<?php view::includePartial('animal/form',array('objAnimal'=> $objAnimal,'objRaza'=>$objRaza,'objEstado' => $objEstado))?>
    </div>
</div>
