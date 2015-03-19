<?php use mvc\routing\routingClass as routing; ?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view ?>
<?php $id = animalTableClass::ID ?>
<?php $nombre = animalTableClass::NOMBRE ?>
<?php $genero = animalTableClass::GENERO ?>
<?php $edad = animalTableClass::EDAD ?>
<?php $peso = animalTableClass::PESO; ?>
<?php $fecha_ingreso = animalTableClass::FECHA_INGRESO; ?>
<?php $numero_partos = animalTableClass::NUMERO_PARTOS ?>
<?php $id_raza = animalTableClass::ID_RAZA ?>
<?php $id_estado = animalTableClass::ID_ESTADO ?>
<div class="container container-fluid">
    <h1><?php echo i18n::__('animal') ?></h1>
    <div class="row">
        <header>

        </header>
        <nav>

        </nav>
        <section>
            <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteSelect')?>" method="POST">
            <div>
                <a href="<?php echo routing::getInstance()->getUrlWeb('animal', 'insert') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new')?></a>
                <a href="javascript:eliminarMasivo()" class="btn btn-danger btn-xs" onclick="borrarSeleccion" data-toggle="modal" data-target="#myModalDeleteMasivo" id="btnDeleteMasivo"><?php echo i18n::__('delete')?></a>
            </div>
            <?php view::includeHandlerMessage() ?>
            <table class="table table-bordered table-responsive table-condensed">
                <thead>
                    <tr class="active">
                        <th><input type="checkbox" id="chkAll"></th>
                        <th><?php echo i18n::__('id') ?></th>
                        <th><?php echo i18n::__('name') ?></th>
                        <th><?php echo i18n::__('gender') ?></th>
                        <th><?php echo i18n::__('age') ?></th>
                        <th><?php echo i18n::__('weight') ?></th>
                        <th><?php echo i18n::__('date_entry') ?></th>
                        <th><?php echo i18n::__('number_births') ?></th>
                        <th><?php echo i18n::__('id_raza') ?></th>
                        <th><?php echo i18n::__('id_status') ?></th>
                        <th><?php echo i18n::__('action') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objAnimal as $animal): ?>
                        <tr>
                            <td><input type="checkbox" name="chk[]" value="<?php ?>"></td>
                            <td><?php echo $animal->$id ?></td>
                            <td><?php echo $animal->$nombre ?></td>
                            <td><?php echo $animal->$genero ?></td>
                            <td><?php echo $animal->$edad ?></td>
                            <td><?php echo $animal->$peso ?></td>
                            <td><?php echo $animal->$fecha_ingreso ?></td>
                            <td><?php echo $animal->$numero_partos ?></td>
                            <td><?php echo $animal->$id_raza ?></td>
                            <td><?php echo $animal->$id_estado ?></td>
                            <td>
                                <div class="btn btn-group btn-xs">
                                    <a href="<?php echo routing::getInstance()->getUrlWeb('animal', 'view', array(animalTableClass::ID => $animal->$id))?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                                    <a href="<?php echo routing::getInstance()->getUrlWeb('animal', 'edit', array(animalTableClass::ID => $animal->$id)) ?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#myModalDelete<?php echo $animal->$id ?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <!--Ventana MODAL-->
                    <div class="modal fade" id="myModalDelete<?php echo $animal->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirm_delete')?></h4>
                                </div>
                                <div class="modal-body">
                                 <?php echo i18n::__('Do you want to delete the record?')?> <?php echo $animal->$nombre ?> 
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close')?></button>
                                    <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $animal->$id ?>,'<?php echo animalTableClass::getNameField(animalTableClass::ID, TRUE)?>','<?php echo routing::getInstance()->getUrlWeb('animal', 'delete')?>')"><?php echo i18n::__('confirm')?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin de la ventana MODAL -->
                    <?php endforeach; ?> 
                </tbody>

            </table>
            </form> 
        </section>
        <footer>

        </footer>
    </div>
</div>
<!-- Ventana MODAL ELIMINAR MASIVO-->
<div class="modal fade" id="myModalDeleteMasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirm_delete')." ";echo i18n::__('selected_items') ?></h4>
      </div>
      <div class="modal-body">
        <?php echo i18n::__('Do you want to remove the selected records?')?>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close')?></button>
          <button type="button" class="btn btn-danger" onclick="$('#frmDeleteAll').submit()"><?php echo i18n::__('confirm')?></button>
      </div>
    </div>
  </div>
</div>
<!------------------------------------->