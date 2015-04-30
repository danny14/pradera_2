<?php use mvc\routing\routingClass as routing?>
<?php use mvc\i18n\i18nClass as i18n?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\session\sessionClass as session ?>
<?php $id = fecundadorTableClass::ID?>
<?php $nombre = fecundadorTableClass::NOMBRE?>
<?php $edad = fecundadorTableClass::EDAD?>
<?php $peso = fecundadorTableClass::PESO?>
<?php $observacion = fecundadorTableClass::OBSERVACION?>
<?php $id_raza = fecundadorTableClass::ID_RAZA?>
<?php $idRaza = razaTableClass::ID ?>
<?php $descripcionraza = razaTableClass::DESCRIPCION?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('fecundador', ((isset($objFecundador)) ? 'update' : 'create')) ?>">
    <?php if (isset($objFecundador) == TRUE): ?>
    <input type="hidden" name="<?php echo fecundadorTableClass::getNameField(fecundadorTableClass::ID,TRUE)?>" value="<?php echo $objFecundador[0]->$id ?>">
    <?php endif ;?>
    
    <div class="form-group" <?php echo (session::getInstance()->hasFlash(fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE, TRUE)) === TRUE )? 'has-error has-feedback' : '' ;?>>
        <label class="control-label" for="name"><?php echo i18n::__('name')?>:</label> 
        <input class="form-control" type="text" value="<?php echo ((isset($objFecundador)) ? $objFecundador[0]->$nombre : ((session::getInstance()->hasFlash(fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE, TRUE)) === TRUE ) ? request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE,TRUE)) : '') )?>" name="<?php echo fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE, TRUE)?>" required placeholder="<?php echo i18n::__('enterName')?>">
        <?php if(session::getInstance()->hasFlash(fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE,TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif?>
    </div>
    
    <div class="form-group" <?php echo (session::getInstance()->hasFlash(fecundadorTableClass::getNameField(fecundadorTableClass::EDAD, TRUE)) === TRUE )? 'has-error has-feedback' : '' ;?>>
        <label class="control-label" for="age">
           <?php echo i18n::__('age')?>: 
        </label>
        <input class="form-control" type="text" value="<?php echo ((isset($objFecundador)) ? $objFecundador[0]->$edad : ((session::getInstance()->hasFlash(fecundadorTableClass::getNameField(fecundadorTableClass::EDAD, TRUE)) === TRUE ) ? request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::EDAD,TRUE)) : ''))?>" name="<?php echo fecundadorTableClass::getNameField(fecundadorTableClass::EDAD, TRUE)?>" required placeholder="<?php echo i18n::__('enterAge')?>">
        <?php if(session::getInstance()->hasFlash(fecundadorTableClass::getNameField(fecundadorTableClass::EDAD,TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif?>
    </div>
    
    <div class="form-group" <?php echo (session::getInstance()->hasFlash(fecundadorTableClass::getNameField(fecundadorTableClass::PESO, TRUE)) === TRUE )? 'has-error has-feedback' : '' ;?>>
        <label class="control-label" for="weight">
             <?php echo i18n::__('weight')?>:
            
        </label>
            <input class="form-control" type="text" value="<?php echo ((isset($objFecundador))? $objFecundador[0]->$peso : ((session::getInstance()->hasFlash(fecundadorTableClass::getNameField(fecundadorTableClass::PESO, TRUE)) === TRUE ) ? request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::PESO,TRUE)) : ''))?>"name="<?php echo fecundadorTableClass::getNameField(fecundadorTableClass::PESO, TRUE)?>" required placeholder="<?php echo i18n::__('enterWeight')?>">
            <?php if(session::getInstance()->hasFlash(fecundadorTableClass::getNameField(fecundadorTableClass::PESO,TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif?>
    </div>
        <div class="form-group" <?php echo (session::getInstance()->hasFlash(fecundadorTableClass::getNameField(fecundadorTableClass::OBSERVACION, TRUE)) === TRUE )? 'has-error has-feedback' : '' ;?>>
        <label class="control-label" for="observation">
            <?php echo i18n::__('observation')?>:
            
        </label>
            <input class="form-control" type="text" value="<?php echo ((isset($objFecundador))? $objFecundador[0]->$observacion :((session::getInstance()->hasFlash(fecundadorTableClass::getNameField(fecundadorTableClass::OBSERVACION, TRUE)) === TRUE ) ? request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::OBSERVACION,TRUE)) : '') )?>"name="<?php echo fecundadorTableClass::getNameField(fecundadorTableClass::OBSERVACION, TRUE)?>" required placeholder="<?php echo i18n::__('enterObservation')?>">
            <?php if(session::getInstance()->hasFlash(fecundadorTableClass::getNameField(fecundadorTableClass::OBSERVACION,TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif?>
    </div>
        <div class="form-group">
        <label class="control-label" for="id_raza">
               <?php echo i18n::__('id_raza')?>:
            
        </label>
            <select class="form-control" id="<?php echo fecundadorTableClass::getNameField(fecundadorTableClass::ID_RAZA, TRUE)?>" name="<?php echo fecundadorTableClass::getNameField(fecundadorTableClass::ID_RAZA, TRUE)?>" required>
                <option><?php echo i18n::__('selectRaza')?></option>
                  <?php foreach($objRaza as $raza):?>
         <option value="<?php echo $raza->$idRaza?>"><?php echo $raza->$descripcionraza?></option>
         <?php endforeach;?>
     </select>
    </div>
     
    
     
   
    
    
      <br>
     <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objFecundador)? 'update': 'register'))?>">
     <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('fecundador', 'index')?>"><i class="fa fa-hand-o-left"><?php echo i18n::__('return')?></i></a>
</form>



