<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18m;?>
<?php $id = fecundadorTableClass::ID?>
<?php $nombre = fecundadorTableClass::NOMBRE?>
<?php $edad = fecundadorTableClass::EDAD?>
<?php $peso = fecundadorTableClass::PESO?>
<?php $observacion = fecundadorTableClass::OBSERVACION ?>
<?php $id_raza = fecundadorTableClass::ID_RAZA ?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('fecundador',((isset($objFecundador)) ? 'update' : 'create'))?>">
    <?php if (isset($objFecundador)== TRUE ):?>
    <input type="hidden" name="<?php echo fecundadorTableClass::getNameField(fecundadorTableClass::ID,TRUE)?>" value=" <?php echo $objFecundador[0]->$id?>">
    <?php endif;?>
    <div class="form-group">
        <?php echo i18m::__('name')?>: <input class="form-control" type="text" value="<?php echo ((isset($objFecundador))? $objFecundador[0]->$nombre : '')?>" name="<?php echo fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE, TRUE)?>">
        <?php echo i18m::__('age')?>: <input class="form-control" type="text" value="<?php echo ((isset($objFecundador))? $objFecundador[0]->$edad : '')?>" name="<?php echo fecundadorTableClass::getNameField(fecundadorTableClass::EDAD, TRUE)?>">
        <?php echo i18m::__('weight')?>: <input class="form-control" type="text" value="<?php echo ((isset($objFecundador))? $objFecundador[0]->$peso : '')?>" name="<?php echo fecundadorTableClass::getNameField(fecundadorTableClass::PESO, TRUE)?>">
        <?php echo i18m::__('observation')?>: <input class="form-control" type="text" value="<?php echo ((isset($objFecundador))? $objFecundador[0]->$observacion : '')?>" name="<?php echo fecundadorTableClass::getNameField(fecundadorTableClass::OBSERVACION, TRUE)?>">
        <?php echo i18m::__('id_raza')?>: <input class="form-control" type="text" value="<?php echo ((isset($objFecundador))? $objFecundador[0]->$id_raza : '')?>" name="<?php echo fecundadorTableClass::getNameField(fecundadorTableClass::ID_RAZA, TRUE)?>">
        <br>
        <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18m::__((isset($objFecundador)? 'update': 'register'))?>">
    </div>
</form>


