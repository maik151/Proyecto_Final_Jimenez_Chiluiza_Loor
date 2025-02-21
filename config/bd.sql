-- creacion de tabla de autor
-- Crear base de datos (si no existe)
CREATE DATABASE IF NOT EXISTS gestion_libros;
USE gestion_libros;

CREATE TABLE IF NOT EXISTS Autor (
    id_autor INT AUTO_INCREMENT PRIMARY KEY,
    nombre_autor VARCHAR(255) NOT NULL,
    edad_autor INT CHECK (edad_autor > 0),
    nacionalidad VARCHAR(100),
    genero VARCHAR(50)
);

-- Creacion de tabla de libro
CREATE TABLE IF NO EXISTS Libro (
    id_libro INT AUTO_INCREMENT PRIMARY KEY,
    titulo_libro VARCHAR(255) NOT NULL,
    ISBN VARCHAR(20) UNIQUE,
    id_autor INT NOT NULL,
    genero_libro VARCHAR(100),
    FOREIGN KEY (id_autor) REFERENCES Autor(id_autor) ON DELETE CASCADE
);

-- ===========================================
-- Script para la creación de la base de datos
-- "gestion_libros" y sus tablas principales.
-- Este archivo contiene las consultas necesarias
-- para crear las tablas "Autor" y "Libro" con
-- sus relaciones (clave foránea) en una base de
-- datos MySQL.
-- 
-- Tabla "Autor":
-- Almacena la información de los autores,
-- incluyendo su nombre, edad, nacionalidad y género.
--
-- Tabla "Libro":
-- Almacena los libros, incluyendo título, ISBN, 
-- género y la referencia al autor a través de la
-- clave foránea "id_autor".
--
-- Uso recomendado: Ejecutar este archivo al 
-- configurar el proyecto para crear la base de 
-- datos y sus tablas de manera automática.
--
-- ===========================================