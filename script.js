document.addEventListener("DOMContentLoaded", function() {
    const abrirCarritoBtn = document.getElementById("abrir-carrito");
    const cerrarCarritoBtn = document.getElementById("cerrar-carrito");
    const carritoPopup = document.getElementById("carrito-popup");
    const realizarCompraBtn = document.getElementById("realizar-compra-btn");
    const subtotalDiv = document.getElementById("subtotal");
    const totalDiv = document.getElementById("total");
    const subtotalSpan = document.getElementById('subt');    

    function actualizarSubtotalYTotal() {
        let subtotal = 0;
        carrito.querySelectorAll("li").forEach(function(producto) {
            const precioTexto = producto.querySelector("span").textContent;
            const precio = parseInt(precioTexto.split(" - ")[1].replace(/\./g, "").replace("$", ""));
            subtotal += precio;
        });
        subtotalDiv.textContent = "Subtotal: $" + subtotal.toFixed(0);
        totalDiv.textContent = "Total: $" + subtotal.toFixed(0);
    }

    function carritoVacio() {
        return carrito.children.length === 0;
    }

    abrirCarritoBtn.addEventListener("click", function() {
        carritoPopup.classList.add("active");
    });

    cerrarCarritoBtn.addEventListener("click", function() {
        carritoPopup.classList.remove("active");
    });
    
    const carrito = document.getElementById("lista-carrito");    

    carrito.addEventListener("click", function(e) {
        if (e.target.classList.contains("eliminar")) {
            const producto = e.target.parentElement;
            producto.remove();
            actualizarSubtotalYTotal();
        }
    });
    
    realizarCompraBtn.addEventListener("click", function() {
        if (carritoVacio()) {
            alert("El carrito está vacío. Agregue productos antes de proceder con la compra.");
        } else {            
            alert("Compra realizada. Gracias por su compra!" + totalDiv.textContent);       
            while (carrito.firstChild) {                
                carrito.removeChild(carrito.firstChild);
            }            
            actualizarSubtotalYTotal();           
        }
    });

    const productos = document.querySelectorAll(".producto");
    productos.forEach(function(producto) {
        producto.addEventListener("click", function() {
            carritoPopup.classList.add("active");
            const nombre = producto.querySelector("h2").textContent;
            const precioTexto = producto.querySelector("span").textContent;
            const nombreProductoSpan = document.createElement("span");
            nombreProductoSpan.textContent = nombre + " - " + precioTexto;
            const nuevoProducto = document.createElement("li");
            nuevoProducto.appendChild(nombreProductoSpan);         
            const btnEliminar = document.createElement("button");
            btnEliminar.textContent = "Eliminar";
            btnEliminar.classList.add("eliminar");
            nuevoProducto.appendChild(btnEliminar);
            carrito.appendChild(nuevoProducto);
            actualizarSubtotalYTotal();
        });
    });
});