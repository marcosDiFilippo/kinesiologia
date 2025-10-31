const buttonAlta = document.querySelector("#button-alta");
const sectionAlta = document.querySelector("#section-alta-pacientes");
const cerrar = document.querySelector("#cerrar");

buttonAlta.addEventListener("click", () => {
    sectionAlta.classList.add("visible");
    cerrar.classList.add("visible");

    cerrar.addEventListener("click", () => {
        sectionAlta.classList.remove("visible");
        cerrar.classList.remove("visible");
    });
});