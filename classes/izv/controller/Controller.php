<?php

namespace izv\controller;

use izv\app\App;
use izv\model\Model;
use izv\tools\Session;

class Controller {

    /*
    proceso general:
    1º control de sesión
    2º lectura de datos
    3º validación de datos
    4º usar el modelo
    5º producir resultado (para la vista)
    */

    private $model;
    private $sesion;

    function __construct(Model $model) {
        $this->model = $model;
        $this->sesion = new Session(App::SESSION_NAME);
        $this->getModel()->set('BASE', App::BASE);
    }
    
    function getModel() {
        return $this->model;
    }
    
    function getSession() {
        return $this->sesion;
    }
    
    function location($route, $alert=null, $ecode=null) {
        $ruta = '';
        if(isset($alert)) {
            $alerta = '';
            if(isset($ecode)) {
                $error = '&error=' . $ecode;
            }    
            $alerta = '?alerta=' . $alert . $error;
        }
        
        header('Location: ' . App::BASE . $route . $alerta);
        exit();
    }
    
    /* acciones */
    
    function main() {
        $this->getModel()->set('datos', 'datos que envía el método main');
    }

}