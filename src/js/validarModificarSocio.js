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

// Función para validar el usuario
function validarUsuario() {
    const usuarioInput = document.querySelector("input[name='usuario']");
    const usuarioError = document.querySelector("#errorUsuario");

    if (/^[a-zA-Z][a-zA-Z0-9]{4,19}$/.test(usuarioInput.value.trim())) {
        mostrarExito(usuarioError);
    } else {
        mostrarError(usuarioError, "El usuario debe empezar con una letra y tener entre 5 y 20 caracteres.");
    }
}

// Función para validar la edad
function validarEdad() {
    const edadInput = document.querySelector("input[name='edad']");
    const edadError = document.querySelector("#errorEdad");

    if (Number(edadInput.value) >= 18) {
        mostrarExito(edadError);
    } else {
        mostrarError(edadError, "La edad debe ser 18 o mayor.");
    }
}

// Función para validar el email
function validarEmail() {
    const emailInput = document.querySelector("input[name='email']");
    const emailError = document.querySelector("#errorEmail");

    if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value.trim())) {
        mostrarExito(emailError);
    } else {
        mostrarError(emailError, "El email no es válido.");
    }
}

// Función para validar la contraseña
function validarPassword() {
    const passwordInput = document.querySelector("input[name='password']");
    const passwordError = document.querySelector("#errorPassword");

    if (passwordInput.value.length >= 8) {
        mostrarExito(passwordError);
    } else {
        mostrarError(passwordError, "La contraseña debe tener al menos 8 caracteres.");
    }
}

// Función para validar la foto
function validarFoto() {
    const fotoInput = document.querySelector("input[name='foto']");
    const fotoError = document.querySelector("#errorFoto");

    const foto = fotoInput.files[0];
    if (foto) {
        const tiposPermitidos = ["image/jpeg", "image/png", "image/gif"];
        if (tiposPermitidos.includes(foto.type) && foto.size <= 5 * 1024 * 1024) { // 5MB
            mostrarExito(fotoError);
        } else {
            mostrarError(fotoError, "La foto debe ser JPEG, PNG o GIF y no superar los 5 MB.");
        }
    } else {
        mostrarExito(fotoError); // Si no se sube una foto, se considera válido
    }
}

// Añadir los event listeners para cada campo
document.querySelector("input[name='nombre']").addEventListener("input", validarNombre);
document.querySelector("input[name='usuario']").addEventListener("input", validarUsuario);
document.querySelector("input[name='edad']").addEventListener("input", validarEdad);
document.querySelector("input[name='email']").addEventListener("input", validarEmail);
document.querySelector("input[name='password']").addEventListener("input", validarPassword);
document.querySelector("input[name='foto']").addEventListener("change", validarFoto);

// Función para prevenir el envío si hay errores
form.addEventListener("submit", function (event) {
    // Ejecutar validaciones
    validarNombre();
    validarUsuario();
    validarEdad();
    validarEmail();
    validarPassword();
    validarFoto();

    // Verificar si hay errores antes de enviar
    const errores = document.querySelectorAll(".mal");
    if (errores.length > 0) {
        event.preventDefault();
        alert("Por favor, corrige los errores antes de enviar el formulario.");
    }
});