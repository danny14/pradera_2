<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n;?>
<?php use mvc\session\sessionClass as session; ?>
<?php use mvc\request\requestClass as request;?>
<?php use mvc\view\viewClass as view; ?>
<?php $id = animalTableClass::ID ;?>
<?php $nombre= animalTableClass::NOMBRE;?>
<?php $genero = animalTableClass::GENERO;?>
<?php $peso = animalTableClass::PESO?>
<?php $fecha_ingreso = animalTableClass::FECHA_INGRESO; ?>
<?php $numero_partos = animalTableClass::NUMERO_PARTOS;?>
<?php $id_raza_a = animalTableClass::ID_RAZA; ?>
<?php $id_estado_a = animalTableClass::ID_ESTADO;?>
<?php $id_raza = razaTableClass::ID;?>
<?php $descripcionraza = razaTableClass::DESCRIPCION;?>
<?php $id_estado = estadoTableClass::ID; ?>
<?php $descripcionestado = estadoTableClass::DESCRIPCION;?>
<form method="POST" class="form-horizontal" action="<?php echo routing::getInstance()->getUrlWeb('animal', ((isset($objAnimal)) ? 'update' : 'create' ))?>">
    <?php if (isset($objAnimal)== true):?>
    <input name="<?php echo animalTableClass::getNameField(animalTableClass::ID,TRUE)?>" value="<?php echo $objAnimal[0]->$id ?>" type="hidden">
    <?php endif ?>

    <!-- se inclule el mensaje de error puntual -->
    <?php view::getMessageError('errorNombre') ?>
    <!-- FIN-->
   <div class="form-group <?php echo (session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE)) === TRUE) ?  'has-error has-feedback' : '' ; ?>">
   <label class="control-label" for="name"><?php echo i18n::__('name')?>: </label>
   <input class="form-control" type="text" value="<?php echo ((isset($objAnimal)) ? $objAnimal[0]->$nombre : ((session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE)) === TRUE) ?  '' :  (request::getInstance()->hasPost(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE))) ? request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE))  : '' ) ) ?>" name="<?php echo animalTableClass::getNameField(animalTableClass::NOMBRE, true )?>" maxlength="80" required placeholder="<?php echo i18n::__('enterName')?>" />
   <?php  if (session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
   </div>
    <!--
   <? php// echo (session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE)) === TRUE) ?  request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE)) : '' ; ?>
   -->
    <!-- se inclule el mensaje de error puntual -->
    <?php view::getMessageError('errorGenero') ?>
    <!-- FIN-->
   <div class="form-group">
   <label class="control-label" for="gender"><?php echo i18n::__('gender') ?>:</label> 
   <select class="form-control" id="<?php echo animalTableClass::getNameField(animalTableClass::GENERO, true )?>" name="<?php echo animalTableClass::getNameField(animalTableClass::GENERO, true )?>" required />
   <option><?php echo i18n::__('selectGender')?></option>
   <option value="F" <?php echo (isset($objAnimal) and $objAnimal[0]->$genero === "F") ? 'selected' : ((session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::GENERO, TRUE)) === TRUE) ? '' : (request::getInstance()->hasPost(animalTableClass::getNameField(animalTableClass::GENERO, TRUE)) and request::getInstance()->getPost(animalTableClass::getNameField(animalBaseTableClass::GENERO, TRUE)) === 'F') ? 'selected' : '') ?> ><?php echo i18n::__('female')?></option>
   <option value="M" <?php echo (isset($objAnimal) and $objAnimal[0]->$genero === "M") ? 'selected' : ((session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::GENERO, TRUE)) === TRUE) ? '' : (request::getInstance()->hasPost(animalTableClass::getNameField(animalTableClass::GENERO, TRUE)) and request::getInstance()->getPost(animalTableClass::getNameField(animalBaseTableClass::GENERO, TRUE)) === 'M') ? 'selected' : '')?> ><?php echo i18n::__('male')?></option>
   </select>
   </div>

    <!-- se inclule el mensaje de error puntual -->
    <?php view::getMessageError('errorPeso') ?>
    <!-- FIN-->
    <div class="form-group <?php echo (session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::PESO, TRUE)) === TRUE) ?  'has-error has-feedback' : '' ; ?>">
        <label class="control-label" for="weight"><?php echo i18n::__('weight')?>: </label>
        <div class="input-group">
        <span class="input-group-addon" id="kg">.Kg</span>
        <input class="form-control" type="number" value="<?php echo ((isset($objAnimal)) ? $objAnimal[0]->$peso : ((session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::PESO, TRUE)) === TRUE) ?  request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::PESO, TRUE)) : (request::getInstance()->hasPost(animalTableClass::getNameField(animalTableClass::PESO, TRUE))) ? request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::PESO, TRUE)) : '' ))  ?>" name="<?php echo animalTableClass::getNameField(animalTableClass::PESO, true )?>" required placeholder="<?php echo i18n::__('enterWeight')?>">
        <span class="input-group-addon" id="kg">.Kg</span>
        </div>
   <?php  if (session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::PESO, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
   </div>

    <!-- se inclule el mensaje de error puntual -->
    <?php view::getMessageError('errorFechaIngreso') ?>
    <!-- FIN-->
    <div class="form-group <?php echo (session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, TRUE)) === TRUE) ?  'has-error has-feedback' : '' ; ?>"">
        <label class="control-label" for="date_entry"><?php echo i18n::__('date_entry')?>:</label> 
        <input class="form-control" type="date" value="<?php echo ((isset($objAnimal)) ? $objAnimal[0]->$fecha_ingreso : ((session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, TRUE)) === TRUE) ?  request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, TRUE)) : (request::getInstance()->hasPost(animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, TRUE))) ? request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, TRUE)) : '' ) )  ?>" name="<?php echo animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, true )?>"  required />
   <?php  if (session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
    </div>

    <!-- se inclule el mensaje de error puntual -->
    <?php view::getMessageError('errorNumeroPartos') ?>
    <!-- FIN-->
    <div class="form-group <?php echo (session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::NUMERO_PARTOS, TRUE)) === TRUE) ?  'has-error has-feedback' : '' ; ?>"">
        <label class="control-label" for="number_births"><?php echo i18n::__('number_births')?>: </label>
        <input class="form-control" type="number" value="<?php echo ((isset($objAnimal)) ? $objAnimal[0]->$numero_partos : ((session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::NUMERO_PARTOS, TRUE)) === TRUE) ?  '' : (request::getInstance()->hasPost(animalTableClass::getNameField(animalTableClass::NUMERO_PARTOS, TRUE))) ? request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::NUMERO_PARTOS, TRUE)) : '' )) ?>" name="<?php echo animalTableClass::getNameField(animalTableClass::NUMERO_PARTOS, true )?>" min="0" max="99"  required placeholder="<?php echo i18n::__('enterNumberBirths')?>"/>
   <?php  if (session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::NUMERO_PARTOS, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
    </div>

    <!-- se inclule el mensaje de error puntual -->
    <?php view::getMessageError('errorRaza') ?>
    <!-- FIN-->
    <div class="form-group <?php// echo ((isset($animal[$id _raza])) ? 'has-error has-feedback' : '') ?>">
        <label class="control-label" for="breed"><?php echo i18n::__('breed') ?>:</label> 
   <select class="form-control" id="<?php animalTableClass::getNameField(animalTableClass::ID_RAZA, TRUE)?>" name="<?php echo animalTableClass::getNameField(animalTableClass::ID_RAZA, TRUE);?>" required />
   <option><?php echo i18n::__('selectRaza')?></option>
       <?php foreach($objRaza as $raza):?>
       <option <?php echo (isset($objAnimal[0]->$id_raza_a) === true and $objAnimal[0]->$id_raza_a == $raza->$id_raza) ? 'selected' : ((session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::ID_RAZA, TRUE)) === TRUE) ? '' : (request::getInstance()->hasPost(animalTableClass::getNameField(animalTableClass::ID_RAZA, TRUE)) and request::getInstance()->getPost(animalTableClass::getNameField(animalBaseTableClass::ID_RAZA, TRUE)) == $raza->$id_raza) ? 'selected' : '' )?> value="<?php echo $raza->$id_raza?>"><?php echo $raza->$descripcionraza?></option>
       <?php endforeach;?>
   </select>
   <?php //if (isset($animal[$id_raza])):?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php //endif ?>
   </div>

    <!-- se inclule el mensaje de error puntual -->
    <?php view::getMessageError('errorEstado') ?>
    <!-- FIN-->    
    <div class="form-group <?php // echo ((isset($animal[$id_estado])) ? 'has-error has-feedback' : '') ?>">
        <label class="control-label" for="status"><?php echo i18n::__('status')?></label>
   <select class="form-control" id="<?php animalTableClass::getNameField(animalTableClass::ID_ESTADO, TRUE)?>" name="<?php echo animalTableClass::getNameField(animalTableClass::ID_ESTADO, TRUE);?>" required />
   <option><?php echo i18n::__('selectEstado')?></option>
       <?php foreach($objEstado as $estado):?>
       <option <?php echo (isset($objAnimal[0]->$id_estado_a) === true and $objAnimal[0]->$id_estado_a == $estado->$id_estado) ? 'selected' : ((session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::ID_ESTADO, TRUE)) === TRUE) ? '' : (request::getInstance()->hasPost(animalTableClass::getNameField(animalTableClass::ID_ESTADO, TRUE)) and request::getInstance()->getPost(animalTableClass::getNameField(animalBaseTableClass::ID_ESTADO, TRUE)) == $estado->$id_estado) ? 'selected' : '') ?> value="<?php echo $estado->$id_estado?>"><?php echo $estado->$descripcionestado?></option>
       <?php endforeach;?>
   </select>
    </div>
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objAnimal) ? 'update': 'register'))?>">
   <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'index')?>"><i class="glyphicon glyphicon-arrow-left"> </i> <?php echo i18n::__('return')?></a>
    </div>
</form>

