import { Dropdown } from "bootstrap";
import { Toast, validarFormulario } from "../funciones";


const formContacto = document.getElementById('formContacto');
const btnEnviar = document.getElementById('btnEnviar');
const spanLoader = document.getElementById('spanLoader');
let verificado = false
spanLoader.style.display = 'none';
btnEnviar.disabled = false;
const enviar = async (e) => {
    e.preventDefault()
    spanLoader.style.display = '';
    btnEnviar.disabled = true;
    if (!verificado) {
        Toast.fire({
            icon: 'warning',
            title: 'Debe verificar el captcha'
        })
        spanLoader.style.display = 'none';
        btnEnviar.disabled = false;
        return
    }

    if (!validarFormulario(formContacto)) {
        Toast.fire({
            icon: "warning",
            title: "Debe llenar todos los campos",
        })
        spanLoader.style.display = 'none';
        btnEnviar.disabled = false;
        return
    }
    try {
        const url = `/API/contacto/enviar`
        const headers = new Headers();
        const body = new FormData(formContacto);
        headers.append('X-Requested-With', 'fetch');
        const config = {
            method: 'POST',
            body,
            headers,
        }

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data);
        const { codigo, mensaje, detalle } = data;

        let icon = "info";
        switch (codigo) {
            case 1:
                icon = "success"
                console.log(data);
                formContacto.reset()
                break;
            case 2:
                icon = "warning"
                console.log(data);

                break;
            case 0:

                icon = "error"
                console.log(detalle);
                break;

        }

        Toast.fire({
            icon,
            title: mensaje,
        })
    } catch (error) {
        console.log(error);
    }
    spanLoader.style.display = 'none';
    btnEnviar.disabled = false;
}

window.verificar = (dato) => {
    Toast.fire({
        icon: 'success',
        title: 'Captcha verificado'
    })
    verificado = true;

}



window.expirado = () => {
    Toast.fire({
        icon: 'warning',
        title: 'Captcha expirado'
    })
    verificado = false;
}

window.error = () => {
    Toast.fire({
        icon: 'error',
        title: 'Ocurrió un error en la verificación de captcha'
    })
    verificado = false;
}
formContacto.addEventListener('submit', enviar)