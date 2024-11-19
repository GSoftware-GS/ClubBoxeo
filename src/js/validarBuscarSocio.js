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

// Función para validar el nombre
function validarNombre() {
    const nombreInput = document.querySelector("input[name='nombre']");
    const nombreError = document.querySelector("#errorNombre");

    if (/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]{4,50}$/.test(nombreInput.value.trim())) {
        mostrarExito(nombreError);
    } else {
        mostrarError(nombreError, "El nombre debe tener solo letras y entre 4 y 50 caracteres.");
    }
}



// Función para validar el teléfono
function validarTelefono() {
    const telefonoInput = document.querySelector("input[name='telefono']");
    const telefonoError = document.querySelector("#errorTelefono");

    if (/^\+34\d{9}$/.test(telefonoInput.value.trim())) {
        mostrarExito(telefonoError);
    } else {
        mostrarError(telefonoError, "El teléfono debe estar en formato español (+34 seguido de 9 dígitos).");
    }
}


// Añadir los event listeners para cada campo
document.querySelector("input[name='nombre']").addEventListener("input", validarNombre);
document.querySelector("input[name='telefono']").addEventListener("input", validarTelefono);

// Función para prevenir el envío si hay errores
form.addEventListener("submit", function (event) {
    // Ejecutar validaciones
    validarNombre();
    validarTelefono();


    // Verificar si hay errores antes de enviar
    const errores = document.querySelectorAll(".mal");
    if (errores.length > 1) {
        event.preventDefault();
        alert("Por favor, corrige los errores antes de enviar el formulario.");
    }
});
