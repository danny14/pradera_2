<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n;?>
<?php use mvc\session\sessionClass as session?>
<?php use mvc\request\requestClass as request?>
<?php $id = turnoTableClass::ID ;?>
<?php $descripcion = turnoTableClass::DESCRIPCION;?>
<?php $inicio_turno = turnoTableClass::INICIO_TURNO?>
<?php $fin_turno = turnoTableClass::FIN_TURNO ?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('turno', ((isset($objTurno)) ? 'update' : 'create' ))?>">
    <?php if (isset($objTurno)== true):?>
    <input name="<?php echo turnoTableClass::getNameField(turnoTableClass::ID,TRUE)?>" value="<?php echo $objTurno[0]->$id ?>" type="hidden">
    <?php endif ?>
   <div class="form-group <?php echo (session::getInstance()->hasFlash(turnoTableClass::getNameField(turnoTableClass::DESCRIPCION, TRUE)) === TRUE) ? 'has-error has-feedback' : ''; ?>">
   <label class="control-label" for="description"><?php echo i18n::__('description') ?>: </label>
   <input class="form-control" type="text" value="<?php echo ((isset($objTurno)) ? $objTurno[0]->$descripcion : '' ) ?>" name="<?php echo turnoTableClass::getNameField(turnoTableClass::DESCRIPCION, true )?>">
   <?php if (session::getInstance()->hasFlash(turnoTableClass::getNameField(turnoTableClass::DESCRIPCION, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
   </div>
   <div class="form-group <?php echo (session::getInstance()->hasFlash(turnoTableClass::getNameField(turnoTableClass::DESCRIPCION, TRUE)) === TRUE) ? 'has-error has-feedback' : ''; ?>">
   <label class="control-label" for="inicio_turno"><?php echo i18n::__('start_turn') ?>: </label>
   <input class="form-control" type="time" value="<?php echo ((isset($objTurno)) ? $objTurno[0]->$inicio_turno : '' ) ?>" name="<?php echo turnoTableClass::getNameField(turnoTableClass::INICIO_TURNO, true )?>">
   <?php if (session::getInstance()->hasFlash(turnoTableClass::getNameField(turnoTableClass::INICIO_TURNO, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
   </div>
   <div class="form-group <?php echo (session::getInstance()->hasFlash(turnoTableClass::getNameField(turnoTableClass::FIN_TURNO, TRUE)) === TRUE) ? 'has-error has-feedback' : ''; ?>">
   <label class="control-label" for="description"><?php echo i18n::__('description') ?>: </label>
   <input class="form-control" type="time" value="<?php echo ((isset($objTurno)) ? $objTurno[0]->$fin_turno : '' ) ?>" name="<?php echo turnoTableClass::getNameField(turnoTableClass::FIN_TURNO, true )?>">
   <?php if (session::getInstance()->hasFlash(turnoTableClass::getNameField(turnoTableClass::FIN_TURNO, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
   </div>
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objTurno) ? 'update': 'register'))?>">
   <a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('turno', 'index')?>"><i class="glyphicon glyphicon-arrow-left"> </i> <?php echo i18n::__('return')?></a>
</form>

