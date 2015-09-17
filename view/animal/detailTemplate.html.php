<?php use mvc\routing\routingClass as routing; ?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view ?>
<?php $idAnimal = animalTableClass::ID ?>
<?php $nombre = animalTableClass::NOMBRE ?>
<?php $genero = animalTableClass::GENERO ?>
<?php $peso = animalTableClass::PESO; ?>
<?php $fecha_ingreso = animalTableClass::FECHA_INGRESO; ?>
<?php $numero_partos = animalTableClass::NUMERO_PARTOS ?>
<?php $id_raza = animalTableClass::ID_RAZA ?>
<?php $id_estado = animalTableClass::ID_ESTADO ?>
<?php $idOrdenno = ordennoTableClass::ID?>
<?php $fecha_ordenno = ordennoTableClass::FECHA_ORDENNO ?>
<?php $id_animal_o = ordennoTableClass::ID_ANIMAL?>
<?php $id_empleado_o = ordennoTableClass::ID_TRABAJADOR ?>
<?php $fecha_registro = registroVacunacionTableClass::FECHA_REGISTRO?>
<?php $id_trabajador_r = registroVacunacionTableClass::ID_TRABAJADOR?>
<?php $dosis_vacuna = registroVacunacionTableClass::DOSIS_VACUNA?>
<?php $hora_vacuna = registroVacunacionTableClass::HORA_VACUNA?>
<?php $id_animal_r = registroVacunacionTableClass::ID_ANIMAL?>
<?php $id_insumo_r = registroVacunacionTableClass::ID_INSUMO?>
<?php $fecha_parto = reportePartoTableClass::FECHA_PARTO?>
<?php $n_animales_vi = reportePartoTableClass::N_ANIMALES_VI?>
<?php $n_animales_m = reportePartoTableClass::N_ANIMALES_M?>
<?php $n_machos = reportePartoTableClass::N_MACHOS?>
<?php $n_hembras = reportePartoTableClass::N_HEMBRAS?>
<?php $id_animal_re = reportePartoTableClass::ID_ANIMAL?>
<?php $observaciones = reportePartoTableClass::OBSERVACIONES?>
<?php $fecha = registroCeloTableClass::FECHA?>
<?php $id_animal_r_c = registroCeloTableClass::ID_ANIMAL?>
<?php $id_fecundador_r_c = registroCeloTableClass::ID_FECUNDADOR?>

