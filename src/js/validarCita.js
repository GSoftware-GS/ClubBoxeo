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

// Validar el socio
function validarSocio() {
    const socioSelect = document.querySelector("select[name='socio']");
    const socioError = document.querySelector("#errorSocio");

    if (socioSelect.value === "") {
        mostrarError(socioError, "Debes seleccionar un socio válido.");
    } else {
        mostrarExito(socioError);
    }
}

// Validar el servicio
function validarServicio() {
    const servicioSelect = document.querySelector("select[name='servicio']");
    const servicioError = document.querySelector("#errorServicio");

    if (servicioSelect.value === "") {
        mostrarError(servicioError, "Debes seleccionar un servicio válido.");
    } else {
        mostrarExito(servicioError);
    }
}

// Validar la fecha
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

//Validar la hora
function validarHora() {
    const horaInput = document.querySelector("input[name='hora']");
    const horaError = document.querySelector("#errorHora");

    if (horaInput.value === "") {
        mostrarError(horaError, "Debes seleccionar una hora válida.");
    } else {
        mostrarExito(horaError);
    }
}

// Añadir validaciones en tiempo real
document.querySelector("select[name='socio']").addEventListener("change", validarSocio);
document.querySelector("select[name='servicio']").addEventListener("change", validarServicio);
document.querySelector("input[name='fecha']").addEventListener("input", validarFecha);
document.querySelector("input[name='hora']").addEventListener("input", validarHora);

// Validar antes del envío del formulario
form.addEventListener("submit", function (event) {
    validarSocio();
    validarServicio();
    validarFecha();
    validarHora();

    const errores = document.querySelectorAll(".mal");
    if (errores.length > 0) {
        event.preventDefault();
        alert("Por favor, corrige los errores antes de enviar el formulario.");
    }
});
