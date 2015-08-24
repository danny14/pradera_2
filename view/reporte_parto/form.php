<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n;?>
<?php use mvc\session\sessionClass as session ;?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\request\requestClass as request?>
<?php $id = reportePartoTableClass::ID ;?>
<?php $fecha_parto = reportePartoTableClass::FECHA_PARTO ;?>
<?php $n_animales_vi = reportePartoTableClass::N_ANIMALES_VI ;?>
<?php $n_animales_m = reportePartoTableClass::N_ANIMALES_M ;?>
<?php $n_machos= reportePartoTableClass::N_MACHOS ;?>
<?php $n_hembras = reportePartoTableClass::N_HEMBRAS ;?>
<?php $observaciones = reportePartoTableClass::OBSERVACIONES ;?>
<?php $id_animal = reportePartoTableClass::ID_ANIMAL ;?>
<?php $animal_id= animalTableClass::ID?>
<?php $nombreAnimal = animalTableClass::NOMBRE;?>

<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('reporte_parto', ((isset($objReporteParto)) ? 'update' : 'create' ))?>">
    <?php if (isset($objReporteParto)== true):?>
    <input name="<?php echo reportePartoTableClass::getNameField(reportePartoTableClass::ID,TRUE)?>" value="<?php echo ((isset($objReporteParto))? $objReporteParto[0]->$id : $reporte_parto[$id]) ?>" type="hidden">
    <?php endif ?>
   <!--este  es para el mensaje de error puntual -->
   <?php view::getMessageError('errorFechaParto') ?>
   <!-- Fin de mensaje error puntual -->
   <div class="form-group <?php echo (session::getInstance()->hasFlash(reportePartoTableClass::getNameField(reportePartoTableClass::FECHA_PARTO,true)) === TRUE ) ? 'has-error has-feedback' : '' ?>"> 
   <label class="control-label" for="date_delivery"><?php echo i18n::__('date_delivery')?></label>
   <input class="form-control" type="date" value="<?php echo ((isset($objReporteParto)) ? $objReporteParto[0]->$fecha_parto : ((session::getInstance()->hasFlash(reportePartoTableClass::getNameField(reportePartoTableClass::FECHA_PARTO, TRUE))=== TRUE )?'':(request::getInstance()->hasPost(reportePartoTableClass::getNameField(reportePartoTableClass::FECHA_PARTO, TRUE)))?request::getInstance()->getPost(reportePartoTableClass::getNameField(reportePartoTableClass::FECHA_PARTO, TRUE)):''))?>" name="<?php echo reportePartoTableClass::getNameField(reportePartoTableClass::FECHA_PARTO, true )?>"required placeholder="<?php i18n::__('date_delivery') ?>">
   <?php if(session::getInstance()->hasFlash(reportePartoTableClass::getNameField(reportePartoTableClass::FECHA_PARTO, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif;?>
   </div>
   
   <!--este  es para el mensaje de error puntual -->
   <?php view::getMessageError('errorNumeroAnimalesVivos') ?>
   <!-- Fin de mensaje error puntual -->
   <div class="form-group <?php echo (session::getInstance()->hasFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_VI,true)) === TRUE ) ? 'has-error has-feedback' : '' ?>">
   <label class="control-label" for="n_animales_live"><?php echo i18n::__('n_animales_living')?></label>
   <input class="form-control" type="number" value="<?php echo ((isset($objReporteParto)) ? $objReporteParto[0]->$n_animales_vi : ((session::getInstance()->hasFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_VI, TRUE))=== TRUE )?'':(request::getInstance()->hasPost(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_VI, TRUE)))?request::getInstance()->getPost(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_VI, TRUE)):''))?>" name="<?php echo reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_VI, true )?>"required placeholder="<?php i18n::__('n_animales_living') ?>">
   <?php if(session::getInstance()->hasFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_VI, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif;?>
   </div>
   
   <!--este  es para el mensaje de error puntual -->
   <?php view::getMessageError('errorNumeroAnimalesMuertos') ?>
   <!-- Fin de mensaje error puntual -->
   <div class="form-group <?php echo (session::getInstance()->hasFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_M,true)) === TRUE ) ? 'has-error has-feedback' : '' ?>">
   <label class="control-label" for="n_animal_dead"><?php echo i18n::__('n_animales_dead')?> </label>
   <input class="form-control" type="number" value="<?php echo ((isset($objReporteParto)) ? $objReporteParto[0]->$n_animales_m : ((session::getInstance()->hasFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_M, TRUE))=== TRUE )?'':(request::getInstance()->hasPost(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_M, TRUE)))?request::getInstance()->getPost(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_M, TRUE)):''))?>" name="<?php echo reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_M, true )?>"required placeholder="<?php i18n::__('n_animales_dead') ?>">
   <?php if(session::getInstance()->hasFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_M, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif;?>
   </div>
   
   <!--este  es para el mensaje de error puntual -->
   <?php view::getMessageError('errorNumeroMachos') ?>
   <!-- Fin de mensaje error puntual -->
   <div class="form-group <?php echo (session::getInstance()->hasFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_MACHOS,true)) === TRUE ) ? 'has-error has-feedback' : '' ?>">
   <label class="control-label" for="n_males"><?php echo i18n::__('n_males')?></label>
   <input class="form-control" type="number" value="<?php echo ((isset($objReporteParto)) ? $objReporteParto[0]->$n_machos : ((session::getInstance()->hasFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_MACHOS, TRUE))=== TRUE )?'':(request::getInstance()->hasPost(reportePartoTableClass::getNameField(reportePartoTableClass::N_MACHOS, TRUE)))?request::getInstance()->getPost(reportePartoTableClass::getNameField(reportePartoTableClass::N_MACHOS, TRUE)):''))?>" name="<?php echo reportePartoTableClass::getNameField(reportePartoTableClass::N_MACHOS, true )?>"required placeholder="<?php i18n::__('n_males') ?>">
   <?php if(session::getInstance()->hasFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_MACHOS, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif;?>
   </div>
   
   <!--este  es para el mensaje de error puntual -->
   <?php view::getMessageError('errorNumeroHembras') ?>
   <!-- Fin de mensaje error puntual -->
   <div class="form-group <?php echo (session::getInstance()->hasFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_HEMBRAS,true)) === TRUE ) ? 'has-error has-feedback' : '' ?>">
   <label class="control-label" for="n_females"><?php echo i18n::__('n_females')?></label>
   <input class="form-control" type="number" value="<?php echo ((isset($objReporteParto)) ? $objReporteParto[0]->$n_hembras : ((session::getInstance()->hasFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_HEMBRAS, TRUE))=== TRUE )?'':(request::getInstance()->hasPost(reportePartoTableClass::getNameField(reportePartoTableClass::N_HEMBRAS, TRUE)))?request::getInstance()->getPost(reportePartoTableClass::getNameField(reportePartoTableClass::N_HEMBRAS, TRUE)):''))?>" name="<?php echo reportePartoTableClass::getNameField(reportePartoTableClass::N_HEMBRAS, true )?>"required placeholder="<?php i18n::__('n_females') ?>">
   <?php if(session::getInstance()->hasFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_HEMBRAS, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif;?>
   </div>
   
   <!--este  es para el mensaje de error puntual -->
   <?php view::getMessageError('errorObservacion') ?>
   <!-- Fin de mensaje error puntual -->
   <div class="form-group <?php echo (session::getInstance()->hasFlash(reportePartoTableClass::getNameField(reportePartoTableClass::OBSERVACIONES,true)) === TRUE ) ? 'has-error has-feedback' : '' ?>">
   <label class="control-label" for="observation"><?php echo i18n::__('observation')?></label>
   <input class="form-control" type="text" value="<?php echo ((isset($objReporteParto)) ? $objReporteParto[0]->$observaciones : ((session::getInstance()->hasFlash(reportePartoTableClass::getNameField(reportePartoTableClass::OBSERVACIONES, TRUE))=== TRUE )?'':(request::getInstance()->hasPost(reportePartoTableClass::getNameField(reportePartoTableClass::OBSERVACIONES, TRUE)))?request::getInstance()->getPost(reportePartoTableClass::getNameField(reportePartoTableClass::OBSERVACIONES, TRUE)):''))?>" name="<?php echo reportePartoTableClass::getNameField(reportePartoTableClass::OBSERVACIONES, true )?>"required placeholder="<?php i18n::__('observation') ?>">
   <?php if(session::getInstance()->hasFlash(reportePartoTableClass::getNameField(reportePartoTableClass::OBSERVACIONES, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif;?>
   </div>
   
   <!--este  es para el mensaje de error puntual -->
   <?php view::getMessageError('errorAnimal') ?>
   <!-- Fin de mensaje error puntual -->
    <?php echo i18n::__('animal')?>
   <select class="form-control" id="<?php reportePartoTableClass::getNameField(reportePartoTableClass::ID_ANIMAL, TRUE)?>" name="<?php echo reportePartoTableClass::getNameField(reportePartoTableClass::ID_ANIMAL, TRUE);?>"required placeholder="<?php i18n::__('id_animal') ?>">
     <option><?php echo i18n::__('selectAnimal') ?></option>
       <?php foreach($objAnimal as $animal):?>
       <option  <?php echo(( isset($objReporteParto[0]->$id_animal) and $objReporteParto[0]->$id_animal == $animal->$animal_id) ? 'selected' : ((session::getInstance()->hasFlash(reportePartoTableClass::getNameField(reportePartoTableClass::ID_ANIMAL, TRUE))===TRUE)? '' :(request::getInstance()->hasPost(reportePartoTableClass::getNameField(reportePartoTableClass::ID_ANIMAL, TRUE))and request::getInstance()->getPost(reportePartoTableClass::getNameField(reportePartoTableClass::ID_ANIMAL, TRUE))=== $animal-> $animal_id)))?> value="<?php echo $animal->$animal_id?>"><?php echo $animal->$nombreAnimal?></option>
       <?php endforeach;?>
   </select>
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objReporteParto) ? 'update': 'register'))?>">
   <a href="<?php echo routing::getInstance()->getUrlWeb('reporte_parto', 'index') ?>"class="btn btn-info btn-xs"> <i class="fa fa-hand-o-left"> <?php echo i18n::__('return') ?></i></a>
   </div>
</form>




