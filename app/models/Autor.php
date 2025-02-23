<?php
class Autor {
    private $id_autor;
    private $nombre_autor;
    private $edad;
    private $nacionalidad;
    private $genero;

    // Constructor con valores opcionales

    public function __construct($id_autor = null, $nombre_autor = null, $edad = null, $nacionalidad = null, $genero = null) {
        $this->id_autor = $id_autor;
        $this->nombre_autor = $nombre_autor;
        $this->edad = $edad;
        $this->nacionalidad = $nacionalidad;
        $this->genero = $genero;
    }

    // Métodos getter (para obtener valores)
    public function getIdAutor() {
        return $this->id_autor;
    }

    public function getNombreAutor() {
        return $this->nombre_autor;
    }
    
    public function getEdad() {
        return $this->edad;
    }
    
    public function getNacionalidad() {
        return $this->nacionalidad;
    }

    public function getGenero(){
        return $this->genero;
    }

    // Métodos setter (para asignar valores)
    public function setIdAutor($id_autor) {
        $this->id_autor = $id_autor;
    }

    public function setNombreAutor($nombre_autor) {
        $this->nombre_autor = $nombre_autor;
    }
    
    public function setEdad($edad) {
        $this->edad = $edad;
    }
    
    public function setNacionalidad($nacionalidad) {
        $this->nacionalidad = $nacionalidad;
    }
    
    public function setGenero($genero){
        $this->genero = $genero;
    }
}
?>