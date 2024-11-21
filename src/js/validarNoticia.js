const form = document.querySelector("form");

// Función para mostrar errores
function mostrarError(elemento, mensaje) {
    elemento.classList.remove("bien");
    elemento.classList.add("mal");
    elemento.innerText = mensaje;
}

// Función para mostrar éxito
function mostrarExito(elemento) {
    elemento.classList.remove("mal");
    elemento.classList.add("bien");
    elemento.innerText = "";
}

// Validar el título
function validarTitulo() {
    const tituloInput = document.querySelector("input[name='titulo']");
    const tituloError = document.querySelector("#errorTitulo");

    if (tituloInput.value.trim().length >= 3) {
        mostrarExito(tituloError);
    } else {
        mostrarError(tituloError, "El título debe tener al menos 3 caracteres.");
    }
}

// Validar el contenido
function validarContenido() {
    const contenidoTextarea = document.querySelector("textarea[name='contenido']");
    const contenidoError = document.querySelector("#errorContenido");

    if (contenidoTextarea.value.trim().length >= 3) {
        mostrarExito(contenidoError);
    } else {
        mostrarError(contenidoError, "El contenido debe tener al menos 3 caracteres.");
    }
}

// Validar la fecha de publicación
function validarFecha() {
    const fechaInput = document.querySelector("input[name='fecha']");
    const fechaError = document.querySelector("#errorFecha");
    const fechaSeleccionada = new Date(fechaInput.value);
    const fechaActual = new Date();

    if (fechaSeleccionada > fechaActual) {
        mostrarExito(fechaError);
    } else {
        mostrarError(fechaError, "La fecha debe ser posterior a la actual.");
    }
}

// Validar la foto
function validarFoto() {
    const fotoInput = document.querySelector("input[name='foto']");
    const fotoError = document.querySelector("#errorFoto");
    const archivo = fotoInput.files[0];

    if (!archivo) {
        mostrarError(fotoError, "Debes subir una foto.");
        return;
    }

    const tipoValido = archivo.type === "image/jpeg";
    const tamañoValido = archivo.size <= 5 * 1024 * 1024; // 5 MB

    if (!tipoValido) {
        mostrarError(fotoError, "La foto debe ser en formato JPEG.");
    } else if (!tamañoValido) {
        mostrarError(fotoError, "La foto no debe superar los 5MB.");
    } else {
        mostrarExito(fotoError);
    }
}

// Añadir los event listeners para los campos
document.querySelector("input[name='titulo']").addEventListener("input", validarTitulo);
document.querySelector("textarea[name='contenido']").addEventListener("input", validarContenido);
document.querySelector("input[name='fecha']").addEventListener("input", validarFecha);
document.querySelector("input[name='foto']").addEventListener("change", validarFoto);

// Validar antes del envío del formulario
form.addEventListener("submit", function (event) {
    validarTitulo();
    validarContenido();
    validarFecha();
    validarFoto();

    const errores = document.querySelectorAll(".mal");
    if (errores.length > 0) {
        event.preventDefault();
        alert("Por favor, corrige los errores antes de enviar el formulario.");
    }
});
