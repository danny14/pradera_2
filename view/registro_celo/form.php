<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n;?>
<?php $id = registroCeloTableClass::ID ;?>
<?php $edad_animal = registroCeloTableClass::EDAD_ANIMAL ;?>
<?php $fecha = registroCeloTableClass::FECHA ;?>
<?php $id_fecundador = registroCeloTableClass::ID_FECUNDADOR ;?>
<?php $id_animal = registroCeloTableClass::ID_ANIMAL ;?>
<?php $nombrefecundador = fecundadorTableClass::NOMBRE?>
<?php $nombreAnimal = animalTableClass::NOMBRE;?>

<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('registro_celo', ((isset($objRegistroCelo)) ? 'update' : 'create' ))?>">
    <?php if (isset($objRegistroCelo)== true):?>
    <input name="<?php echo registroCeloTableClass::getNameField(registroCeloTableClass::ID,TRUE)?>" value="<?php echo ((isset($objRegistroCelo))? $objRegistroCelo[0]->$id : $registro_celo[$id]) ?>" type="hidden">
    <?php endif ?>
   <?php echo i18n::__('age_animal')?>: <input class="form-control" type="text" value="<?php echo ((isset($objRegistroCelo)) ? $objRegistroCelo[0]->$edad_animal : ((isset($registro_celo[$edad_animal]))? $registro_celo[$edad_animal] : '' ) ) ?>" name="<?php echo registroCeloTableClass::getNameField(registroCeloTableClass::EDAD_ANIMAL, true )?>">
   <?php echo i18n::__('date')?>: <input class="form-control" type="date" value="<?php echo ((isset($objRegistroCelo)) ? $objRegistroCelo[0]->$fecha : ((isset($registro_celo[$fecha]))? $registro_celo[$fecha] : '' ) ) ?>" name="<?php echo registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, true )?>">
   <?php echo i18n::__('fecundador') ?>: 
   <select class="form-control" id="<?php registroCeloTableClass::getNameField(registroCeloTableClass::ID_FECUNDADOR, TRUE)?>" name="<?php echo registroCeloTableClass::getNameField(registroCeloTableClass::ID_FECUNDADOR, TRUE);?>">
       <option>Seleccione el fecundador</option>
       <?php foreach($objFecundador as $fecundador):?>
       <option value="<?php echo $fecundador->id?>"><?php echo $fecundador->$nombrefecundador?></option>
       <?php endforeach;?>
   </select>
   <?php echo i18n::__('animal')?>
   <select class="form-control" id="<?php registroCeloTableClass::getNameField(registroCeloTableClass::ID_ANIMAL, TRUE)?>" name="<?php echo registroCeloTableClass::getNameField(registroCeloTableClass::ID_ANIMAL, TRUE);?>">
       <option>Seleccione el animal</option>
       <?php foreach($objAnimal as $animal):?>
       <option value="<?php echo $animal->id?>"><?php echo $animal->$nombreAnimal?></option>
       <?php endforeach;?>
   </select>
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objRegistroCelo) ? 'update': 'register'))?>">
   <a href="<?php echo routing::getInstance()->getUrlWeb('registro_celo', 'index') ?>"class="btn btn-info btn-xs"> <i class="fa fa-hand-o-left"> <?php echo i18n::__('return') ?></i></a>
   </div>
</form>

