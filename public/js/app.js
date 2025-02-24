function abrirModalNuevo() {
    document.getElementById("id_libro").value = "";
    document.getElementById("titulo_libro").value = "";
    document.getElementById("isbn").value = "";
    document.getElementById("id_autor").value = "";
    document.getElementById("genero_libro").value = "";
    new bootstrap.Modal(document.getElementById("modalLibro")).show();
}

function editarLibro(libro) {
    document.getElementById("id_libro").value = libro.id_libro;
    document.getElementById("titulo_libro").value = libro.titulo_libro;
    document.getElementById("isbn").value = libro.ISBN;
    document.getElementById("id_autor").value = libro.id_autor;
    document.getElementById("genero_libro").value = libro.genero_libro;
    new bootstrap.Modal(document.getElementById("modalLibro")).show();
}

function guardarLibro() {
    let id_libro = document.getElementById("id_libro").value;
    let libro = {
        titulo_libro: document.getElementById("titulo_libro").value,
        ISBN: document.getElementById("isbn").value,
        id_autor: document.getElementById("id_autor").value,
        genero_libro: document.getElementById("genero_libro").value
    };

    let url = id_libro ? "/Proyecto_Final_Jimenez_Chiluiza_Loor/public/libros/" + id_libro : "/libros";
    let method = id_libro ? "PUT" : "POST";

    if (id_libro) libro.id_libro = id_libro;

    axios({ method, url, data: libro })
        .then(response => {
            alert("Libro guardado exitosamente");
            location.reload();
        })
        .catch(error => console.error(error));
}

function eliminarLibro(id_libro) {
    if (confirm("¿Estás seguro de eliminar este libro?")) {
        axios.delete("/Proyecto_Final_Jimenez_Chiluiza_Loor/public/libros/" + id_libro)
            .then(response => {
                alert("Libro eliminado");
                location.reload();
            })
            .catch(error => console.error(error));
    }
}

function abrirModalNuevoAutor() {
    document.getElementById("id_autor").value = "";
    document.getElementById("nombre_autor").value = "";
    document.getElementById("edad_autor").value = "";
    document.getElementById("nacionalidad").value = "";
    document.getElementById("genero").value = "Masculino";
    new bootstrap.Modal(document.getElementById("modalAutor")).show();
}

function editarAutor(autor) {
    document.getElementById("id_autor").value = autor.id_autor;
    document.getElementById("nombre_autor").value = autor.nombre_autor;
    document.getElementById("edad_autor").value = autor.edad_autor;
    document.getElementById("nacionalidad").value = autor.nacionalidad;
    document.getElementById("genero").value = autor.genero;
    new bootstrap.Modal(document.getElementById("modalAutor")).show();
}

function guardarAutor() {
    let id_autor = document.getElementById("id_autor").value;
    let autor = {
        nombre_autor: document.getElementById("nombre_autor").value,
        edad_autor: document.getElementById("edad_autor").value,
        nacionalidad: document.getElementById("nacionalidad").value,
        genero: document.getElementById("genero").value
    };

    let url = id_autor ? "/autores/" + id_autor : "/autores";
    let method = id_autor ? "PUT" : "POST";

    if (id_autor) autor.id_autor = id_autor;

    axios({ method, url, data: autor })
        .then(response => {
            alert("Autor guardado exitosamente");
            location.reload();
        })
        .catch(error => console.error(error));
}

function eliminarAutor(id_autor) {
    if (confirm("¿Estás seguro de eliminar este autor?")) {
        axios.delete("/autores/" + id_autor)
            .then(response => {
                alert("Autor eliminado");
                location.reload();
            })
            .catch(error => console.error(error));
    }
}