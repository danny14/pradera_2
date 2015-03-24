<?php use mvc\routing\routingClass as routing?>
<?php use mvc\i18n\i18nClass as i18n?>
<?php $id = fecundadorTableClass::ID?>
<?php $nombre = fecundadorTableClass::NOMBRE?>
<?php $edad = fecundadorTableClass::EDAD?>
<?php $peso = fecundadorTableClass::PESO?>
<?php $observacion = fecundadorTableClass::OBSERVACION?>
<?php $id_raza = fecundadorTableClass::ID_RAZA?>
<?php $idRaza = razaTableClass::ID ?>
<?php $descripcionraza = razaTableClass::DESCRIPCION?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('fecundador', ((isset($objFecundador)) ? 'update' : 'create'))?>">
    <?php if (isset($objFecundador) == TRUE): ?>
    <input type="hidden" name="<?php echo fecundadorTableClass::getNameField(fecundadorTableClass::ID,TRUE)?>" value="<?php echo $objFecundador[0]->$id?>"
    <?php endif;?>
    <div class="form-group">
     <?php echo i18n::__('name')?>: <input class="form-control" type="text" value="<?php echo ((isset($objFecundador)) ? $objFecundador[0]->$nombre : '')?>" name="<?php echo fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE, TRUE)?>">
     <?php echo i18n::__('age')?>: <input class="form-control" type="text" value="<?php echo ((isset($objFecundador)) ? $objFecundador[0]->$edad : '')?>" name="<?php echo fecundadorTableClass::getNameField(fecundadorTableClass::EDAD, TRUE)?>">
     <?php echo i18n::__('weight')?>: <input class="form-control" type="text" value="<?php echo ((isset($objFecundador))? $objFecundador[0]->$peso : '')?>"name="<?php echo fecundadorTableClass::getNameField(fecundadorTableClass::PESO, TRUE)?>">
     <?php echo i18n::__('observation')?>: <input class="form-control" type="text" value="<?php echo ((isset($objFecundador))? $objFecundador[0]->$observacion : '')?>"name="<?php echo fecundadorTableClass::getNameField(fecundadorTableClass::OBSERVACION, TRUE)?>">
     <?php echo i18n::__('id_raza')?>: 
     <select class="form-control" id="<?php echo fecundadorTableClass::getNameField(fecundadorTableClass::ID_RAZA, TRUE)?>" name="<?php echo fecundadorTableClass::getNameField(fecundadorTableClass::ID_RAZA, TRUE)?>">
     <?php foreach($objRaza as $raza):?>
         <option value="<?php echo $raza->$idRaza?>"><?php echo $raza->$descripcionraza?></option>
         <?php endforeach;?>
     </select>
      <br>
     <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objFecundador)? 'update': 'register'))?>">
    </div>
    
</form>



