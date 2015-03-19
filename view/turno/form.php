<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18m;?>
<?php $id = turnoTableClass::ID ;?>
<?php $descripcion = turnoTableClass::DESCRIPCION;?>
<?php $inicio_turno = turnoTableClass::INICIO_TURNO?>
<?php $fin_turno  = turnoTableClass::FIN_TURNO ?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('turno', ((isset($objTurno)) ? 'update' : 'create' ))?>">
    <?php if (isset($objTurno)== true):?>
    <input name="<?php echo tablaTableClass::getNameField(tablaTableClass::ID,TRUE)?>" value="<?php echo $objTurno[0]->$id ?>" type="hidden">
    <?php endif ?>
    <div class="form-group">
   <?php echo i18m::__('description')?>: <input class="form-control" type="text" value="<?php echo ((isset($objTurno)) ? $objTurno[0]->$descripcion : '' ) ?>" name="<?php echo turnoTableClass::getNameField(turnoTableClass::DESCRIPCION, true )?>">
   <?php echo i18m::__('start_turn')?>: <input class="form-control" type="text" value="<?php echo ((isset($objTurno)) ? $objTurno[0]->$inicio_turno : '' ) ?>" name="<?php echo turnoTableClass::getNameField(turnoTableClass::INICIO_TURNO, true )?>">
   <?php echo i18m::__('end_turn')?>: <input class="form-control" type="text" value="<?php echo ((isset($objTurno)) ? $objTurno[0]->$fin_turno : '' ) ?>" name="<?php echo turnoTableClass::getNameField(turnoTableClass::FIN_TURNO, true )?>">
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18m::__((isset($objTurno) ? 'update': 'register'))?>">
    </div>
</form>

