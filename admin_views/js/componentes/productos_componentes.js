export const dom = {
    crearOpcionCategoria: (id, categoria) => {
        const opt = document.createElement("option");
        opt.value = id;
        opt.textContent = categoria;

        return opt;
    }
}
