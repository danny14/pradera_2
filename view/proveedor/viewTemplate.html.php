<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php $id = proveedorTableClass::ID ?>
<?php $nombre =proveedorTableClass::NOMBRE ?>
<?php $apellido =proveedorTableClass::APELLIDO ?>
<?php $direccion =proveedorTableClass::DIRECCION ?>
<?php $telefono =proveedorTableClass::TELEFONO ?>
<?php $correo = proveedorTableClass::CORREO?>
<?php $id_ciudad =proveedorTableClass::ID_CIUDAD ?>
<?php view::includePartial('animal/menuPrincipal')?>
<?php view::includePartial('animal/formTraductor')?>
<div class="container container-fluid">
    <h1><?php echo i18n::__('provider')?></h1>
    <h1<i class="fa fa-smile-o"><?php echo i18n::__('provider') ?></i></h1>
    <div class="row" >
        <header>
            
        </header>
        <nav>
            
        </nav>
        <section>
            <table class="table table-bordered table-responsive table-striped table-condensed">
                <thead>
                    <tr>
                        <th><?php echo i18n::__('name')?></th>
                        <th><?php echo i18n::__('last_name')?></th>
                        <th><?php echo i18n::__('address')?></th>
                        <th><?php echo i18n::__('phone')?></th>
                        <th><?php echo i18n::__('mail')?></th>
                        <th><?php echo i18n::__('id_city')?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objProveedor as $proveedor): ?>
                    <tr>
                        <td><?php echo $proveedor->$nombre?></td>
                        <td><?php echo $proveedor->$apellido?></td>
                        <td><?php echo $proveedor->$direccion?></td>
                        <td><?php echo $proveedor->$telefono?></td>
                        <td><?php echo $proveedor->$correo?></td>
                        <td><?php echo proveedorTableClass::getNameFieldForaneaCiudad($proveedor->$id_ciudad)?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
                <tfoot></tfoot>
            </table>
            <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'index')?>"><i class="fa fa-hand-o-left"> <?php echo i18n::__('return')?></i></a>
        </section>
        <footer>
            
        </footer>
    </div>
</div>

       



