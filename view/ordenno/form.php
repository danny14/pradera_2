<?php use mvc\routing\routingClass as routing?>
<?php use mvc\i18n\i18nClass as i18n?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\view\viewClass as view?>
<?php $id = ordennoTableClass::ID?>
<?php $fecha_ordenno = ordennoTableClass::FECHA_ORDENNO?>
<?php $cantidad_leche = ordennoTableClass::CANTIDAD_LECHE?>
<?php $id_trabajador = ordennoTableClass::ID_TRABAJADOR?>
<?php $id_animal = ordennoTableClass::ID_ANIMAL?>
<?php $idTrabajador = trabajadorTableClass::ID ?>
<?php $nombreTrabajador = trabajadorTableClass::NOMBRE?>
<?php $apellidoTrabajador = trabajadorTableClass::APELLIDO?>
<?php $idAnimal = animalTableClass::ID ?>
<?php $nombreAnimal = animalTableClass::NOMBRE?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('ordenno', ((isset($objOrdenno)) ? 'update' : 'create')) ?>">
    <?php if (isset($objOrdenno) == TRUE): ?>
    <input type="hidden" name="<?php echo ordennoTableClass::getNameField(ordennoTableClass::ID,TRUE)?>" value="<?php echo $objOrdenno[0]->$id ?>">
    <?php endif ;?>
    
    <?php view::getMessageError('errorFechaOrdenno') ?>
    <div class="form-group" <?php echo (session::getInstance()->hasFlash(ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO, TRUE)) === TRUE )? 'has-error has-feedback' : '' ;?>>
        <label class="control-label" for="date_ordenno"><?php echo i18n::__('date_ordenno')?>:</label> 
        <input class="form-control" type="date" value="<?php echo ((isset($objOrdenno)) ? $objOrdenno[0]->$fecha_ordenno : ((session::getInstance()->hasFlash(ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO, TRUE)) === TRUE) ?  '' :  (request::getInstance()->hasPost(ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO, TRUE))) ? request::getInstance()->getPost(ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO, TRUE))  : '' ) )?>" name="<?php echo ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO, TRUE)?>" min="2014-01-01" step="1" required placeholder="<?php echo i18n::__('enterDateOrdenno')?>">
        <?php if(session::getInstance()->hasFlash(ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO,TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif?>
    </div>
    
    <?php view::getMessageError('errorCantidadLeche')?>
    <div class="form-group" <?php echo (session::getInstance()->hasFlash(ordennoTableClass::getNameField(ordennoTableClass::CANTIDAD_LECHE, TRUE)) === TRUE )? 'has-error has-feedback' : '' ;?>>
        <label class="control-label" for="quantity_milk">
           <?php echo i18n::__('quantity_milk')?>: 
        </label>
        <div class="input-group">
        <input class="form-control" type="number" value="<?php echo ((isset($objOrdenno)) ? $objOrdenno[0]->$cantidad_leche : ((session::getInstance()->hasFlash(ordennoTableClass::getNameField(ordennoTableClass::CANTIDAD_LECHE, TRUE)) === TRUE) ?  '' :  (request::getInstance()->hasPost(ordennoTableClass::getNameField(ordennoTableClass::CANTIDAD_LECHE, TRUE))) ? request::getInstance()->getPost(ordennoTableClass::getNameField(ordennoTableClass::CANTIDAD_LECHE, TRUE))  : '' ))?>" name="<?php echo ordennoTableClass::getNameField(ordennoTableClass::CANTIDAD_LECHE, TRUE)?>" min="0" max="999" required placeholder="<?php echo i18n::__('enterQuantityMilk')?>">
        <span class="input-group-addon" id="basic-addon1">.L</span>
        </div>
        <?php if(session::getInstance()->hasFlash(ordennoTableClass::getNameField(ordennoTableClass::CANTIDAD_LECHE,TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif?>
    </div>
    
    <?php view::getMessageError('errorTrabajador')?>
    <div class="form-group" <?php echo (session::getInstance()->hasFlash(ordennoTableClass::getNameField(ordennoTableClass::ID_TRABAJADOR, TRUE)) === TRUE )? 'has-error has-feedback' : '' ;?>>
        <label class="control-label" for="id_trabajador">
               <?php echo i18n::__('id_employee')?>:
        </label>
            <select class="form-control" id="<?php echo ordennoTableClass::getNameField(ordennoTableClass::ID_TRABAJADOR, TRUE)?>" name="<?php echo ordennoTableClass::getNameField(ordennoTableClass::ID_TRABAJADOR, TRUE)?>" required>
                <option><?php echo i18n::__('selectEmployee')?></option>
                  <?php foreach($objTrabajador as $trabajador):?>
                <option <?php echo (isset($objOrdenno[0]->$id_trabajador) === TRUE and $objOrdenno[0]->$id_trabajador == $trabajador->$idTrabajador) ? 'selected' : ((session::getInstance()->hasFlash(ordennoTableClass::getNameField(ordennoTableClass::ID_TRABAJADOR, TRUE)) === TRUE) ? '' : (request::getInstance()->hasPost(ordennoTableClass::getNameField(ordennoTableClass::ID_TRABAJADOR, TRUE)) and request::getInstance()->getPost(ordennoTableClass::getNameField(ordennoTableClass::ID_TRABAJADOR, TRUE)) == $trabajador->$idTrabajador) ? 'selected' : '') ?> value="<?php echo $trabajador->$idTrabajador?>"><?php echo $trabajador->$nombreTrabajador.' '.$trabajador->$apellidoTrabajador?></option>
         <?php endforeach;?>
     </select>
    </div>
  
        <?php view::getMessageError('errorAnimal')?>
        <div class="form-group" <?php echo (session::getInstance()->hasFlash(ordennoTableClass::getNameField(ordennoTableClass::ID_ANIMAL, TRUE)) === TRUE )? 'has-error has-feedback' : '' ;?>>
        <label class="control-label" for="id_animal">
               <?php echo i18n::__('id_animal')?>:
        </label>
            <select class="form-control" id="<?php echo ordennoTableClass::getNameField(ordennoTableClass::ID_ANIMAL, TRUE)?>" name="<?php echo ordennoTableClass::getNameField(ordennoTableClass::ID_ANIMAL, TRUE)?>" required>
                <option><?php echo i18n::__('selectAnimal')?></option>
                  <?php foreach($objAnimal as $animal):?>
                <option <?php echo (isset($objOrdenno[0]->$id_animal) === TRUE and $objOrdenno[0]->$id_animal == $animal->$idAnimal) ? 'selected' : ((session::getInstance()->hasFlash(ordennoTableClass::getNameField(ordennoTableClass::ID_ANIMAL, TRUE)) === TRUE) ? '' : (request::getInstance()->hasPost(ordennoTableClass::getNameField(ordennoTableClass::ID_ANIMAL, TRUE)) and request::getInstance()->getPost(ordennoTableClass::getNameField(ordennoTableClass::ID_ANIMAL, TRUE)) == $animal->$idAnimal) ? 'selected' : '') ?> value="<?php echo $animal->$idAnimal?>"><?php echo $animal->$nombreAnimal?></option>
         <?php endforeach;?>
            </select>
    </div>
 
    
     <br>
     <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objOrdenno)? 'update': 'register'))?>">
     <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('ordenno', 'index')?>"><i class="fa fa-hand-o-left"><?php echo i18n::__('return')?></i></a>
</form>



