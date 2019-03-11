<?php

namespace izv\data;

/**
 * Link
 */
class Link
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $idCategoria;

    /**
     * @var string
     */
    private $shipment;

    /**
     * @var string
     */
    private $href;

    /**
     * @var string
     */
    private $comentario;

    /**
     * @var \izv\data\Usuario
     */
    private $idUsuario;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idCategoria
     *
     * @param integer $idCategoria
     *
     * @return Link
     */
    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;

        return $this;
    }

    /**
     * Get idCategoria
     *
     * @return integer
     */
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    /**
     * Set shipment
     *
     * @param string $shipment
     *
     * @return Link
     */
    public function setShipment($shipment)
    {
        $this->shipment = $shipment;

        return $this;
    }

    /**
     * Get shipment
     *
     * @return string
     */
    public function getShipment()
    {
        return $this->shipment;
    }

    /**
     * Set href
     *
     * @param string $href
     *
     * @return Link
     */
    public function setHref($href)
    {
        $this->href = $href;

        return $this;
    }

    /**
     * Get href
     *
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     *
     * @return Link
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set idUsuario
     *
     * @param \izv\data\Usuario $idUsuario
     *
     * @return Link
     */
    public function setIdUsuario(\izv\data\Usuario $idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \izv\data\Usuario
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
}

