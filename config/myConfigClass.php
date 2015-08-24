<?php

namespace mvc\config {

  use mvc\config\configClass;
  
  /**
   * Description of myConfigClass
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class myConfigClass extends configClass {
    private static $cantidad;
    
    public static function getCantidad() {
        return self::$cantidad;
    }

    public static function setCantidad($cantidad) {
        self::$cantidad = $cantidad;
    }

    
}

}