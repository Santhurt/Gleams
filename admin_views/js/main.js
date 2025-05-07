document.addEventListener("DOMContentLoaded", () => {
    const ruta = window.location.pathname;
    console.log(ruta);

    if (ruta.includes("admin_views/dashboard.php")) {
        import("./eventos/dashboard.js").then((modulo) => {
            modulo.renderDashboard();
        });
    } else if (ruta.includes("admin_views/productos.php")) {
        import("./eventos/productos.js").then((modulo) => {
            modulo.renderProductos();
        });
    }
});
