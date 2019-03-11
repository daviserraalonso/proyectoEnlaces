<?php

    namespace izv\controller;
    
    use izv\app\App;
    use izv\model\Model;
    use izv\tools\Reader;
    use izv\tools\Session;
    use izv\tools\Util;
    
    class AjaxController extends Controller {

        function listaLinka(){
            $pag = Reader::read('pagina');
            $orden = Reader::read('orden');
            $filtro = Reader::read('filtro');
            
            $this->getModel()->set('twigFile', 'panel.html');
            
            if($pag === null || $pag === '') {
                $pag=1;
            }
            
            if($orden === null || $orden === '') {
                $orden='id';
            }
            
            $links = $this->getModel()->doListLinks($pag, $orden, $filtro);
            $this->getModel()->add($links);
        }
        
        function listaCategorias(){
            $pag = Reader::read('pagina');
            $orden = Reader::read('orden');
            $filtro = Reader::read('filtro');
            
            $this->getModel()->set('twigFile', '_category.html');
            
            if($pag === null || $pag === '') {
                $pag=1;
            }
            
            if($orden === null || $orden === '') {
                $orden='id';
            }
            
            $categoria = $this->getModel()->doListCategories($pag, $orden, $filtro);
            $this->getModel()->add($categoria);
        }
        
        // inserto categoria
        function addCategory() {
            if (!$this->getSession()->isLogged()) {
                header('Location: https://dwse-scorpions.c9users.io/proyectoMVC/');
                exit(); 
            }
            $categoria = Reader::readObject("izv\data\Categoria");
            $categoria->setIdUsuario($this->getSession()->getLogin()->getId());
            $resultado = $this->getModel()->doaddCategory($categoria);
            $this->getModel()->set('alta', $resultado);
        }
        
        
        
        
        function listcat() {
            $this->getModel()->set('twigFile', 'panel.html');
            $idusuario = $this->getSession()->getLogin()->getId();
            $cats = $this->getModel()->doListCat($idusuario);
            $this->getModel()->add($cats);
        }
        
        function comprobarcat() {
            $categoria = Reader::read('nombre');
            $available = 0;
            if($categoria !== null && $categoria !== '') {
                $available = $this->getModel()->catAvailable($categoria);
            }
            $this->getModel()->set('catdisponible', $available);
        }
        
        function comprobarlink() {
            $link = Reader::read('href');
            $available = 0;
            if($link !== null && $link !== '') {
                $available = $this->getModel()->linkAvailable($link, $this->getSession()->getLogin()->getId());
            }
            $this->getModel()->set('linkdisponible', $available);
        }
        
        function comprobartitulo() {
            $titulo = Reader::read('titulo');
            $available = 0;
            if($titulo !== null && $titulo !== '') {
                $available = $this->getModel()->tituloAvailable($titulo, $this->getSession()->getLogin()->getId());
            }
            $this->getModel()->set('titulodisponible', $available);
        }
        
        function addcat() {
            $categoria = Reader::readObject("izv\data\Categoria");
            $categoria->setIdUsuario($this->getSession()->getLogin()->getId());
            $resultado = $this->getModel()->doaddCategory($categoria);
            $this->getModel()->set('alta', $resultado);
        }
        
        function addlink() {
            $linka = Reader::readObject("izv\data\Link");
            $linka->setIdUsuario($this->getSession()->getLogin()->getId());
            $resultado = $this->getModel()->doaddLink($linka);
            $this->getModel()->set('alta', $resultado);
        }
        
        function delcat() {
            $id = Reader::read("id");
            $resultado = $this->getModel()->dodelCat($id);
            $this->getModel()->set('alta', $resultado);
        }
        
        function dellink() {
            $id = Reader::read("id");
            $resultado = $this->getModel()->dodelLink($id);
            $this->getModel()->set('alta', $resultado);
        }
        
        
        function main(){
            $this->getModel()->set('main', true);
        }
        
         
    }