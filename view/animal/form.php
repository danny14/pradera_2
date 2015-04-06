<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n;?>
<?php use mvc\session\sessionClass as session; ?>
<?php use mvc\request\requestClass as request;?>
<?php $id = animalTableClass::ID ;?>
<?php $nombre= animalTableClass::NOMBRE;?>
<?php $genero = animalTableClass::GENERO;?>
<?php $edad = animalTableClass::EDAD ;?>
<?php $peso = animalTableClass::PESO?>
<?php $fecha_ingreso = animalTableClass::FECHA_INGRESO; ?>
<?php $numero_partos = animalTableClass::NUMERO_PARTOS;?>
<?php $id_raza_a = animalTableClass::ID_RAZA; ?>
<?php $id_estado_a = animalTableClass::ID_ESTADO;?>
<?php $id_raza = razaTableClass::ID;?>
<?php $descripcionraza = razaTableClass::DESCRIPCION;?>
<?php $id_estado = estadoTableClass::ID; ?>
<?php $descripcionestado = estadoTableClass::DESCRIPCION;?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('animal', ((isset($objAnimal)) ? 'update' : 'create' ))?>">
    <?php if (isset($objAnimal)== true):?>
    <input name="<?php echo animalTableClass::getNameField(animalTableClass::ID,TRUE)?>" value="<?php echo $objAnimal[0]->$id ?>" type="hidden">
    <?php endif ?>
    
   <div class="form-group <?php echo (session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE)) === TRUE) ?  'has-error has-feedback' : '' ; ?>">
   <label class="control-label" for="name"><?php echo i18n::__('name')?>: </label>
   <input class="form-control" type="text" value="<?php echo ((isset($objAnimal)) ? $objAnimal[0]->$nombre : ((session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE)) === TRUE) ?  request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE)) : '' ) ) ?>" name="<?php echo animalTableClass::getNameField(animalTableClass::NOMBRE, true )?>">
   <?php  if (session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
   </div>
   <?php// echo (session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE)) === TRUE) ?  request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE)) : '' ; ?>
    
    <div class="form-group <?php //echo ((isset($animal[$genero])) ? 'has-error has-feedback' : '') ?>">
    <label class="control-label" for="gender"><?php echo i18n::__('gender')?>:</label>
    <input class="form-control" type="text" value="<?php echo ((isset($objAnimal)) ? $objAnimal[0]->$genero :  '') ?>" name="<?php echo animalTableClass::getNameField(animalTableClass::GENERO, true )?>">
    <?php if (isset($animal[$genero])):?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
    </div>
    
    <div class="form-group <?php // echo ((isset($animal[$edad])) ? 'has-error has-feedback' : '') ?>">
    <label class="control-label" for="age"><?php echo i18n::__('age')?>: </label>
    <input class="form-control" type="text" value="<?php echo ((isset($objAnimal)) ? $objAnimal[0]->$edad : '' )  ?>" name="<?php echo animalTableClass::getNameField(animalTableClass::EDAD, true )?>">
    <?php //if (isset($animal[$edad])):?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php// endif ?>
    </div>
    
    <div class="form-group <?php// echo ((isset($animal[$peso])) ? 'has-error has-feedback' : '') ?>">
        <label class="control-label" for="weight"><?php echo i18n::__('weight')?>: </label>
   <input class="form-control" type="text" value="<?php echo ((isset($objAnimal)) ? $objAnimal[0]->$peso : '')  ?>" name="<?php echo animalTableClass::getNameField(animalTableClass::PESO, true )?>">
   <?php //if (isset($animal[$peso])):?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php // endif ?>
   </div>
    
    <div class="form-group <?php // echo ((isset($animal[$fecha_ingreso])) ? 'has-error has-feedback' : '') ?>">
        <label class="control-label" for="date_entry"><?php echo i18n::__('date_entry')?>:</label> 
   <input class="form-control" type="date" value="<?php echo ((isset($objAnimal)) ? $objAnimal[0]->$fecha_ingreso : '' )  ?>" name="<?php echo animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, true )?>">
   <?php //if (isset($animal[$fecha_ingreso])):?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php //endif ?>
    </div>
    
    <div class="form-group <?php //echo ((isset($animal[$numero_partos])) ? 'has-error has-feedback' : '') ?>">
        <label class="control-label" for="number_births"><?php echo i18n::__('number_births')?>: </label>
   <input class="form-control" type="text" value="<?php echo ((isset($objAnimal)) ? $objAnimal[0]->$numero_partos : '') ?>" name="<?php echo animalTableClass::getNameField(animalTableClass::NUMERO_PARTOS, true )?>">
   <?php //if (isset($animal[$numero_partos])):?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php //endif ?>
    </div>
    
    <div class="form-group <?php// echo ((isset($animal[$id_raza])) ? 'has-error has-feedback' : '') ?>">
        <label class="control-label" for="breed"><?php echo i18n::__('breed') ?>:</label> 
   <select class="form-control" id="<?php animalTableClass::getNameField(animalTableClass::ID_RAZA, TRUE)?>" name="<?php echo animalTableClass::getNameField(animalTableClass::ID_RAZA, TRUE);?>">
       <option>Seleccione la raza</option>
       <?php foreach($objRaza as $raza):?>
       <option <?php echo (isset($objAnimal[0]->$id_raza_a) === true and $objAnimal[0]->$id_raza_a == $raza->$id_raza) ? 'selected' : ''?> value="<?php echo $raza->$id_raza?>"><?php echo $raza->$descripcionraza?></option>
       <?php endforeach;?>
   </select>
   <?php //if (isset($animal[$id_raza])):?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php //endif ?>
   </div>
    
    <div class="form-group <?php // echo ((isset($animal[$id_estado])) ? 'has-error has-feedback' : '') ?>">
        <label class="control-label" for="status"><?php echo i18n::__('status')?></label>
   <select class="form-control" id="<?php animalTableClass::getNameField(animalTableClass::ID_ESTADO, TRUE)?>" name="<?php echo animalTableClass::getNameField(animalTableClass::ID_ESTADO, TRUE);?>">
       <option>Seleccione el estado</option>
       <?php foreach($objEstado as $estado):?>
       <option <?php echo (isset($objAnimal[0]->$id_estado_a) === true and $objAnimal[0]->$id_estado_a == $estado->$id_estado) ? 'selected' : '' ?> value="<?php echo $estado->$id_estado?>"><?php echo $estado->$descripcionestado?></option>
       <?php endforeach;?>
   </select>
        <?php // if (isset($animal[$id_estado])):?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php // endif ?>
    </div>
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objAnimal) ? 'update': 'register'))?>">
   <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'index')?>"><i class="glyphicon glyphicon-arrow-left"> </i> <?php echo i18n::__('return')?></a>
    </div>
</form>

