<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class viewActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = NULL;
//            if(request::getInstance()->hasPost('filter') and request::getInstance()->isMethod('POST')){
//                $filter = request::getInstance()->getPost('filter');
//                /**
//                 * Validacion de los filtros
//                 */
//                $nombre = $filter['nombre'];
//                $fecha_ini = $filter['fechaCreacion1'];
//                $fecha_fin = $filter['fechaCreacion2'];
//                $hora_ini = $filter['horaCreacion1'];
//                $hora_fin  = $filter['horaCreacion2'];
//                
//                $this->Validate($nombre,$fecha_ini,$fecha_fin,$hora_ini,$hora_fin);
//                
//                if(isset($filter['nombre']) and $filter['nombre'] !== NULL and $filter['nombre'] !== ''){
//                    $where[animalTableClass::NOMBRE] = $filter['nombre'];
//                }
//                if(isset($filter['fechaCreacion1']) and $filter['fechaCreacion1'] !== NULL and $filter['fechaCreacion1'] !== '' and isset($filter['fechaCreacion2']) and $filter['fechaCreacion2'] !== NULL and $filter['fechaCreacion2'] !== ''){
//                    $where[animalTableClass::FECHA_INGRESO] = array(
//                        $filter['fechaCreacion1'],
//                        $filter['fechaCreacion2']
////                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion1']. ' 00:00:00')) se puede de dos maneras
////                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion2']. ' 23:59:59'))
//                    );
//                }
//                session::getInstance()->setAttribute('detalleEntradaIndexFilters', $where);
//            } else if(session::getInstance()->hasAttribute('detalleEntradaIndexFilters')){
//            $where = session::getInstance()->getAttribute('detalleEntradaIndexFilters');
//            }
            $entradaBodegaId = request::getInstance()->getRequest(entradaBodegaTableClass::ID, TRUE);
            if(request::getInstance()->hasRequest(entradaBodegaTableClass::ID)){
            $fields = array(
            entradaBodegaTableClass::ID,
            entradaBodegaTableClass::FECHA,
            entradaBodegaTableClass::HORA,
            entradaBodegaTableClass::ID_TRABAJADOR,
            entradaBodegaTableClass::ID_PROVEEDOR
            );
            $whereEntrada = array(
            entradaBodegaTableClass::ID => $entradaBodegaId
            );
            $this->objEntradaBodega = entradaBodegaTableClass::getAll($fields, FALSE, NULL, NULL, NULL, NULL, $whereEntrada);
            
            $fields = array(
            detalleEntradaTableClass::ID,
            detalleEntradaTableClass::VALOR,
            detalleEntradaTableClass::ID_ENTRADA_BODEGA,
            detalleEntradaTableClass::ID_INSUMO,
            detalleEntradaTableClass::ID_TIPO_INSUMO,
            );
            $where = array(
            detalleEntradaTableClass::ID_ENTRADA_BODEGA => $entradaBodegaId
            );
            $orderBy = array(
            detalleEntradaTableClass::ID
            );
            $page = 0;
            if(request::getInstance()->hasGet('page')){
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $this->cntPages = detalleEntradaTableClass::getTotalPages(config::getRowGrid(),$where);
            $this->objDetalleEntrada = detalleEntradaTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, $where);
            $this->defineView('view', 'detalle_entrada', session::getInstance()->getFormatOutput());
            }else{
                session::getInstance()->setError('Error no se pudo visualizar correctamente');
                routing::getInstance()->redirect('detalle_entrada', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
