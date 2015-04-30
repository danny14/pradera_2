<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n;?>
<?php $id = registroCeloTableClass::ID ;?>
<?php $edad_animal = registroCeloTableClass::EDAD_ANIMAL ;?>
<?php $fecha = registroCeloTableClass::FECHA ;?>
<?php $id_fecundador = registroCeloTableClass::ID_FECUNDADOR ;?>
<?php $id_animal = registroCeloTableClass::ID_ANIMAL ;?>
<?php $animal_id = animalTableClass::ID;?>
<?php $fecundador_id = fecundadorTableClass::ID;?>
<?php $nombrefecundador = fecundadorTableClass::NOMBRE;?>
<?php $nombreAnimal = animalTableClass::NOMBRE;?>

<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('registro_celo', ((isset($objRegistroCelo)) ? 'update' : 'create' ))?>">
    <?php if (isset($objRegistroCelo)== true):?>
    <input name="<?php echo registroCeloTableClass::getNameField(registroCeloTableClass::ID,TRUE)?>" value="<?php echo ((isset($objRegistroCelo))? $objRegistroCelo[0]->$id : $registro_celo[$id]) ?>" type="hidden">
    <?php endif ?>
   <?php echo i18n::__('age_animal')?>: <input class="form-control" type="number" value="<?php echo ((isset($objRegistroCelo)) ? $objRegistroCelo[0]->$edad_animal : ((isset($registro_celo[$edad_animal]))? $registro_celo[$edad_animal] : '' ) ) ?>" name="<?php echo registroCeloTableClass::getNameField(registroCeloTableClass::EDAD_ANIMAL, true )?>" required placeholder="<?php echo i18n::__('enterAge')?>" >
   <?php echo i18n::__('date')?>: <input class="form-control" type="date" value="<?php echo ((isset($objRegistroCelo)) ? $objRegistroCelo[0]->$fecha : ((isset($registro_celo[$fecha]))? $registro_celo[$fecha] : '' ) ) ?>" name="<?php echo registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, true )?>"required placeholder="<?php i18n::__('date') ?>">
   <?php echo i18n::__('fecundador') ?>: 
   <select class="form-control" id="<?php registroCeloTableClass::getNameField(registroCeloTableClass::ID_FECUNDADOR, TRUE)?>" name="<?php echo registroCeloTableClass::getNameField(registroCeloTableClass::ID_FECUNDADOR, TRUE);?>"required placeholder="<?php i18n::__('id_fecundador') ?>">
     <option> <?php echo i18n::__('selectFecundador') ?></option>
       <?php foreach($objFecundador as $fecundador):?>
       <option <?php echo ((isset($objRegistroCelo[0]->$id_fecundador) and $objRegistroCelo[0]->$id_fecundador == $fecundador->$fecundador_id ) ? 'selected' : '' )?> value="<?php echo $fecundador->$fecundador_id?>"><?php echo $fecundador->$nombrefecundador?></option>
       <?php endforeach;?>
   </select>
   <?php echo i18n::__('animal')?>
   <select class="form-control" id="<?php registroCeloTableClass::getNameField(registroCeloTableClass::ID_ANIMAL, TRUE)?>" name="<?php echo registroCeloTableClass::getNameField(registroCeloTableClass::ID_ANIMAL, TRUE);?>"required placeholder="<?php i18n::__('id_animal') ?>">
     <option><?php echo i18n::__('selectAnimal') ?></option>
       <?php foreach($objAnimal as $animal):?>
       <option  <?php echo(( isset($objRegistroCelo[0]->$id_animal) and $objRegistroCelo[0]->$id_animal == $animal->$animal_id) ? 'selected' : '')?> value="<?php echo $animal->$animal_id?>"><?php echo $animal->$nombreAnimal?></option>
       <?php endforeach;?>
   </select>
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objRegistroCelo) ? 'update': 'register'))?>">
   <a href="<?php echo routing::getInstance()->getUrlWeb('registro_celo', 'index') ?>"class="btn btn-info btn-xs"> <i class="fa fa-hand-o-left"> <?php echo i18n::__('return') ?></i></a>
   </div>
</form>