<?php view::includePartial('animal/menuPrincipal'); ?>
<div class="container container-fluid">
    
    <div class="row">
        <header>

        </header>
        <nav>

        </nav>
        <section>
            <?php view::includeHandlerMessage() ?>
            <h1><i class="fa fa-bug"><?php echo i18n::__('animal') ?></i></h1>
            <table class="table table-bordered table-responsive table-condensed">
                <thead>
                    <tr class="active">
                        <th><?php echo i18n::__('name') ?></th>
                        <th><?php echo i18n::__('gender') ?></th>
                        <th><?php echo i18n::__('weight') ?></th>
                        <th><?php echo i18n::__('date_entry') ?></th>
                        <th><?php echo i18n::__('number_births') ?></th>
                        <th><?php echo i18n::__('breed') ?></th>
                        <th><?php echo i18n::__('status') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objAnimal as $animal): ?>
                        <tr>
                            <td><?php echo $animal->$nombre ?></td>
                            <td><?php echo $animal->$genero ?></td>
                            <td><?php echo $animal->$peso ?> .Kg</td>
                            <td><?php echo $animal->$fecha_ingreso ?></td>
                            <td><?php echo $animal->$numero_partos ?></td>
                            <td><?php echo animalTableClass::getNameFieldForaneaRaza($animal->$id_raza) ?></td>
                            <td><?php echo animalTableClass::getNameFieldForaneaEstado($animal->$id_estado) ?></td>
                        </tr>
                    <?php endforeach; ?> 
                </tbody>
                
            </table>
            <h1><i class="fa fa-ship"><?php echo i18n::__('ordenno') ?></i></h1>
            <table class="table table-bordered table-responsive table-condensed">
                <thead>
                    <tr class="active">
                        <th><?php echo i18n::__('date_ordenno') ?></th>
                        <th><?php echo i18n::__('animal') ?></th>
                        <th><?php echo i18n::__('employee') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objOrdenno as $ordenno): ?>
                        <tr>
                            <td><?php echo $ordenno->$fecha_ordenno ?></td>
                            <td><?php echo ordennoTableClass::getNameFieldForaneaAnimal($ordenno->$id_animal_o) ?></td>
                            <td><?php echo ordennoTableClass::getNameFieldForaneaTrabajador($ordenno->$id_empleado_o) ?></td>
                        </tr>
                    <?php endforeach; ?> 
                </tbody>
                
            </table>
            <h1><i class="fa fa-eyedropper"><?php echo i18n::__('register_vacunacion') ?></i></h1>
            <table class="table table-bordered table-responsive table-condensed">
                <thead>
                    <tr class="active">
                        <th><?php echo i18n::__('date_register') ?></th>
                        <th><?php echo i18n::__('employee') ?></th>
                        <th><?php echo i18n::__('dose_vaccine') ?></th>
                        <th><?php echo i18n::__('time_vaccine') ?></th>
                        <th><?php echo i18n::__('animal') ?></th>
                        <th><?php echo i18n::__('input') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objRegistroVacunacion as $registro_vacunacion): ?>
                        <tr>
                            <td><?php echo $registro_vacunacion->$fecha_registro ?></td>
                            <td><?php echo $registro_vacunacion->$id_trabajador_r ?></td>
                            <td><?php echo $registro_vacunacion->$dosis_vacuna?></td>
                            <td><?php echo $registro_vacunacion->$hora_vacuna ?></td>
                            <td><?php echo registroVacunacionTableClass::getNameFieldForaneaAnimal($registro_vacunacion->$id_animal_r) ?></td>
                            <td><?php echo registroVacunacionTableClass::getNameFieldForaneaInsumo($registro_vacunacion->$id_insumo_r) ?></td>
                        </tr>
                    <?php endforeach; ?> 
                </tbody>
                
            </table>
            <h1><i class="fa fa-file-pdf-o"><?php echo i18n::__('report_parto') ?></i></h1>
            <table class="table table-bordered table-responsive table-condensed">
                <thead>
                    <tr class="active">
                        <th><?php echo i18n::__('date_delivery') ?></th>
                        <th><?php echo i18n::__('n_animales_living') ?></th>
                        <th><?php echo i18n::__('n_animales_dead') ?></th>
                        <th><?php echo i18n::__('n_males') ?></th>
                        <th><?php echo i18n::__('n_females') ?></th>
                        <th><?php echo i18n::__('animal') ?></th>
                        <th><?php echo i18n::__('observation') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objReporteParto as $reporte_parto): ?>
                        <tr>
                            <td><?php echo $reporte_parto->$fecha_parto ?></td>
                            <td><?php echo $reporte_parto->$n_animales_vi ?></td>
                            <td><?php echo $reporte_parto->$n_animales_m ?> .Kg</td>
                            <td><?php echo $reporte_parto->$n_machos ?></td>
                            <td><?php echo $reporte_parto->$n_hembras ?></td>
                            <td><?php echo reportePartoTableClass::getNameFieldForaneaAnimal($reporte_parto->$id_animal_re) ?></td>
                            <td><?php echo $reporte_parto->$observaciones ?></td>
                        </tr>
                    <?php endforeach; ?> 
                </tbody>
                
            </table> 
            <h1><i class="fa fa-github-alt"><?php echo i18n::__('register_celo') ?></i></h1>
            <table class="table table-bordered table-responsive table-condensed">
                <thead>
                    <tr class="active">
                        <th><?php echo i18n::__('date') ?></th>
                        <th><?php echo i18n::__('animal') ?></th>
                        <th><?php echo i18n::__('fecundador') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objRegistroCelo as $registro_celo): ?>
                        <tr>
                            <td><?php echo $registro_celo->$fecha ?></td>
                            <td><?php echo registroCeloTableClass::getNameFieldForaneaAnimal($registro_celo->$id_animal_r_c) ?></td>
                            <td><?php echo registroCeloTableClass::getNameFieldForaneaFecundador($registro_celo->$id_fecundador_r_c) ?></td>
                        </tr>
                    <?php endforeach; ?> 
                </tbody>
                
            </table>
            
            <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'index')?>"><i class="glyphicon glyphicon-arrow-left"> </i> <?php echo i18n::__('return')?></a>
        </section>
        <footer>

        </footer>
    </div>
</div>