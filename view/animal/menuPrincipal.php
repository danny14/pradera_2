<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\session\sessionClass as session?>
<?php use mvc\request\requestClass as request?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
      </button>
      <a class="navbar-brand" href="#">Corral de Piedras</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Animal <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('animal', 'index')?>">Animal</a></li>
            <li class="divider"></li>
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('estado', 'index')?>">Estado</a></li>
            <li class="divider"></li>
          </ul>
        </li>
      </ul>
        <!-- Modulo Trabajador -->
       <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Trabajador <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('trabajador', 'index')?>">Trabajador</a></li>
            <li class="divider"></li>
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('ciudad', 'index')?>">Ciudad</a></li>
            <li class="divider"></li>
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('credencial', 'index')?>">Credencial</a></li>
            <li class="divider"></li>
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('turno', 'index')?>">Turno</a></li>
            <li class="divider"></li>
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('pago_trabajadores', 'index')?>">Pago Trabajadores</a></li>
          </ul>
        </li>
      </ul>
        <!-- Fin Modulo -->
        <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Fecundador <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
              <li><a href="<?php  echo routing::getInstance()->getUrlWeb('fecundador', 'index')?>">Fecundador</a></li>
            <li class="divider"></li>
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('raza', 'index')?>">Raza</a></li>
            <li class="divider"></li>
          </ul>
        </li>
      </ul>
<!-- Modulo Proveedor -->
       <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Proveedor <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('proveedor', 'index')?>">Proveedor</a></li>
          </ul>
        </li>
      </ul>
        <!-- Fin Modulo -->
<!-- Modulo Ordeño -->
       <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Ordeño <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('ordenno', 'index')?>">Ordeño</a></li>
          </ul>
        </li>
      </ul>
        <!-- Fin Modulo -->
        <!-- Modulo Bodega -->
       <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Bodega <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('entrada_bodega', 'index')?>">Entrada Bodega</a></li>
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('salida_bodega', 'index')?>">Salida Bodega</a></li>
          </ul>
        </li>
      </ul>
        <!-- Fin Modulo -->
        <!-- Modulo Registro Vacunacion -->
       <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Registro Vacunacion <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('registro_vacunacion', 'index')?>">Registro Vacunacion</a></li>
          </ul>
        </li>
      </ul>
        <!-- Fin Modulo -->
        <!-- Modulo Reportes -->
       <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Reportes <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('reportes', 'index')?>">Reportes</a></li>
          </ul>
        </li>
      </ul>
        <!-- Fin Modulo -->
        <!-- Modulo Registro celo, Reporte Parto -->
        <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Registro Celo <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('registro_celo', 'index')?>">Registro Celo</a></li>
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('reporte_parto', 'index')?>">Reporte Parto</a></li>
            <!--<li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
            -->
          </ul>
        </li>
      </ul>
        <!-- Fin Modulo -->
         <!-- Modulo Insumo, Tipo Insumo -->
        <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Insumo <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('insumo', 'index')?>">Insumo</a></li>
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('tipo_insumo', 'index')?>">Tipo Insumo</a></li>
            <!--<li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
            -->
          </ul>
        </li>
      </ul>
        <!-- Fin Modulo -->
      <ul class="nav navbar-nav navbar-right">
        <!--<li><a href="#">Link</a></li>-->
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> <?php echo session::getInstance()->getUserName() ?> <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
              <li><a href="#"><i class="fa fa-wrench">Ajustes</i></a></li>
              <li><a href="<?php// echo routing::getInstance()->getUrlWeb('default', 'traductor', array('language' => 'es', 'PATH_INFO' => request::getInstance()->getServer('PATH_INFO'), 'QUERY_STRING' => htmlentities(request::getInstance()->getServer('QUERY_STRING')))) ?>"><img src="<?php echo routing::getInstance()->getUrlImg('xp_spain.ico') ?>"></a>
              <li><a href="<?php// echo routing::getInstance()->getUrlWeb('default', 'traductor', array('language' => 'en', 'PATH_INFO' => request::getInstance()->getServer('PATH_INFO'), 'QUERY_STRING' => htmlentities(request::getInstance()->getServer('QUERY_STRING')))) ?>"><img src="<?php echo routing::getInstance()->getUrlImg('xp_usa.ico') ?>"></a></li>
            <li class="divider"></li>
            <li><a href="<?php echo routing::getInstance()->getUrlWeb('shfSecurity', 'logout')?>"><i class="fa fa-sign-out"><?php echo i18n::__('logout')?></i></a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
