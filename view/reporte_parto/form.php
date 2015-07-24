<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n;?>
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
   <?php echo i18n::__('date_delivery')?>: <input class="form-control" type="date" value="<?php echo ((isset($objReporteParto)) ? $objReporteParto[0]->$fecha_parto : ((isset($reporte_parto[$fecha_parto]))? $reporte_parto[$fecha_parto] : '' ) ) ?>" name="<?php echo reportePartoTableClass::getNameField(reportePartoTableClass::FECHA_PARTO, true )?>"required placeholder="<?php i18n::__('date_delivery') ?>">
   <?php echo i18n::__('n_animales_living')?>: <input class="form-control" type="number" value="<?php echo ((isset($objReporteParto)) ? $objReporteParto[0]->$n_animales_vi : ((isset($reporte_parto[$n_animales_vi]))? $reporte_parto[$n_animales_vi] : '' ) ) ?>" name="<?php echo reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_VI, true )?>"required placeholder="<?php i18n::__('n_animales_living') ?>">
   <?php echo i18n::__('n_animales_dead')?>: <input class="form-control" type="number" value="<?php echo ((isset($objReporteParto)) ? $objReporteParto[0]->$n_animales_m : ((isset($reporte_parto[$n_animales_m]))? $reporte_parto[$n_animales_m] : '' ) ) ?>" name="<?php echo reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_M, true )?>"required placeholder="<?php i18n::__('n_animales_dead') ?>">
   <?php echo i18n::__('n_males')?>: <input class="form-control" type="number" value="<?php echo ((isset($objReporteParto)) ? $objReporteParto[0]->$n_machos : ((isset($reporte_parto[$n_machos]))? $reporte_parto[$n_machos] : '' ) ) ?>" name="<?php echo reportePartoTableClass::getNameField(reportePartoTableClass::N_MACHOS, true )?>"required placeholder="<?php i18n::__('n_males') ?>">
   <?php echo i18n::__('n_females')?>: <input class="form-control" type="number" value="<?php echo ((isset($objReporteParto)) ? $objReporteParto[0]->$n_hembras : ((isset($reporte_parto[$n_hembras]))? $reporte_parto[$n_hembras] : '' ) ) ?>" name="<?php echo reportePartoTableClass::getNameField(reportePartoTableClass::N_HEMBRAS, true )?>"required placeholder="<?php i18n::__('n_females') ?>">
   <?php echo i18n::__('observation')?>: <input class="form-control" type="text" value="<?php echo ((isset($objReporteParto)) ? $objReporteParto[0]->$observaciones : ((isset($reporte_parto[$observaciones]))? $reporte_parto[$observaciones] : '' ) ) ?>" name="<?php echo reportePartoTableClass::getNameField(reportePartoTableClass::OBSERVACIONES, true )?>"required placeholder="<?php i18n::__('observation') ?>">
   
    <?php echo i18n::__('animal')?>
   <select class="form-control" id="<?php reportePartoTableClass::getNameField(reportePartoTableClass::ID_ANIMAL, TRUE)?>" name="<?php echo reportePartoTableClass::getNameField(reportePartoTableClass::ID_ANIMAL, TRUE);?>"required placeholder="<?php i18n::__('id_animal') ?>">
     <option><?php echo i18n::__('selectAnimal') ?></option>
       <?php foreach($objAnimal as $animal):?>
       <option  <?php echo(( isset($objReporteParto[0]->$id_animal) and $objReporteParto[0]->$id_animal == $animal->$animal_id) ? 'selected' : '')?> value="<?php echo $animal->$animal_id?>"><?php echo $animal->$nombreAnimal?></option>
       <?php endforeach;?>
   </select>
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objReporteParto) ? 'update': 'register'))?>">
   <a href="<?php echo routing::getInstance()->getUrlWeb('reporte_parto', 'index') ?>"class="btn btn-info btn-xs"> <i class="fa fa-hand-o-left"> <?php echo i18n::__('return') ?></i></a>
   </div>
</form>




