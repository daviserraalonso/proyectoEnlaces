<?php

namespace izv\controller;

use izv\app\App;
use izv\data\Usuario;
use izv\model\Model;
use izv\tools\Reader;
use izv\tools\Session;
use izv\tools\Util;

class AdminController extends Controller {

    function __construct(Model $model) {
        parent::__construct($model);
        //...
    }
    
    private function loadUser() {
        if (!$this->getSession()->isLogged()) {
            $this->location('index', 'sesion');
        }
        // Cargar el usuario
        $this->getModel()->set('user', $this->getSession()->getLogin());
    }

    function main() {
        // Comprobacion y carga del usuario
        $this->loadUser();
        // Seleccionamos la plantilla
        $this->getModel()->set('twigFile', 'index.html');
    }
    
    
    function category() {
        // Seleccionamos la plantilla
        $this->getModel()->set('twigFile', '_category.html');
    }
    
    function usuarios() {
        if($this->getSession()->isLogged() && $this->getSession()->isRoot()) {
            
            $pagina = Reader::read('pagina');
            if($pagina === null || !is_numeric($pagina)) {
                $pagina =1;
            }
            
            $orden = Reader::read('orden');
            $ordenes = array(
                'id' => 'id',
                'correo' => 'correo',
                'alias' => 'alias',
                'nombre' => 'nombre',
                'fechaalta' => 'fecha'
            );
            if(!isset($ordenes[$orden])) {
                $orden='id';
            }
            $filter = Reader::read('filtro');
            
            $r = $this->getModel()->getUsers($pagina, $orden, $filter);
            $this->getModel()->add($r);
            
            $this->getModel()->set('placeholder', 'Usuario');
            $this->getModel()->set('admin', $this->getSession()->isRoot() ? true : false);
            //$this->getModel()->set('usuarios', $this->getModel()->getUsers());
            $this->getModel()->set('twigFile', '_usuarios.html');
        } else {
            if ($this->getSession()->isLogged()) {
                header('Location: ../user');
                exit();
            } else {
                header('Location: ../index');
                exit();
            }
        }
    }
    
    function delete() {
        if($this->getSession()->isLogged() && $this->getSession()->isRoot()) {
            $id = Reader::read('id');
            $resultado = $this->getModel()->dodelete($id);
            header('Location: user/usuarios?resultado='.$resultado);
                exit;
        } else {
            if ($this->getSession()->isLogged()) {
                header('Location: ../user');
                exit();
            } else {
                header('Location: ../index');
                exit();
            }
        }
    }
    
    function deletetemporal() {
        if($this->getSession()->isLogged() && $this->getSession()->isRoot()) {
            $id = Reader::read('id');
            $resultado = $this->getModel()->dodeletetemporal($id);
            header('Location: user/usuarios?resultado='.$resultado);
                exit;
        } else {
            if ($this->getSession()->isLogged()) {
                header('Location: ../user');
                exit();
            } else {
                header('Location: ../index');
                exit();
            }
        }
        
        
    }
    
    function editself() {
        if($this->getSession()->isLogged() && $this->getSession()->isRoot()) {
            $usuario = $this->getSession()->getLogin();
            $this->getModel()->set('user_data', $usuario);
            $this->getModel()->set('twigFile', '_editself.html');
        } else {
            if ($this->getSession()->isLogged()) {
                header('Location: ../user');
                exit();
            } else {
                header('Location: ../index');
                exit();
            }
        }
    }
    
    function edit() {
        if($this->getSession()->isLogged() && $this->getSession()->isRoot()) {
            $id = Reader::read('id');
            $usuario = $this->getModel()->getUser($id);
            $this->getModel()->set('user_data', $usuario);
            $this->getModel()->set('twigFile', '_edit.html');
        } else {
            if ($this->getSession()->isLogged()) {
                header('Location: ../user');
                exit();
            } else {
                header('Location: ../index');
                exit();
            }
        }
    }
    
    function doedit() {
        if($this->getSession()->isLogged() && $this->getSession()->isRoot()) {
            $id = Reader::read('id');
            $resultado = $this->getModel()->doedit($id);
    
            header('Location: admin/usuarios?resultado=' . $resultado);
            exit;
        } else {
            if ($this->getSession()->isLogged()) {
                header('Location: ../user');
                exit();
            } else {
                header('Location: ../index');
                exit();
            }
        }
    }
    
    function doeditself(){
        if($this->getSession()->isLogged() && $this->getSession()->isRoot()) {
            $id = Reader::read('id');
            $resultado = $this->getModel()->doeditself($id);
    
            header('Location: admin/usuarios?resultado=' . $resultado);
            exit;
        } else {
            if ($this->getSession()->isLogged()) {
                header('Location: ../user');
                exit();
            } else {
                header('Location: ../index');
                exit();
            }
        }
        
        
    }
}