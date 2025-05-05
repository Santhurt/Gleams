document.addEventListener("DOMContentLoaded", () => {
    const ruta = window.location.pathname;
    console.log(ruta);

    if (ruta.includes("admin_views/dashboard.php")) {
        import("./eventos/dashboard.js").then((modulo) => {
            modulo.renderDashboard();
        });
    } else if (ruta.includes("admin_views/listado.php")) {
        import("./eventos/listado.js").then((modulo) => {
            modulo.renderProductos();
        });
    }
});
