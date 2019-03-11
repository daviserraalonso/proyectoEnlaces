<?php

namespace izv\data;



 /**
  * Usuario Bulgaris o Root
  * 
  * @Entity @Table(name="link")
 **/
 
class Link{
    use \izv\common\Common;
    /**
     * @Id
     * @Column(type="integer") @GeneratedValue
     */
    private $id;
    
    /**
     * @Column(type="integer", length=10, nullable=false)
     * One Link has One Category.
     * @OneToOne(targetEntity="Categoria")
     * @JoinColumn(name="categoria", referencedColumnName="id")
     */
    private $idCategoria;
    
       
    /**
     * @Column(type="string", length=50, nullable=false)
     */
    private $shipment;
    
    
    /**
     * One Link has many User.
     * @ManyToOne(targetEntity="Usuario", inversedBy="links")
     * @JoinColumn(name="idUsuario", nullable=false, referencedColumnName="id")
    */
    private $idUsuario;
    
    
    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $href;
    
    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $comentario;

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
     * Set idUsuario
     *
     * @param string $idUsuario
     *
     * @return Link
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return string
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
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
}

