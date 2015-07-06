<?php use mvc\routing\routingClass as routing?>
<?php use mvc\i18n\i18nClass as i18n?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\session\sessionClass as session ?>
<?php $id = insumoTableClass::ID?>
<?php $nombre = insumoTableClass::NOMBRE?>
<?php $fecha_fabricacion = insumoTableClass::FECHA_FABRICACION?>
<?php $fecha_vencimiento = insumoTableClass::FECHA_VENCIMIENTO?>
<?php $valor = insumoTableClass::VALOR?>
<?php $id_tipo_insumo = insumoTableClass::ID_TIPO_INSUMO?>
<?php $idTipo_insumo = tipoInsumoTableClass::ID ?>
<?php $descripciontipo_insumo = tipoInsumoTableClass::DESCRIPCION?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('insumo', ((isset($objInsumo)) ? 'update' : 'create')) ?>">
    <?php if (isset($objInsumo) == TRUE): ?>
    <input type="hidden" name="<?php echo insumoTableClass::getNameField(insumoTableClass::ID,TRUE)?>" value="<?php echo $objInsumo[0]->$id ?>">
    <?php endif ;?>
    
    <div class="form-group" <?php echo (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::NOMBRE, TRUE)) === TRUE )? 'has-error has-feedback' : '' ;?>>
        <label class="control-label" for="name"><?php echo i18n::__('name')?>:</label> 
        <input class="form-control" type="text" value="<?php echo ((isset($objInsumo)) ? $objInsumo[0]->$nombre : ((session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::NOMBRE, TRUE)) === TRUE ) ? request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::NOMBRE,TRUE)) : '') )?>" name="<?php echo insumoTableClass::getNameField(insumoTableClass::NOMBRE, TRUE)?>" required placeholder="<?php echo i18n::__('enterName')?>">
        <?php if(session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::NOMBRE,TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif?>
    </div>
    
    <div class="form-group" <?php echo (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, TRUE)) === TRUE )? 'has-error has-feedback' : '' ;?>>
        <label class="control-label" for="date_create">
           <?php echo i18n::__('date_create')?>: 
        </label>
        <input class="form-control" type="date" value="<?php echo ((isset($objInsumo)) ? $objInsumo[0]->$fecha_fabricacion : ((session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, TRUE)) === TRUE ) ? request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION,TRUE)) : ''))?>" name="<?php echo insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, TRUE)?>" required placeholder="<?php echo i18n::__('enterDateCreate')?>">
        <?php if(session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION,TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif?>
    </div>
    
    <div class="form-group" <?php echo (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, TRUE)) === TRUE )? 'has-error has-feedback' : '' ;?>>
        <label class="control-label" for="date_expiration">
             <?php echo i18n::__('date_expiration')?>:
            
        </label>
            <input class="form-control" type="date" value="<?php echo ((isset($objInsumo))? $objInsumo[0]->$fecha_vencimiento : ((session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, TRUE)) === TRUE ) ? request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO,TRUE)) : ''))?>"name="<?php echo insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, TRUE)?>" required placeholder="<?php echo i18n::__('enterDateExpiration')?>">
            <?php if(session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO,TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif?>
    </div>
        <div class="form-group" <?php echo (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::VALOR, TRUE)) === TRUE )? 'has-error has-feedback' : '' ;?>>
        <label class="control-label" for="value">
            <?php echo i18n::__('value')?>:
            
        </label>
            <input class="form-control" type="number" value="<?php echo ((isset($objInsumo))? $objInsumo[0]->$valor :((session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::VALOR, TRUE)) === TRUE ) ? request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::VALOR,TRUE)) : '') )?>"name="<?php echo insumoTableClass::getNameField(insumoTableClass::VALOR, TRUE)?>" required placeholder="<?php echo i18n::__('enterValue')?>">
            <?php if(session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::VALOR,TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif?>
    </div>
        <div class="form-group">
        <label class="control-label" for="id_tipo_insumo">
               <?php echo i18n::__('input_type')?>:
            
        </label>
            <select class="form-control" id="<?php echo insumoTableClass::getNameField(insumoTableClass::ID_TIPO_INSUMO, TRUE)?>" name="<?php echo insumoTableClass::getNameField(insumoTableClass::ID_TIPO_INSUMO, TRUE)?>" required>
                <option><?php echo i18n::__('selectTypeInput')?></option>
                  <?php foreach($objTipoInsumo as $tipo_insumo):?>
                <option <?php echo (isset($objInsumo[0]->$id_tipo_insumo) === TRUE and $objInsumo[0]->$id_tipo_insumo == $tipo_insumo->$idTipo_insumo) ? 'selected' : '' ?> value="<?php echo $tipo_insumo->$idTipo_insumo?>"><?php echo $tipo_insumo->$descripciontipo_insumo?></option>
         <?php endforeach;?>
     </select>
    </div>
     
    
     
   
    
    
      <br>
     <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objInsumo)? 'update': 'register'))?>">
     <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'index')?>"><i class="fa fa-hand-o-left"><?php echo i18n::__('return')?></i></a>
</form>



