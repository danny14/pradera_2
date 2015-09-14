<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php $id = registroVacunacionTableClass::ID ?>
<?php $fecha_registro =registroVacunacionTableClass::FECHA_REGISTRO ?>
<?php $id_trabajador =registroVacunacionTableClass::ID_TRABAJADOR ?>
<?php $dosis_vacuna =registroVacunacionTableClass::DOSIS_VACUNA ?>
<?php $hora_vacuna =registroVacunacionTableClass::HORA_VACUNA ?>
<?php $id_animal =registroVacunacionTableClass::ID_ANIMAL ?>
<?php view::includePartial('animal/menuPrincipal')?>
<div class="container container-fluid">
    <h1><?php echo i18n::__('registro_vacunacion')?></h1>
    <h1<i class="fa fa-baxtery-quarter"><?php echo i18n::__('registro_vacunacion') ?></i></h1>
    <div class="row" >
        <header>
            
        </header>
        <nav>
            
        </nav>
        <section>
            <table class="table table-bordered table-responsive table-striped table-condensed">
                <thead>
                    <tr>
                        <th><?php echo i18n::__('id')?></th>
                        <th><?php echo i18n::__('date_register')?></th>
                        <th><?php echo i18n::__('id_employee')?></th>
                        <th><?php echo i18n::__('dose_vaccine')?></th>
                        <th><?php echo i18n::__('time_vaccine')?></th>
                        <th><?php echo i18n::__('id_animal')?></th>
                        <th><?php echo i18n::__('id_insumo')?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objRegistroVacunacion as $registro_vacunacion): ?>
                    <tr>
                        <td><?php echo $registro_vacunacion->$id?></td>
                        <td><?php echo $registro_vacunacion->$fecha_registro?></td>
                        <td><?php echo $registro_vacunacion->$id_trabajador?></td>
                        <td><?php echo $registro_vacunacion->$dosis_vacuna?></td>
                        <td><?php echo $registro_vacunacion->$hora_vacuna?></td>
                        <td><?php echo $registro_vacunacion->$id_animal?></td>
                        <td><?php echo $registro_vacunacion->$id_insumo?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
                <tfoot></tfoot>
            </table>
            <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('registro_vacunacion', 'index')?>"><i class="fa fa-hand-o-left"> <?php echo i18n::__('return')?></i></a>
        </section>
        <footer>
            
        </footer>
    </div>
</div>

       



