<?php
/**@AUTOR:argenis zambrano
@category:modulo reporte parto
 *  */
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as bitacora;

class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $fecha_parto = trim(request::getInstance()->getPost(reportePartoTableClass::getNameField(reportePartoTableClass::FECHA_PARTO, true)));
        $n_animales_vi = trim(request::getInstance()->getPost(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_VI, true)));
        $n_animales_m = trim(request::getInstance()->getPost(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_M, true)));
        $n_machos = trim(request::getInstance()->getPost(reportePartoTableClass::getNameField(reportePartoTableClass::N_MACHOS, true)));
        $n_hembras = trim(request::getInstance()->getPost(reportePartoTableClass::getNameField(reportePartoTableClass::N_HEMBRAS, true)));
        $observaciones = trim(request::getInstance()->getPost(reportePartoTableClass::getNameField(reportePartoTableClass::OBSERVACIONES, true)));
        $id_animal = trim(request::getInstance()->getPost(reportePartoTableClass::getNameField(reportePartoTableClass::ID_ANIMAL, true)));
        
        $this->Validate($fecha_parto,$n_animales_vi,$n_animales_m,$n_machos,$n_hembras,$observaciones,$id_animal);
        
//      
        $data = array(
            reportePartoTableClass::FECHA_PARTO => $fecha_parto,
            reportePartoTableClass::N_ANIMALES_VI => $n_animales_vi,
            reportePartoTableClass::N_ANIMALES_M => $n_animales_m,
            reportePartoTableClass::N_MACHOS => $n_machos,
            reportePartoTableClass::N_HEMBRAS => $n_hembras,
            reportePartoTableClass::OBSERVACIONES => $observaciones,
            reportePartoTableClass::ID_ANIMAL => $id_animal,
        );


        reportePartoTableClass::insert($data);
        session::getInstance()->setSuccess('Los datos fueron registrados de forma exitosa');
//        bitacora::register('INSERTAR', reportePartoTableClass::getNameTable());
        routing::getInstance()->redirect('reporte_parto', 'index');
      } else {
        routing::getInstance()->redirect('reporte_parto', 'index');
      }
      /*
       * Limpia Variables en session correspondientes al formulario
       */
//      session::getInstance()->setAttribute('form_' . reportePartoTableClass::getNameTable(), NULL);
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError($exc->getMessage());
          break;
        case '22P02':
          session::getInstance()->setAction('error el compo debe ser numerico e ingreso letras');
          break;
          default :
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('reporte_parto', 'insert');
    }
  }
  private function Validate($fecha_parto,$n_animales_vi,$n_animales_m,$n_machos,$n_hembras,$observaciones,$id_animal){
    $flag = FALSE;
    $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
   
      
    if(preg_match($pattern,$fecha_parto) === FALSE){
        session::getInstance()->getError(in18::__('ErrorCharacterDate_delivery',NULL,array('%date_delivery%'=>$fecha_parto,'%character%'=> reportePartoTableClass::FECHA_PARTO )));
        $flag = TRUE;
        session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::FECHA_PARTO, TRUE), TRUE);
      }
      if($fecha_parto === '' or $fecha_parto === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%date_delivery%' => $fecha_parto,'%character%'=>  repoertePartoTableClass::FECHA_PARTO)));
          $flag = TRUE;
        session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::FECHA_PARTO, TRUE), TRUE);
        }
      if($flag === TRUE){
        request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('reporte_parto','insert');
        
      }
    
    if (is_numeric($n_animales_vi) === FALSE) {
        session::getInstance()->setError(i18n::__('ErrorCharacterN_animales_living', NULL,'default', array('%N_animales_living%' => $n_animales_vi,'%character%'=>  reportePartoTableClass::N_ANIMALES_VI)));
        $flag = TRUE;
        session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_VI, TRUE), TRUE);
        }
        if($n_animales_vi === '' or $n_animales_vi === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%N_animales_living%' => $n_animales_vi,'%character%'=>  repoertePartoTableClass::N_ANIMALES_VI)));
          $flag = TRUE;
        session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_VIVOS, TRUE), TRUE);
        }
  
      if (is_numeric($n_animales_m) === FALSE) {
        session::getInstance()->setError(i18n::__('ErrorCharacterN_animales_dead', NULL,'default', array('%N_animales_dead%' => $n_animales_m,'%character%'=>  reportePartoTableClass::N_ANIMALES_M)));
        $flag = TRUE;
        session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_M, TRUE), TRUE);
        }
        if($n_animales_m === '' or $n_animales_m === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%N_animales_dead%' => $n_animales_m,'%character%'=>  repoertePartoTableClass::N_ANIMALES_M)));
          $flag = TRUE;
        session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_M, TRUE), TRUE);
        }
        
        if (is_numeric($n_machos) === FALSE) {
        session::getInstance()->setError(i18n::__('ErrorCharacterN_males', NULL,'default', array('%N_males%' => $n_machos,'%character%'=>  reportePartoTableClass::N_MACHOS)));
        $flag = TRUE;
        session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_MACHOS, TRUE), TRUE);
        }
        if($n_machos === '' or $n_machos === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%N_males%' => $n_machos,'%character%'=>  repoertePartoTableClass::N_MACHOS)));
          $flag = TRUE;
        session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_MACHOS, TRUE), TRUE);
        }
        
        if (is_numeric($n_hembras) === FALSE) {
        session::getInstance()->setError(i18n::__('ErrorCharacterN_females', NULL,'default', array('%N_females%' => $n_hembras,'%character%'=>  reportePartoTableClass::N_HEMBRAS)));
        $flag = TRUE;
        session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_HEMBRAS, TRUE), TRUE);
        }
        if($n_hembras === '' or $n_hembras === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%N_females%' => $n_hembras,'%character%'=>  repoertePartoTableClass::N_HEMBRAS)));
          $flag = TRUE;
        session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_HEMBRAS, TRUE), TRUE);
        }
        
//        if (strlen($observaciones) > reportePartoTableClass::OBSERVACIONES) {
//                    throw new PDOException('el nombre no puede ser mayor a ' . reportePartoTableClass::OBSERVACIONES . ' caracteres');
//                }
//       
        if (!is_numeric($id_animal)) {
        session::getInstance()->setError(i18n::__('ErrorCharacterId_animal', NULL, array('%id_animal%'=>$id_animal,'%character%'=>  reportePartoTableClass::ID_ANIMAL)));
        $flag = TRUE;
        session::getInstance()->setFlash(registroCeloTableClass::getNameField(reportePartoTableClass::ID_ANIMAL, TRUE), TRUE);
        }
        if($id_animal === '' or $id_animal === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%id_animal%' => $id_animal,'%character%'=>  reportePartoTableClass::ID_ANIMAL)));
          $flag = TRUE;
        session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::ID_ANIMAL, TRUE), TRUE);
        }

        

  }

}
