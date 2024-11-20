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



// Añadir los event listeners para cada campo
document.querySelector("input[name='descripcion']").addEventListener("input", validarDescripcion);


// Función para prevenir el envío si hay errores
form.addEventListener("submit", function (event) {
    // Ejecutar validaciones
    validarDescripcion();


    // Verificar si hay errores antes de enviar
    const errores = document.querySelectorAll(".mal");
    if (errores.length > 0) {
        event.preventDefault();
        alert("Por favor, corrige los errores antes de enviar el formulario.");
    }
});
