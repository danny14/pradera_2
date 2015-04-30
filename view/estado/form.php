<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n;?>
<?php use mvc\session\sessionClass as session?>
<?php $id = estadoTableClass::ID ;?>
<?php $descripcion = estadoTableClass::DESCRIPCION;?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('estado', ((isset($objEstado)) ? 'update' : 'create' ))?>">
    <?php if (isset($objEstado) == true):?>
    <input name="<?php echo estadoTableClass::getNameField(estadoTableClass::ID,TRUE)?>" value="<?php echo $objEstado[0]->$id ?>" type="hidden">
    <?php endif ?>
    <div class="form-group <?php echo (session::getInstance()->hasFlash(estadoTableClass::getNameField(estadoTableClass::DESCRIPCION, TRUE)) === TRUE) ? 'has-error has-feedback' : ''; ?>">
        <label class="control-label" for="description"><?php echo i18n::__('description') ?>: </label>
        <input class="form-control" type="text" value="<?php echo ((isset($objEstado)) ? $objEstado[0]->$descripcion : '' ) ?>" name="<?php echo estadoTableClass::getNameField(estadoTableClass::DESCRIPCION, TRUE) ?>">
        <?php if (session::getInstance()->hasFlash(estadoTableClass::getNameField(estadoTableClass::DESCRIPCION, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
    </div>
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objEstado) ? 'update': 'register'))?>">
   <a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('estado', 'index')?>"><i class="glyphicon glyphicon-arrow-left"> </i> <?php echo i18n::__('return')?></a>
</form>