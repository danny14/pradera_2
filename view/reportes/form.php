<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n;?>
<?php use mvc\session\sessionClass as session; ?>
<?php use mvc\request\requestClass as request;?>
<?php use mvc\view\viewClass as view; ?>
<?php $id_animal = animalTableClass::ID ;?>
<?php $nombre= animalTableClass::NOMBRE;?>
<?php $id_raza = razaTableClass::ID;?>
<?php $descripcionraza = razaTableClass::DESCRIPCION;?>


<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('reportes', 'create' )?>">

    <input name="idReporte" value="<?php echo $reporteId?>" type="hidden">


    <!-- se inclule el mensaje de error puntual -->
    <?php view::getMessageError('errorFechaInicio') ?>
    <!-- FIN-->
    <div class="form-group <?php echo (session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, TRUE)) === TRUE) ?  'has-error has-feedback' : '' ; ?>"">
        <label class="control-label" for="date_entry"><?php echo i18n::__('start_date')?>:</label> 
        <input class="form-control" type="date" value="" name="fecha_inicio"  required />
   <?php  if (session::getInstance()->hasFlash(ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO, TRUE).'_1') === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
    </div>

    <!-- se inclule el mensaje de error puntual -->
    <?php view::getMessageError('errorFechaFin') ?>
    <!-- FIN-->
    <div class="form-group <?php echo (session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::NUMERO_PARTOS, TRUE)) === TRUE) ?  'has-error has-feedback' : '' ; ?>"">
        <label class="control-label" for="date_entry"><?php echo i18n::__('end_date')?>: </label>
        <input class="form-control" type="date" value="" name="fecha_fin" min="0" max="99"  required/>
   <?php  if (session::getInstance()->hasFlash(ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO, TRUE).'_2') === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
    </div>

    <!-- se inclule el mensaje de error puntual -->
    <?php view::getMessageError('errorRaza') ?>
    <!-- FIN-->
    <?php if(session::getInstance()->getAttribute('idReporte') == 2) :?>
    <div class="form-group <?php// echo ((isset($animal[$id _raza])) ? 'has-error has-feedback' : '') ?>">
        <label class="control-label" for="breed"><?php echo i18n::__('breed') ?>:</label> 
   <select class="form-control" id="<?php animalTableClass::getNameField(animalTableClass::ID_RAZA, TRUE)?>" name="<?php echo animalTableClass::getNameField(animalTableClass::ID_RAZA, TRUE);?>" required />
   <option><?php echo i18n::__('selectRaza')?></option>
       <?php foreach($objRaza as $raza):?>
       <option  value="<?php echo $raza->$id_raza?>"><?php echo $raza->$descripcionraza?></option>
       <?php endforeach;?>
   </select>
   <?php //if (isset($animal[$id_raza])):?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php //endif ?>
   </div>
   <?php endif; ?>
    <!-- se inclule el mensaje de error puntual -->
<!--    <?php // view::getMessageError('errorAnimal') ?>
     FIN    
    <div class="form-group <?php // echo ((isset($animal[$id_estado])) ? 'has-error has-feedback' : '') ?>">
        <label class="control-label" for="anima"><?php // echo i18n::__('animal')?></label>
        <select class="form-control" id="<?php // ordennoTableClass::getNameField(ordennoTableClass::ID_ANIMAL, TRUE)?>" name="<?php // echo ordennoTableClass::getNameField(ordennoTableClass::ID_ANIMAL, TRUE);?>" required />
   <option><?php // echo i18n::__('selectEstado')?></option>
       <?php // foreach($objAnimal as $animal):?>
   <option  value="<?php // echo $animal->$id_animal?>"><?php // echo $animal->$nombre?></option>
       <?php // endforeach;?>
   </select>
    </div>-->
   <br>
   <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'index')?>"><i class="glyphicon glyphicon-arrow-left"><?php echo i18n::__('return')?></i> </a>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__('report')?>">
    </div>
</form>

