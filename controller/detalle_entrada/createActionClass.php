<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as bitacora;

/*
 * @author: Danny Steven Ruiz Hernandez
 * @date: 10/03/2015
 * @static:
 * @abstract
 * @category:
 */
class createActionClass extends controllerClass implements controllerActionInterface {
      /* public function execute inicializa las variables 
     * @return $valor=> valor (integer)
     * @return $id_entrada=> id_entrada (integer)
     * @return $id_insumo=> id_insumo (integer)
     * @return $id_tipo_insumo=> id_tipo_insumo(integer)
     * todas estos datos se pasa en la varible @var $data
     * ** */

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                $valor = trim(request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, true)));
                $id_entrada = strtoupper(trim(request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID_ENTRADA_BODEGA, true))));
                $id_insumo = trim(request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID_INSUMO, true)));
                $id_tipo_insumo = trim(request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID_TIPO_INSUMO, true)));
                
                $this->Validate($valor,$id_entrada,$id_insumo,$id_tipo_insumo);

                $data = array(
                    detalleEntradaTableClass::VALOR => $valor,
                    detalleEntradaTableClass::ID_ENTRADA_BODEGA => $id_entrada,
                    detalleEntradaTableClass::ID_INSUMO => $id_insumo,
                    detalleEntradaTableClass::ID_TIPO_INSUMO => $id_tipo_insumo
                );

                detalleEntradaTableClass::insert($data);
                session::getInstance()->setSuccess('Los datos fueron registrados de forma exitosa');
                bitacora::register('Insertar', detalleEntradaTableClass::getNameTable());
                routing::getInstance()->redirect('detalle_entrada', 'view', array('id' => $id_entrada));
            } else {
                routing::getInstance()->redirect('detalle_entrada', 'index');
            }
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                // 42601
                case 23505:
                    session::getInstance()->setError(i18n::__('23505'));
//                    session::getInstance()->setError($exc->getMessage());
                break;
                case 42601:
                    session::getInstance()->setError(i18n::__('42601'));
                    break;
                default :
                    session::getInstance()->setError($exc->getMessage());
                break;
            }
//            routing::getInstance()->redirect('animal', 'insert');
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');            
        }
    }
    /**
     * Validaciones para el Animal o Hoja de vida
     */
    private function Validate($valor,$id_entrada,$id_insumo,$id_tipo_insumo) {
        $flag = FALSE;
//        $pattern="/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        
       // VALIDACION PARA VALOR 
    if (is_numeric($valor) === FALSE) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, 'default', array('%value%' => $valor, '%character%' => detalleEntradaTableClass::VALOR)), 'errorValorHora');
      $flag = TRUE;
      session::getInstance()->setFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, TRUE), TRUE);
    }
    if ($valor === '' or $valor === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%value%' => $valor, '%character%' => detalleEntradaTableClass::VALOR)), 'errorValorHora');
      $flag = TRUE;
      session::getInstance()->setFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, TRUE), TRUE);
    }
    if ($valor < 0) {
      session::getInstance()->setError(i18n::__('errorNumberNegative', NULL, 'default', array('%number%' => $valor)), 'errorValorHora');
      $flag = TRUE;
      session::getInstance()->setFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, TRUE), TRUE);
    }
    if (strlen($valor) > 10) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, 'default', array('%number%' => $valor)), 'errorValorHora');
      $flag = TRUE;
      session::getInstance()->setFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, TRUE), TRUE);
    }
    // FIN VALIDACION PARA VALOR 
    // VALIDACION PARA ENTRADA BODEGA
    if (is_numeric($id_entrada) === FALSE) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, 'default', array('%id_entrada%' => $id_entrada, '%character%' => detalleEntradaTableClass::ID_ENTRADA_BODEGA)), 'errorEntradaBodega');
      $flag = TRUE;
      session::getInstance()->setFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID_ENTRADA_BODEGA, TRUE), TRUE);
    }
    if ($id_entrada === '' or $id_entrada === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%id_entrada%' => $id_entrada, '%character%' => detalleEntradaTableClass::ID_ENTRADA_BODEGA)), 'errorEntradaBodega');
      $flag = TRUE;
      session::getInstance()->setFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID_ENTRADA_BODEGA, TRUE), TRUE);
    }
    if ($id_entrada < 0) {
      session::getInstance()->setError(i18n::__('errorNumberNegative', NULL, 'default', array('%number%' => $id_entrada)), 'errorEntradaBodega');
      $flag = TRUE;
      session::getInstance()->setFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID_ENTRADA_BODEGA, TRUE), TRUE);
    }
    // FIN VALIDACION PARA SALIDA BODEGA
    // VALIDACION PARA INSUMO
    if (is_numeric($id_insumo) === FALSE) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, 'default', array('%Id_input%' => $id_insumo, '%character%' => detalleEntradaTableClass::ID_INSUMO)), 'errorInsumo');
      $flag = TRUE;
      session::getInstance()->setFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID_INSUMO, TRUE), TRUE);
    }
    if ($id_insumo === '' or $id_insumo === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%Id_input%' => $id_insumo, '%character%' => detalleEntradaTableClass::ID_INSUMO)), 'errorInsumo');
      $flag = TRUE;
      session::getInstance()->setFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID_INSUMO, TRUE), TRUE);
    }
    if ($id_insumo < 0) {
      session::getInstance()->setError(i18n::__('errorNumberNegative', NULL, 'default', array('%number%' => $id_insumo)), 'errorInsumo');
      $flag = TRUE;
      session::getInstance()->setFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID_INSUMO, TRUE), TRUE);
    }
    // FIN VALIDACION PARA INSUMO
    // VALIDACION PARA TIPO INSUMO
    if (is_numeric($id_tipo_insumo) === FALSE) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, 'default', array('%Id_type_input%' => $id_tipo_insumo, '%character%' => detalleEntradaTableClass::ID_TIPO_INSUMO)), 'errorTipoInsumo');
      $flag = TRUE;
      session::getInstance()->setFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID_TIPO_INSUMO, TRUE), TRUE);
    }
    if ($id_tipo_insumo === '' or $id_tipo_insumo === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%Id_type_input%' => $id_tipo_insumo, '%character%' => detalleEntradaTableClass::ID_TIPO_INSUMO)), 'errorTipoInsumo');
      $flag = TRUE;
      session::getInstance()->setFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID_TIPO_INSUMO, TRUE), TRUE);
    }
    if ($id_tipo_insumo < 0) {
      session::getInstance()->setError(i18n::__('errorNumberNegative', NULL, 'default', array('%number%' => $id_tipo_insumo)), 'errorTipoInsumo');
      $flag = TRUE;
      session::getInstance()->setFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID_TIPO_INSUMO, TRUE), TRUE);
    }
    // FIN VALIDACION PARA TIPO INSUMO 
        if($flag === TRUE){
            request::getInstance()->setMethod('GET'); //POST
            routing::getInstance()->forward('detalle_entrada', 'insert');
        }
    }

}
