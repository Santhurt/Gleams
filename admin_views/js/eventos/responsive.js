export function responsive() {
    let isHovering = false; // Variable para controlar el estado de hover
    let isManuallyCollapsed = false; // Variable para saber si fue colapsado manualmente
    
    setTimeout(() => {
        const sidebar = document.getElementById("sidebar");
        const mainContent = document.getElementById("main-content");
        const sidebarTexts = document.querySelectorAll(".sidebar-text");
        
        // Si estamos en una pantalla grande, aplicar el estado colapsado
        if (window.innerWidth >= 992) {
            sidebar.classList.add("sidebar-collapsed");
            mainContent.classList.add("main-content-expanded");
            isManuallyCollapsed = true; // Por defecto está colapsado
            // Ocultar los textos del sidebar
            sidebarTexts.forEach((text) => {
                text.style.opacity = "0";
            });
        }
    }, 1000);

    // Función para expandir el sidebar (hover)
    function expandSidebar() {
        const sidebar = document.getElementById("sidebar");
        const mainContent = document.getElementById("main-content");
        const sidebarTexts = document.querySelectorAll(".sidebar-text");
        
        sidebar.classList.remove("sidebar-collapsed");
        mainContent.classList.remove("main-content-expanded");
        
        // Mostrar los textos con un pequeño delay
        setTimeout(() => {
            sidebarTexts.forEach((text) => {
                text.style.opacity = "1";
            });
        }, 50);
    }

    // Función para colapsar el sidebar (salir del hover)
    function collapseSidebar() {
        const sidebar = document.getElementById("sidebar");
        const mainContent = document.getElementById("main-content");
        const sidebarTexts = document.querySelectorAll(".sidebar-text");
        
        // Ocultar los textos primero
        sidebarTexts.forEach((text) => {
            text.style.opacity = "0";
        });
        
        // Colapsar después de ocultar los textos
        setTimeout(() => {
            sidebar.classList.add("sidebar-collapsed");
            mainContent.classList.add("main-content-expanded");
        }, 100);
    }

    // Event listeners para hover (solo en pantallas grandes)
    const sidebar = document.getElementById("sidebar");
    
    sidebar.addEventListener("mouseenter", function() {
        if (window.innerWidth >= 992 && isManuallyCollapsed) {
            isHovering = true;
            expandSidebar();
        }
    });

    sidebar.addEventListener("mouseleave", function() {
        if (window.innerWidth >= 992 && isManuallyCollapsed && isHovering) {
            isHovering = false;
            collapseSidebar();
        }
    });

    // Toggle sidebar on mobile/desktop
    document
        .getElementById("sidebar-toggle")
        .addEventListener("click", function () {
            const sidebar = document.getElementById("sidebar");
            const mainContent = document.getElementById("main-content");
            const overlay = document.getElementById("sidebar-overlay");
            const sidebarTexts = document.querySelectorAll(".sidebar-text");
            
            if (window.innerWidth < 992) {
                // Comportamiento móvil (sin cambios)
                sidebar.classList.toggle("show");
                overlay.classList.toggle("show");
            } else {
                // Comportamiento desktop
                sidebar.classList.toggle("sidebar-collapsed");
                mainContent.classList.toggle("main-content-expanded");
                
                // Actualizar el estado manual
                isManuallyCollapsed = sidebar.classList.contains("sidebar-collapsed");
                
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
            
            // Resetear el estado de hover
            isHovering = false;
        } else {
            // En móvil, resetear estados
            isManuallyCollapsed = false;
            isHovering = false;
        }
    });
}
