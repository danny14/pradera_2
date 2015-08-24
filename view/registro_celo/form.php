<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n;?>
<?php use mvc\session\sessionClass as session ;?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\request\requestClass as request?>
<?php $id = registroCeloTableClass::ID ;?> 
<?php $fecha = registroCeloTableClass::FECHA ;?>
<?php $id_fecundador = registroCeloTableClass::ID_FECUNDADOR ;?>
<?php $id_animal = registroCeloTableClass::ID_ANIMAL ;?>
<?php $animal_id = animalTableClass::ID;?>
<?php $nombreAnimal = animalTableClass::NOMBRE;?>
<?php $fecundador_id = fecundadorTableClass::ID;?>
<?php $nombrefecundador = fecundadorTableClass::NOMBRE;?>


<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('registro_celo', ((isset($objRegistroCelo)) ? 'update' : 'create' ))?>">
    <?php if (isset($objRegistroCelo)== true):?>
    <input name="<?php echo registroCeloTableClass::getNameField(registroCeloTableClass::ID,TRUE)?>" value="<?php echo ((isset($objRegistroCelo))? $objRegistroCelo[0]->$id : $registro_celo[$id]) ?>" type="hidden">
    <?php endif ?>
    
    <!--este  es para el mensaje de error puntual -->
   <?php view::getMessageError('errorFecha') ?>
   <!-- Fin de mensaje error puntual -->
   <div class="form-group <?php echo (session::getInstance()->hasFlash(registroCeloTableClass::getNameField(registroCeloTableClass::FECHA,true)) === TRUE ) ? 'has-error has-feedback' : '' ?>">
   <label class="control-label" for="date"><?php echo i18n::__('date')?></label>
   <input class="form-control" type="date" value="<?php echo ((isset($objRegistroCelo)) ? $objRegistroCelo[0]->$fecha : ((session::getInstance()->hasFlash(registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, TRUE))=== TRUE )?'':(request::getInstance()->hasPost(registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, TRUE)))?request::getInstance()->getPost(registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, TRUE)):''))?>" name="<?php echo registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, true )?>"required placeholder="<?php i18n::__('date') ?>">
    <?php if(session::getInstance()->hasFlash(registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif;?>
   </div>
   
   <!--este  es para el mensaje de error puntual -->
   <?php view::getMessageError('errorFecundador') ?>
   <!-- Fin de mensaje error puntual -->
   <?php echo i18n::__('fecundador') ?>: 
   <select class="form-control" id="<?php registroCeloTableClass::getNameField(registroCeloTableClass::ID_FECUNDADOR, TRUE)?>" name="<?php echo registroCeloTableClass::getNameField(registroCeloTableClass::ID_FECUNDADOR, TRUE);?>"required placeholder="<?php i18n::__('id_fecundador') ?>">
     <option> <?php echo i18n::__('selectFecundador') ?></option>
       <?php foreach($objFecundador as $fecundador):?>
       <option <?php echo ((isset($objRegistroCelo[0]->$id_fecundador) and $objRegistroCelo[0]->$id_fecundador == $fecundador->$fecundador_id ) ? 'selected' : ((session::getInstance()->hasFlash(registroCeloTableClass::getNameField(registroCeloTableClass::ID_FECUNDADOR, TRUE))===TRUE)? '' :(request::getInstance()->hasPost(registroCeloTableClass::getNameField(registroCeloTableClass::ID_FECUNDADOR, TRUE))and request::getInstance()->getPost(registroCeloTableClass::getNameField(registroCeloTableClass::ID_FECUNDADOR, TRUE))=== $fecundador-> $fecundador_id)))?> value="<?php echo $fecundador->$fecundador_id?>"><?php echo $fecundador->$nombrefecundador?></option>
       <?php endforeach;?>
   </select>
   
   <!--este  es para el mensaje de error puntual -->
   <?php view::getMessageError('errorAnimal') ?>
   <!-- Fin de mensaje error puntual -->
   <?php echo i18n::__('animal')?>
   <select class="form-control" id="<?php registroCeloTableClass::getNameField(registroCeloTableClass::ID_ANIMAL, TRUE)?>" name="<?php echo registroCeloTableClass::getNameField(registroCeloTableClass::ID_ANIMAL, TRUE);?>"required placeholder="<?php i18n::__('id_animal') ?>">
     <option><?php echo i18n::__('selectAnimal') ?></option>
       <?php foreach($objAnimal as $animal):?>
       <option  <?php echo(( isset($objRegistroCelo[0]->$id_animal) and $objRegistroCelo[0]->$id_animal == $animal->$animal_id) ? 'selected' : ((session::getInstance()->hasFlash(registroCeloTableClass::getNameField(registroCeloTableClass::ID_ANIMAL, TRUE))===TRUE)? '' :(request::getInstance()->hasPost(registroCeloTableClass::getNameField(registroCeloTableClass::ID_ANIMAL, TRUE))and request::getInstance()->getPost(registroCeloTableClass::getNameField(registroCeloTableClass::ID_ANIMAL, TRUE))=== $animal-> $animal_id)))?> value="<?php echo $animal->$animal_id?>"><?php echo $animal->$nombreAnimal?></option>
       <?php endforeach;?>
   </select>
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objRegistroCelo) ? 'update': 'register'))?>">
   <a href="<?php echo routing::getInstance()->getUrlWeb('registro_celo', 'index') ?>"class="btn btn-info btn-xs"> <i class="fa fa-hand-o-left"> <?php echo i18n::__('return') ?></i></a>
   </div>
</form>


