<?php use mvc\routing\routingClass as routing?>
<?php use mvc\i18n\i18nClass as i18n?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\session\sessionClass as session ?>
<?php $id = registroVacunacionTableClass::ID?>
<?php $fecha_registro = registroVacunacionTableClass::FECHA_REGISTRO?>
<?php $id_trabajador = registroVacunacionTableClass::ID_TRABAJADOR?>
<?php $dosis_vacuna = registroVacunacionTableClass::DOSIS_VACUNA?>
<?php $hora_vacuna = registroVacunacionTableClass::HORA_VACUNA?>
<?php $id_animal = registroVacunacionTableClass::ID_ANIMAL?>
<?php $id_insumo = registroVacunacionTableClass::ID_INSUMO?>
<?php $idTrabajador = trabajadorTableClass::ID ?>
<?php $idAnimal = animalTableClass::ID ?>
<?php $idInsumo = insumoTableClass::ID ?>
<?php $nombreAnimal = animalTableClass::NOMBRE?>
<?php $nombreInsumo = insumoTableClass::NOMBRE?>
<?php $nombreTrabajador = trabajadorTableClass::NOMBRE?>
<?php $apellidoTrabajador= trabajadorTableClass::APELLIDO?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('registro_vacunacion', ((isset($objRegistroVacunacion)) ? 'update' : 'create')) ?>">
    <?php if (isset($objRegistroVacunacion) == TRUE): ?>
    <input type="hidden" name="<?php echo registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID,TRUE)?>" value="<?php echo $objRegistroVacunacion[0]->$id ?>">
    <?php endif ;?>
    
    <div class="form-group <?php echo (session::getInstance()->hasFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::FECHA_REGISTRO, TRUE)) === TRUE )? 'has-error has-feedback' : '' ;?>" >
        <label class="control-label" for="date_register"><?php echo i18n::__('date_register')?>:</label> 
        <input class="form-control" type="date" value="<?php echo ((isset($objRegistroVacunacion)) ? $objRegistroVacunacion[0]->$fecha_registro : ((session::getInstance()->hasFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::FECHA_REGISTRO, TRUE)) === TRUE ) ? request::getInstance()->getPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::FECHA_REGISTRO,TRUE)) : '') )?>" name="<?php echo registroVacunacionTableClass::getNameField(registroVacunacionTableClass::FECHA_REGISTRO, TRUE)?>" required placeholder="<?php echo i18n::__('enterDateRegister')?>">
        <?php if(session::getInstance()->hasFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::FECHA_REGISTRO,TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif?>
    </div>
    
   
    
    <div class="form-group <?php echo (session::getInstance()->hasFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::DOSIS_VACUNA, TRUE)) === TRUE )? 'has-error has-feedback' : '' ;?>" >
        <label class="control-label" for="dose_vaccine"><?php echo i18n::__('dose_vaccine')?>:</label> 
        <input class="form-control" type="number" value="<?php echo ((isset($objRegistroVacunacion)) ? $objRegistroVacunacion[0]->$dosis_vacuna : ((session::getInstance()->hasFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::DOSIS_VACUNA, TRUE)) === TRUE ) ? request::getInstance()->getPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::DOSIS_VACUNA,TRUE)) : '') )?>" name="<?php echo registroVacunacionTableClass::getNameField(registroVacunacionTableClass::DOSIS_VACUNA, TRUE)?>" required placeholder="<?php echo i18n::__('enterDoseVaccine')?>">
        <?php if(session::getInstance()->hasFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::DOSIS_VACUNA,TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif?>
    </div>
           
    <div class="form-group <?php echo (session::getInstance()->hasFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::HORA_VACUNA, TRUE)) === TRUE )? 'has-error has-feedback' : '' ;?>" >
        <label class="control-label" for="time_vaccine"><?php echo i18n::__('time_vaccine')?>:</label> 
        <input class="form-control" type="time" value="<?php echo ((isset($objRegistroVacunacion)) ? $objRegistroVacunacion[0]->$hora_vacuna : ((session::getInstance()->hasFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::HORA_VACUNA, TRUE)) === TRUE ) ? request::getInstance()->getPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::HORA_VACUNA,TRUE)) : '') )?>" name="<?php echo registroVacunacionTableClass::getNameField(registroVacunacionTableClass::HORA_VACUNA, TRUE)?>" required placeholder="<?php echo i18n::__('enterTimeVaccine')?>">
        <?php if(session::getInstance()->hasFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::HORA_VACUNA,TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif?>
    </div>          
       

    <?php // view::getMessageError('errorTrabajador')?>
    <div class="form-group" <?php echo (session::getInstance()->hasFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_TRABAJADOR, TRUE)) === TRUE )? 'has-error has-feedback' : '' ;?>>
        <label class="control-label" for="id_trabajador">
               <?php echo i18n::__('id_employee')?>:
        </label>
            <select class="form-control" id="<?php echo registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_TRABAJADOR, TRUE)?>" name="<?php echo registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_TRABAJADOR, TRUE)?>" required>
                <option><?php echo i18n::__('selectEmployee')?></option>
                  <?php foreach($objTrabajador as $trabajador):?>
                <option <?php echo (isset($objRegistroVacunacion[0]->$id_trabajador) === TRUE and $objRegistroVacunacion[0]->$id_trabajador == $trabajador->$idTrabajador) ? 'selected' : ((session::getInstance()->hasFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_TRABAJADOR, TRUE)) === TRUE) ? '' : (request::getInstance()->hasPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_TRABAJADOR, TRUE)) and request::getInstance()->getPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_TRABAJADOR, TRUE)) == $trabajador->$idTrabajador) ? 'selected' : '') ?> value="<?php echo $trabajador->$idTrabajador?>"><?php echo $trabajador->$nombreTrabajador.' '.$trabajador->$apellidoTrabajador?></option>
         <?php endforeach;?>
     </select>
    </div>
    
        <?php // view::getMessageError('errorAnimal')?>
        <div class="form-group" <?php echo (session::getInstance()->hasFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_ANIMAL, TRUE)) === TRUE )? 'has-error has-feedback' : '' ;?>>
        <label class="control-label" for="id_animal">
               <?php echo i18n::__('id_animal')?>:
        </label>
            <select class="form-control" id="<?php echo registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_ANIMAL, TRUE)?>" name="<?php echo registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_ANIMAL, TRUE)?>" required>
                <option><?php echo i18n::__('selectAnimal')?></option>
                  <?php foreach($objAnimal as $animal):?>
                <option <?php echo (isset($objRegistroVacunacion[0]->$id_animal) === TRUE and $objRegistroVacunacion[0]->$id_animal == $animal->$idAnimal) ? 'selected' : ((session::getInstance()->hasFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_ANIMAL, TRUE)) === TRUE) ? '' : (request::getInstance()->hasPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_ANIMAL, TRUE)) and request::getInstance()->getPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_ANIMAL, TRUE)) == $animal->$idAnimal) ? 'selected' : '') ?> value="<?php echo $animal->$idAnimal?>"><?php echo $animal->$nombreAnimal?></option>
         <?php endforeach;?>
     </select>
    </div>
        
        <div class="form-group">
            <label class="control-label" for="id_insumo"><?php echo i18n::__('id_input')?></label>
       <select class="form-control" id="<?php echo registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_INSUMO, TRUE)?>" name="<?php echo registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_INSUMO, TRUE)?>" required>
                <option><?php echo i18n::__('selectInput')?></option>
                  <?php foreach($objInsumo as $insumo):?>
                <option <?php echo (isset($objRegistroVacunacion[0]->$id_insumo) === TRUE and $objRegistroVacunacion[0]->$id_insumo == $insumo->$idInsumo) ? 'selected' : ((session::getInstance()->hasFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_ANIMAL, TRUE)) === TRUE) ? '' : (request::getInstance()->hasPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_ANIMAL, TRUE)) and request::getInstance()->getPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_ANIMAL, TRUE)) == $insumo->$idInsumo) ? 'selected' : '') ?> value="<?php echo $insumo->$idInsumo ?>"><?php echo $insumo->$nombreInsumo ?></option>
         <?php endforeach;?>
     </select>
    </div>
      <br>
     <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objRegistroVacunacion)? 'update': 'register'))?>">
     <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('registro_vacunacion', 'index')?>"><i class="fa fa-hand-o-left"><?php echo i18n::__('return')?></i></a>
</form>



