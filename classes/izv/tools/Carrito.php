<?php

namespace izv\tools;

class Carrito implements \Iterator {

    private $contador = 0;
    private $items = [];

    function __construct() {
    }

    function addItem(\izv\data\Item $item) {
        if((isset($this->items[$item->getId()]))) {
            $itemPrevio = $this->items[$item->getId()];
            $itemPrevio->setCantidad($itemPrevio->getCantidad() + $item->getCantidad());
            $item = $itemPrevio;
        }
        $this->items[$item->getId()] = $item;
        return $this;
    }

    function delItem(\izv\data\Item $item) {
        unset($this->items[$item->getId()]);
        return $this;
    }

    function getTotal() {
        $total = 0;
        foreach($this->items as $item) {
            $total += $item->getCantidad() * $item->getPrecio();
        }
        return $total;
    }

    function subItem(\izv\data\Item $item) {
        if(isset($this->items[$item->getId()])) {
            $itemPrevio = $this->items[$item->getId()];
            $itemPrevio->setCantidad($itemPrevio->getCantidad() - $item->getCantidad());
            if($itemPrevio->getCantidad() <= 0) {
                $this->delItem($item);
            } else {
                $this->items[$itemPrevio->getId()] = $itemPrevio;
            }
        }
        return $this;
    }

    /* métodos de la interfaz, a los que estoy obligado a implementar */

    function current() {
        return $this->items[$this->key()];
    }

    function key() {
        $claves = array_keys($this->items);
        if(isset($claves[$this->contador])) {
            return $claves[$this->contador];
        }
        return null;
    }

    function next() {
        $this->contador++;
        return $this;
    }

    function rewind() {
        $this->contador = 0;
        return $this;
    }

    function valid() {
        $claves = array_keys($this->items);
        return isset($claves[$this->contador]) &&
                isset($this->items[$claves[$this->contador]]);
    }
}