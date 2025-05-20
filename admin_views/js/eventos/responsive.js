export function responsive() {
    setTimeout(() => {
        const sidebar = document.getElementById("sidebar");
        const mainContent = document.getElementById("main-content");
        const sidebarTexts = document.querySelectorAll(".sidebar-text");

        // Si estamos en una pantalla grande, aplicar el estado colapsado
        if (window.innerWidth >= 992) {
            sidebar.classList.add("sidebar-collapsed");
            mainContent.classList.add("main-content-expanded");

            // Ocultar los textos del sidebar
            sidebarTexts.forEach((text) => {
                text.style.opacity = "0";
            });
        }
    }, 1000);

    // Toggle sidebar on mobile
    document
        .getElementById("sidebar-toggle")
        .addEventListener("click", function () {
            const sidebar = document.getElementById("sidebar");
            const mainContent = document.getElementById("main-content");
            const overlay = document.getElementById("sidebar-overlay");
            const sidebarTexts = document.querySelectorAll(".sidebar-text");

            if (window.innerWidth < 992) {
                sidebar.classList.toggle("show");
                overlay.classList.toggle("show");
            } else {
                sidebar.classList.toggle("sidebar-collapsed");
                mainContent.classList.toggle("main-content-expanded");

                if (sidebar.classList.contains("sidebar-collapsed")) {
                    sidebarTexts.forEach((text) => {
                        text.style.opacity = "0";
                    });
                } else {
                    setTimeout(function () {
                        sidebarTexts.forEach((text) => {
                            text.style.opacity = "1";
                        });
                    }, 100);
                }
            }
        });
    // Close sidebar when clicking on overlay
    document
        .getElementById("sidebar-overlay")
        .addEventListener("click", function () {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("sidebar-overlay");

            sidebar.classList.remove("show");
            overlay.classList.remove("show");
        });

    // Handle window resize
    window.addEventListener("resize", function () {
        if (window.innerWidth >= 992) {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("sidebar-overlay");

            sidebar.classList.remove("show");
            overlay.classList.remove("show");
        }
    });
}
