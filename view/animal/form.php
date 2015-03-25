<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n;?>
<?php $id = animalTableClass::ID ;?>
<?php $nombre= animalTableClass::NOMBRE;?>
<?php $genero = animalTableClass::GENERO?>
<?php $edad = animalTableClass::EDAD ?>
<?php $peso = animalTableClass::PESO?>
<?php $fecha_ingreso = animalTableClass::FECHA_INGRESO ?>
<?php $numero_partos = animalTableClass::NUMERO_PARTOS?>
<?php //$id_raza = animalTableClass::ID_RAZA ?>
<?php //$id_estado = animalTableClass::ID_ESTADO?>
<?php $id_raza = razaTableClass::ID?>
<?php $descripcionraza = razaTableClass::DESCRIPCION?>
<?php $id_estado = estadoTableClass::ID ?>
<?php $descripcionestado = estadoTableClass::DESCRIPCION?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('animal', ((isset($objAnimal)) ? 'update' : 'create' ))?>">
    <?php if (isset($objAnimal)== true):?>
    <input name="<?php echo animalTableClass::getNameField(animalTableClass::ID,TRUE)?>" value="<?php echo ((isset($objAnimal))? $objAnimal[0]->$id : $animal[$id]) ?>" type="hidden">
    <?php endif ?>
    <div class="form-group">
   <?php echo i18n::__('name')?>: <input class="form-control" type="text" value="<?php echo ((isset($objAnimal)) ? $objAnimal[0]->$nombre : ((isset($animal[$nombre]))? $animal[$nombre] : '') ) ?>" name="<?php echo animalTableClass::getNameField(animalTableClass::NOMBRE, true )?>">
   <?php echo i18n::__('gender')?>: <input class="form-control" type="text" value="<?php echo ((isset($objAnimal)) ? $objAnimal[0]->$genero : ((isset($animal[$genero])) ? $animal[$genero] : '') ) ?>" name="<?php echo animalTableClass::getNameField(animalTableClass::GENERO, true )?>">
   <?php echo i18n::__('age')?>: <input class="form-control" type="text" value="<?php echo ((isset($objAnimal)) ? $objAnimal[0]->$edad : ((isset($animal[$edad]))? $animal[$edad] : '' ) ) ?>" name="<?php echo animalTableClass::getNameField(animalTableClass::EDAD, true )?>">
   <?php echo i18n::__('weight')?>: <input class="form-control" type="text" value="<?php echo ((isset($objAnimal)) ? $objAnimal[0]->$peso : ((isset($animal[$peso])) ? $animal[$peso] : '') ) ?>" name="<?php echo animalTableClass::getNameField(animalTableClass::PESO, true )?>">
   <?php echo i18n::__('date_entry')?>: <input class="form-control" type="date" value="<?php echo ((isset($objAnimal)) ? $objAnimal[0]->$fecha_ingreso : ((isset($animal[$fecha_parto]))? $animal[$fecha_parto] : '' ) ) ?>" name="<?php echo animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, true )?>">
   <?php echo i18n::__('number_births')?>: <input class="form-control" type="text" value="<?php echo ((isset($objAnimal)) ? $objAnimal[0]->$numero_partos : ((isset($animal[$numero_partos]))? $animal[$numero_partos] : '') ) ?>" name="<?php echo animalTableClass::getNameField(animalTableClass::NUMERO_PARTOS, true )?>">
   <?php echo i18n::__('breed') ?>: 
   <select class="form-control" id="<?php animalTableClass::getNameField(animalTableClass::ID_RAZA, TRUE)?>" name="<?php echo animalTableClass::getNameField(animalTableClass::ID_RAZA, TRUE);?>">
       <option>Seleccione la raza</option>
       <?php foreach($objRaza as $raza):?>
       <option value="<?php echo $raza->id?>"><?php echo $raza->$descripcionraza?></option>
       <?php endforeach;?>
   </select>
   <?php echo i18n::__('status')?>
   <select class="form-control" id="<?php animalTableClass::getNameField(animalTableClass::ID_ESTADO, TRUE)?>" name="<?php echo animalTableClass::getNameField(animalTableClass::ID_ESTADO, TRUE);?>">
       <option>Seleccione el estado</option>
       <?php foreach($objEstado as $estado):?>
       <option value="<?php echo $estado->id?>"><?php echo $estado->$descripcionestado?></option>
       <?php endforeach;?>
   </select>
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objAnimal) ? 'update': 'register'))?>">
    </div>
</form>

