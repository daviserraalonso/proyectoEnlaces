<?php

namespace izv\controller;

use izv\app\App;
use izv\model\Model;
use izv\tools\Session;
use izv\tools\Util;
use izv\tools\Reader;
use izv\data\Usuario;
use izv\tools\Mail;

class DefaultController extends Controller {

    function __construct(Model $model) {
        parent::__construct($model);
        //...
    }

    function dologin() {
        
        if($this->getSession()->isLogged()) {
            header('Location: ' . App::BASE . 'index?op=login&r=session');
            exit();
        }
        
        $user = Reader::read('correo');
        $clave= Reader::read('clave');
    
        $login = $this->getModel()->login($user, $clave);

        if($login) {
            $this->getSession()->login($login);
            $this->location('admin/main', 'login', 1);
        } else {
            $this->location('index/login', 'login', 0);
        }
    }

    
    function dologout() {
        $this->getSession()->logout();
        header('Location: ' . App::BASE . 'index');
        exit();
    }
    

    function doregister() {
        if ($this->getSession()->isLogged()) {
            header('Location: https://dwse-scorpions.c9users.io/proyectoMVC/');
            exit(); 
        }
        $usuario = Reader::readObject('izv\data\Usuario');

        //3º validación de datos
        if($usuario->getClave() == '' || mb_strlen($usuario->getClave()) < 3) {
            //5º producir resultado -> redirección
            header('Location: ' . App::BASE . 'index/vregistro?op=register&r=password');
            exit();
        }

        //4º usar el modelo
        $usuario->setClave(Util::encriptar($usuario->getClave()));
        $usuario->setActivo(false);
        $usuario->setAdministrador(false);

        $r = $this->getModel()->register($usuario);

        if ($r > 0) {
            if($usuario->getId() != null) {
                Mail::sendActivation($usuario);
            } else {
                header('Location: index/vregistro?op=register&r=mail');
                exit;
            }
        }
        //5º producir resultado -> redirección
        header('Location: ' . App::BASE . 'index/vregistro?op=register&r=' . $r);
        exit();
    }
    
    function activar() {
        
        if ($this->getSession()->isLogged()) {
           header('Location: ../user/dologout');
            exit; 
        }
        
        $id = Reader::read('id');
        $code = Reader::read('code');
        
        $resultado = $this->getModel()->activar($code, $id);
        
        $url = 'index?op=activate&r=' . $resultado;
    
        header('Location: ' . $url);
        exit();
    }

    function login() {
        if(!$this->getSession()->isLogged()) {
            $this->getModel()->set('twigFile', '_login.html');
        }
    }

    function main() {
        $this->getModel()->set('twigFile', '_main.html');
    }


    function register() {
        if(!$this->getSession()->isLogged()) {
            $this->getModel()->set('twigFile', '_register.html');
        }
    }
    
    function category() {
        if(!$this->getSession()->isLogged()) {
            $this->getModel()->set('twigFile', '_category.html');
        }
    }
}