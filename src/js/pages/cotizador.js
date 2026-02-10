import { Dropdown } from "bootstrap";
import { Toast, validarFormulario } from "../funciones";
import * as FilePond from "filepond";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";

FilePond.registerPlugin(FilePondPluginFileValidateType);

const formCotizador = document.getElementById('formCotizador');
const btnEnviar = document.getElementById('btnEnviar');
const spanLoader = document.getElementById('spanLoader');
const imagenes = document.getElementById('imagenes');
let imagenesFilePond = null;

spanLoader.style.display = 'none';
btnEnviar.disabled = false;

const filePond = FilePond.create(imagenes, {
    labelIdle: 'Arrastra y suelta archivos o <span class="filepond--label-action">selecciona</span>',
    maxFiles: 5,
    maxFileSize: '2MB',
    acceptedFileTypes: ['image/*'],
    fileValidateTypeLabelExpectedTypes: 'Formato no válido',
    fileValidateTypeLabelTooLarge: 'Tamaño no válido',
    fileValidateTypeMaxSize: 'Tamaño no válido',
    instantUpload: false,
})

const enviar = async (e) => {
    e.preventDefault()
    spanLoader.style.display = '';
    btnEnviar.disabled = true;
    if (!grecaptcha.getResponse()) {
        Toast.fire({
            icon: 'warning',
            title: 'Debe verificar el captcha'
        })
        spanLoader.style.display = 'none';
        btnEnviar.disabled = false;
        return
    }
    formCotizador.classList.remove('was-validated');
    if (!formCotizador.checkValidity()) {
        Toast.fire({
            icon: "warning",
            title: "Debe llenar todos los campos",
        })
        spanLoader.style.display = 'none';
        btnEnviar.disabled = false;
        formCotizador.classList.add('was-validated');
        return
    }
    try {
        const url = `/API/cotizador/enviar`
        const headers = new Headers();
        const body = new FormData(formCotizador);
        body.delete("imagenes[]");
        body.delete("imagenes");

        // ✅ Agregar cada archivo REAL al FormData
        const files = filePond.getFiles();
        files.forEach((item) => {
            // item.file es un File real
            body.append("imagenes[]", item.file);
        });
        // return
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
                formCotizador.reset()
                grecaptcha.reset();
                filePond.removeFiles();
                break;
            case 2:
                icon = "warning"
                console.log(data);
                grecaptcha.reset();
                break;
            case 0:

                icon = "error"
                console.log(detalle);
                grecaptcha.reset();
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
    formCotizador.classList.remove('was-validated');
}

window.verificar = (dato) => {
    Toast.fire({
        icon: 'success',
        title: 'Captcha verificado'
    })

}



window.expirado = () => {
    Toast.fire({
        icon: 'warning',
        title: 'Captcha expirado'
    })

}

window.error = () => {
    Toast.fire({
        icon: 'error',
        title: 'Ocurrió un error en la verificación de captcha'
    })
}

formCotizador.addEventListener('submit', enviar)
