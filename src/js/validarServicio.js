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

// Función para validar la descripción
function validarDescripcion() {
    const descripcionInput = document.querySelector("input[name='descripcion']");
    const descripcionError = document.querySelector("#errorDescripcion");

    if (descripcionInput.value.trim().length >= 3 && descripcionInput.value.trim().length <= 50) {
        mostrarExito(descripcionError);
    } else {
        mostrarError(descripcionError, "La descripción debe tener entre 3 y 50 caracteres.");
    }
}

// Función para validar la duración
function validarDuracion() {
    const duracionInput = document.querySelector("input[name='duracion']");
    const duracionError = document.querySelector("#errorDuracion");

    if (parseInt(duracionInput.value, 10) >= 15) {
        mostrarExito(duracionError);
    } else {
        mostrarError(duracionError, "La duración debe ser como mínimo de 15 minutos.");
    }
}

// Función para validar el precio
function validarPrecio() {
    const precioInput = document.querySelector("input[name='precio']");
    const precioError = document.querySelector("#errorPrecio");

    if (parseFloat(precioInput.value) >= 0) {
        mostrarExito(precioError);
    } else {
        mostrarError(precioError, "El precio debe ser mayor o igual a 0.");
    }
}

// Añadir los event listeners para cada campo
document.querySelector("input[name='descripcion']").addEventListener("input", validarDescripcion);
document.querySelector("input[name='duracion']").addEventListener("input", validarDuracion);
document.querySelector("input[name='precio']").addEventListener("input", validarPrecio);

// Función para prevenir el envío si hay errores
form.addEventListener("submit", function (event) {
    // Ejecutar validaciones
    validarDescripcion();
    validarDuracion();
    validarPrecio();

    // Verificar si hay errores antes de enviar
    const errores = document.querySelectorAll(".mal");
    if (errores.length > 0) {
        event.preventDefault();
        alert("Por favor, corrige los errores antes de enviar el formulario.");
    }
});
