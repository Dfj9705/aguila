import { Dropdown } from "bootstrap";

document.addEventListener('DOMContentLoaded', (e) => {


    let items = document.querySelectorAll('.nav-link')
    items.forEach(item => {
        if (item.href == location.href) {
            item.classList.add('active')
            if (item.classList.contains('dropdown-item')) {
                item.parentElement.parentElement.previousElementSibling.classList.add('active')
            }
        }
    });


})

const mostrarReloj = () => {
    const ahora = new Date();
    const [horas, minutos, segundos] = [ahora.getHours(), ahora.getMinutes(), ahora.getSeconds()];
    const diaSemana = ahora.toLocaleDateString(undefined, { weekday: 'long' });
    const dia = ahora.getDate();
    const mes = ahora.toLocaleDateString(undefined, { month: 'long' });
    const año = ahora.getFullYear();

    const horaFormateada = horas.toString().padStart(2, '0');
    const minutosFormateados = minutos.toString().padStart(2, '0');
    const segundosFormateados = segundos.toString().padStart(2, '0');

    const horaActual = `${horaFormateada}:${minutosFormateados}:${segundosFormateados}`;
    const fechaActual = `${diaSemana}, ${dia} de ${mes} de ${año}`;

    document.getElementById('time').textContent = `${fechaActual} ${horaActual}`
};
// mostrarReloj();
// Llamar a la función para que se actualice cada segundo
// setInterval(mostrarReloj, 1000);

