<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as bitacora;

class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID, true));
        $cantidad = request::getInstance()->getPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::CANTIDAD, true));
        $id_salida_bodega = request::getInstance()->getPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_SALIDA_BODEGA, true));
        $id_insumo = request::getInstance()->getPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_INSUMO, true));
        $id_tipo_insumo = request::getInstance()->getPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_TIPO_INSUMO, true));
        
        $this->Validate($cantidad,$id_salida_bodega,$id_insumo,$id_tipo_insumo);
        
        $ids = array(
            detalleSalidaTableClass::ID => $id
        );
        $data = array(
            detalleSalidaTableClass::CANTIDAD => $cantidad,
            detalleSalidaTableClass::ID_SALIDA_BODEGA => $id_salida_bodega,
            detalleSalidaTableClass::ID_INSUMO => $id_insumo,
            detalleSalidaTableClass::ID_TIPO_INSUMO => $id_tipo_insumo,
        );

        detalleSalidaTableClass::update($ids, $data);
        session::getInstance()->setSuccess('Los elementos seleccionados fueron modificados de forma exitosa');
//           bitacora::register('MODIFICAR', detalleSalidaTableClass::getNameTable());
      }
      routing::getInstance()->redirect('detalle_salida', 'index');
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo "<br>";
      echo $exc->getTraceAsString();
    }
  }

  private function Validate($cantidad, $id_salida_bodega, $id_insumo, $id_tipo_insumo) {
    $flag = FALSE;
//    $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";


   if (is_numeric($cantidad) === FALSE) {
        session::getInstance()->setError(i18n::__('ErrorCharacterQuantity', NULL,'default', array('%Quantity%' => $cantidad,'%character%'=>  detalleSalidaTableClass::CANTIDAD)),'errorCantidad');
        $flag = TRUE;
        session::getInstance()->setFlash(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::CANTIDAD, TRUE), TRUE);
        }
        if($cantidad === '' or $cantidad === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%Quantity%' => $cantidad,'%character%'=>  detalleSalidaTableClass::CANTIDAD)),'errorCantidad');
          $flag = TRUE;
        session::getInstance()->setFlash(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::CANTIDAD, TRUE), TRUE);
        }
      if($cantidad < 0){
          session::getInstance()->setError(i18n::__('ErrorNumberNegative', NULL,'default', array('%number%' => $cantidad)),'errorCantidad');
          $flag = TRUE;
        session::getInstance()->setFlash(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::CANTIDAD, TRUE), TRUE);
        }
        if(strlen($cantidad) > 3){
          session::getInstance()->setError(i18n::__('ErrorCharacter', NULL,'default', array('%number%' => $cantidad)),'errorCantidad');
          $flag = TRUE;
        session::getInstance()->setFlash(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::CANTIDAD, TRUE), TRUE);
        }
  
      if (is_numeric($id_salida_bodega) === FALSE) {
        session::getInstance()->setError(i18n::__('ErrorCharacterId_salida_bodega', NULL,'default', array('%Id_salida_bodega%' => $id_salida_bodega,'%character%'=>  detalleSalidaTableClass::ID_SALIDA_BODEGA)),'errorSalidaBodega');
        $flag = TRUE;
        session::getInstance()->setFlash(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_SALIDA_BODEGA, TRUE), TRUE);
        }
        if($id_salida_bodega === '' or $id_salida_bodega === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%N_animales_dead%' => $id_salida_bodega,'%character%'=>  detalleSalidaTableClass::ID_SALIDA_BODEGA)),'errorSalidaBodega');
          $flag = TRUE;
        session::getInstance()->setFlash(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_SALIDA_BODEGA, TRUE), TRUE);
        }
        if($id_salida_bodega < 0){
          session::getInstance()->setError(i18n::__('ErrorNumberNegative', NULL,'default', array('%number%' => $id_salida_bodega)),'errorSalidaBodega');
          $flag = TRUE;
        session::getInstance()->setFlash(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_SALIDA_BODEGA, TRUE), TRUE);
        }
        
        if (is_numeric($id_insumo) === FALSE) {
        session::getInstance()->setError(i18n::__('ErrorCharacterId_input', NULL,'default', array('%Id_input%' => $id_insumo,'%character%'=>  detalleSalidaTableClass::ID_INSUMO)),'errorInsumo');
        $flag = TRUE;
        session::getInstance()->setFlash(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_INSUMO, TRUE), TRUE);
        }
        if($id_insumo === '' or $id_insumo === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%Id_input%' => $id_insumo,'%character%'=>  detalleSalidaTableClass::ID_INSUMO)),'errorInsumo');
          $flag = TRUE;
        session::getInstance()->setFlash(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_INSUMO, TRUE), TRUE);
        }
        if($id_insumo < 0){
          session::getInstance()->setError(i18n::__('ErrorNumberNegative', NULL,'default', array('%number%' => $id_insumo)),'errorInsumo');
          $flag = TRUE;
        session::getInstance()->setFlash(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_INSUMO, TRUE), TRUE);
        }
        
        if (is_numeric($id_tipo_insumo) === FALSE) {
        session::getInstance()->setError(i18n::__('ErrorCharacterId_type_input', NULL,'default', array('%Id_type_input%' => $id_tipo_insumo,'%character%'=>  detalleSalidaTableClass::ID_TIPO_INSUMO)),'errorTipoInsumo');
        $flag = TRUE;
        session::getInstance()->setFlash(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_TIPO_INSUMO, TRUE), TRUE);
        }
        if($id_tipo_insumo === '' or $id_tipo_insumo === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%Id_type_input%' => $id_tipo_insumo,'%character%'=>  detalleSalidaTableClass::ID_TIPO_INSUMO)),'errorTipoInsumo');
          $flag = TRUE;
        session::getInstance()->setFlash(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_TIPO_INSUMO, TRUE), TRUE);
        }
        if($id_tipo_insumo < 0){
          session::getInstance()->setError(i18n::__('ErrorNumberNegative', NULL,'default', array('%number%' => $id_tipo_insumo)),'errorTipoInsumo');
          $flag = TRUE;
        session::getInstance()->setFlash(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_TIPO_INSUMO, TRUE), TRUE);
        }
        if ($flag === TRUE) {
      request::getInstance()->setMethod('GET');
      request::getInstance()->addParamGet(array(detalleSalidaTableClass::ID => request::getInstance()->getPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID, TRUE))));
      routing::getInstance()->forward('detalle_salida', 'edit');
       }
        

  }

}
