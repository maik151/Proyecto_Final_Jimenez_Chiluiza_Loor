<?php
    class Libro{
        private $id_libro;
        private $titulo_libro;
        private $ISBN;
        private $autor_libro;
        private $genero_libro;

        public function __construct($id_libro, $titulo_libro, $ISBN, $autor_libro, $genero_libro){
            $this->id_libro = $id_libro;
            $this->titulo_libro = $titulo_libro;
            $this->ISBN = $ISBN;
            $this->autor_libro = $autor_libro;
            $this->genero_libro = $genero_libro;
        }

        public function __construct($id_libro=null, $titulo_libro=null, $ISBN=null, $autor_libro=null, $genero_libro=null){
            $this->id_libro = $id_libro;
            $this->titulo_libro = $titulo_libro;
            $this->ISBN = $ISBN;
            $this->autor_libro = $autor_libro;
            $this->genero_libro = $genero_libro;
        }

        // Métodos Getter (para obtener valores)
    public function getIdLibro() {
        return $this->id_libro;
    }

    public function getTituloLibro() {
        return $this->titulo_libro;
    }

    public function getISBN() {
        return $this->ISBN;
    }

    public function getAutorLibro() {
        return $this->autor_libro;
    }

    public function getGeneroLibro() {
        return $this->genero_libro;
    }

    // Métodos Setter (para asignar valores)
    public function setIdLibro($id_libro) {
        $this->id_libro = $id_libro;
    }

    public function setTituloLibro($titulo_libro) {
        $this->titulo_libro = $titulo_libro;
    }

    public function setISBN($ISBN) {
        $this->ISBN = $ISBN;
    }

    public function setAutorLibro($autor_libro) {
        $this->autor_libro = $autor_libro;
    }

    public function setGeneroLibro($genero_libro) {
        $this->genero_libro = $genero_libro;
    }

    }


?>