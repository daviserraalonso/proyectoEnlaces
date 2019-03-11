<?php

namespace izv\mvc;

class Router {
    
    //Establece las rutas del modelo, la vista y el controlador dependiendo de la ruta

    private $rutas, $ruta;
    
    function __construct($ruta) {
        $this->rutas = array(
            'index' => new Route('DefaultModel', 'DefaultView', 'DefaultController'),
            'admin' => new Route('AdminModel', 'AdminView' , 'AdminController'),
            'ajax'  => new Route('AdminModel', 'AjaxView', 'AjaxController')
        );
        $this->ruta = $ruta;
    }
    
    //Devuelve una instancia de la clase route
    function getRoute() {
        $ruta = $this->rutas['index'];
        if(isset($this->rutas[$this->ruta])) {
            $ruta = $this->rutas[$this->ruta];
        }
        return $ruta;
    }
}