"use strict";
const carrito = {
    items: JSON.parse(localStorage.getItem("carrito") || "[]"),
    elemento: document.querySelector(".cart-items"),
    contador: document.querySelector(".cart-item-count"),

    actualizar() {
        this.elemento.innerHTML = '';
        this.items.forEach(item => this.elemento.appendChild(this.crearItem(item)));
        this.contador.textContent = this.items.length;
        localStorage.setItem("carrito", JSON.stringify(this.items));
    },

    crearItem(producto) {
        const item = document.createElement('article');
        item.className = 'cart-item';
        item.innerHTML = `
            <img src="./img/productos/${producto.imagen}" 
                 alt="${producto.nombre}" 
                 class="cart-item-img">
            <div>
                <h4>${producto.nombre}</h4>
                <p>${producto.precio} €</p>
                <button class="eliminar-btn" data-id="${producto.id}">
                    Eliminar <i class="fas fa-times"></i>
                </button>
            </div>`;

        item.querySelector('.eliminar-btn').addEventListener('click', () => {
            this.items = this.items.filter(i => i.id !== producto.id);
            this.actualizar();
        });
        return item;
    },

    agregar(producto) {
        if (!this.items.some(i => i.id === producto.id)) {
            this.items.push(producto);
            this.actualizar();
            mostrarMensaje('Producto añadido al carrito', 'success');
        }
    }
};

// Event listeners
document.querySelectorAll('.product-cart-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const producto = {
            id: btn.closest('.product-container').dataset.id,
            nombre: btn.closest('.product').querySelector('.product-name').textContent,
            precio: btn.closest('.product').querySelector('.product-price').textContent,
            imagen: btn.closest('.product-container').querySelector('img').src.split('/').pop()
        };
        carrito.agregar(producto);
    });
});

document.querySelector('.toggle-cart').addEventListener('click', () => {
    document.querySelector('.cart-overlay').classList.add('show');
});

document.querySelector('.cart-vaciar').addEventListener('click', () => {
    carrito.items = [];
    carrito.actualizar();
    mostrarMensaje('Carrito vaciado', 'success');
});

document.querySelector('.cart-close').addEventListener('click', () => {
    document.querySelector('.cart-overlay').classList.remove('show');
});

function mostrarMensaje(texto, tipo) {
    const alerta = document.querySelector('.alerta');
    alerta.textContent = texto;
    alerta.className = `alerta ${tipo}`;
    setTimeout(() => alerta.className = 'alerta', 2000);
}

// Inicializar carrito
carrito.actualizar();
