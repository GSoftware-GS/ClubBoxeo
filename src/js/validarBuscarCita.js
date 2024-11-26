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



// Validar antes del envío del formulario
form.addEventListener("submit", function (event) {
    validarSocio();
    validarServicio();

    // Verificar si al menos uno de los campos está lleno
    const socioSelect = document.querySelector("select[name='socio']").value;
    const servicioSelect = document.querySelector("select[name='servicio']").value;
    const fechaInput = document.querySelector("input[name='fecha']").value;

    if (socioSelect === "" && servicioSelect === "" && fechaInput === "") {
        event.preventDefault();
        alert("Por favor, completa al menos un campo antes de enviar el formulario.");
    }
});

// Añadir validaciones en tiempo real
document.querySelector("select[name='socio']").addEventListener("change", validarSocio);
document.querySelector("select[name='servicio']").addEventListener("change", validarServicio);

