<?php


namespace izv\data;

 /**
  * Usuario Bulgaris o Root
  * 
  * @Entity @Table(name="categoria")
 **/
 
class Categoria{
    use \izv\common\Common;
    
      /**
     * @Id
     * @Column(type="integer") @GeneratedValue
     */
    private $id; 
    
    /**
     * @Column(type="integer", length=10, nullable=false)
     * @ManyToOne(targetEntity="Usuario", inversedBy="categorias")
     * @JoinColumn(name="idUsuario", nullable=false, referencedColumnName="id")
     */
    private $idUsuario;
    
    /**
     * @Column(type="string", length=50, nullable=false)
     */
    private $categoria;
    
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
     * Set idUsuario
     *
     * @param integer $idUsuario
     *
     * @return Categoria
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return integer
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set categoria
     *
     * @param string $categoria
     *
     * @return Categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return string
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set link
     *
     * @param \Usuario $link
     *
     * @return Categoria
     */
    public function setLink(\Usuario $link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return \Usuario
     */
    public function getLink()
    {
        return $this->link;
    }
}

