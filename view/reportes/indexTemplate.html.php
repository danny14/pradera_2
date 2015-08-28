<?php use mvc\routing\routingClass as routing; ?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view; ?>
<?php use mvc\config\configClass as config?>
<?php use mvc\request\requestClass as request?>
<?php use mvc\session\sessionClass as session?>
<?php $id = reporteTableClass::ID ;?>
<?php $nombre = reporteTableClass::NOMBRE ;?>
<?php $descripcion = reporteTableClass::DESCRIPCION ;?>
<?php $direccion = reporteTableClass::DIRECCION ;?>
<?php $created_at = reporteTableClass::CREATED_AT ;?>

<?php view::includePartial('animal/menuPrincipal'); ?>
<div class="container container-fluid">
    <div class="page page-header text-center">
        <h1><i class="fa fa-paw"><?php echo i18n::__('report') ?></i></h1>
    </div>
    <div class="row">
        <header>

        </header>
        <nav>
            
        </nav>
        <section>            
            <!--Formulario para el Cambio de Idiomas-->
            <?php view::includePartial('animal/formTraductor')?>
            <!-- Fin del Formulario de Cambio de Idiomas-->
            <div class="botones"></div>
            <form id="frmDeleteAll" action="<?php // echo routing::getInstance()->getUrlWeb('animal', 'deleteSelect') ?>" method="POST">
                    <?php view::includeHandlerMessage() ?>
                <table class="table table-bordered table-responsive table-condensed">
                    <thead>
                        <tr class="active">
                           
                            <th><?php echo i18n::__('name') ?></th>
                            <th><?php echo i18n::__('description') ?></th>
                            <th><?php echo i18n::__('address') ?></th>
                            <th><?php echo i18n::__('created_at') ?></th>
                            <th><?php echo i18n::__('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($objReporte as $reporte): ?>
                            <tr>
                                
                                <td><?php echo $reporte->$nombre ?></td>
                                <td><?php echo $reporte->$descripcion ?></td>
                                <td><?php echo $reporte->$direccion ?></td>
                                <td><?php echo $reporte->$created_at ?></td>
                                <td>
                                    <div class="btn btn-group btn-xs">
                                        <a href="<?php  echo routing::getInstance()->getUrlWeb('reportes','insert',array( reporteTableClass::ID => $reporte->$id)) ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?> 
                    </tbody>
                </table>
            </form>
            <div>
                Pagina<select id="sqlPaginador" onchange="paginador(this,'<?php echo routing::getInstance()->getUrlWeb('animal', 'index')?>')">
                    <?php for($x = 1;$x <= $cntPages;$x++):?>
                    <option <?php echo (isset($page) and $page == $x)? 'selected': '' ?> value="<?php echo $x?>"><?php echo $x?></option>
                    <?php endfor; ?>
                </select> de <?php echo $cntPages?>
                <!--
                <nav>
                <ul class="pagination">
                        <li>
                            <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li><a id="sqlPaginador" href="#" onclick="paginador(this)" value="1">1</a></li>
                        <li><a id="sqlPaginador" href="#" onclick="paginador(this)" value="2">2</a></li>
                        <li><a id="sqlPaginador" href="#" onclick="paginador(this)">3</a></li>
                        <li><a id="sqlPaginador" href="#" onclick="paginador(this)">4</a></li>
                        <li><a id="sqlPaginador" href="#" onclick="paginador(this)">5</a></li>
                        <li>
                            <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                    </nav>
                -->
            </div>
        </section>
        <footer>
            
        </footer>
    </div>
</div>