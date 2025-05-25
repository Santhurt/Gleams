import { responsive } from "./responsive.js";
import { calcular } from "../lib/calculos.js";

export async function renderDashboard() {
    responsive();
    const cantidadLabel = document.querySelector("#cantidad-usuarios");
    const totalVentasLabel = document.querySelector("#total-ventas");

    cantidadLabel.innerHTML = await calcular.usuariosRegistrados();
    totalVentasLabel.innerHTML = `$${await calcular.totalVentas() }`;
    
    


}
