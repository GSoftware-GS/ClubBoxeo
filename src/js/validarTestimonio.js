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

// Validar el campo "socio"
function validarSocio() {
    const socioSelect = document.querySelector("select[name='socio']");
    const socioError = document.querySelector("#errorSocio");

    if (socioSelect.value === "") {
        mostrarError(socioError, "Debes seleccionar un socio válido.");
    } else {
        mostrarExito(socioError);
    }
}

// Validar el campo "contenido"
function validarContenido() {
    const contenidoTextarea = document.querySelector("textarea[name='contenido']");
    const contenidoError = document.querySelector("#errorContenido");

    if (contenidoTextarea.value.trim() === "") {
        mostrarError(contenidoError, "El contenido no puede estar vacío.");
    } else {
        mostrarExito(contenidoError);
    }
}

// Añadir los event listeners para los campos
document.querySelector("select[name='socio']").addEventListener("change", validarSocio);
document.querySelector("textarea[name='contenido']").addEventListener("input", validarContenido);

// Validar antes del envío del formulario
form.addEventListener("submit", function (event) {
    // Ejecutar validaciones
    validarSocio();
    validarContenido();

    // Verificar si hay errores antes de enviar
    const errores = document.querySelectorAll(".mal");
    if (errores.length > 0) {
        event.preventDefault();
        alert("Por favor, corrige los errores antes de enviar el formulario.");
    }
});
