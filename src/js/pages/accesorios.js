const { Toast } = require("../funciones");


const accesoriosDiv = document.getElementById('accesoriosDiv');
const formFiltros = document.getElementById('formFiltros');
const spinner2 = document.getElementById('spinner2');
accesoriosDiv.innerHTML = `

`;

const buscarAccesorios = async (e = null) => {
    if (e) e.preventDefault();

    const formData = new FormData(formFiltros);
    accesoriosDiv.innerHTML = ``;
    try {
        spinner2.classList.remove('d-none');
        const url = `/API/accesorios/buscar`
        const headers = new Headers();
        headers.append('X-Requested-With', 'fetch');
        const config = {
            method: 'POST',
            headers,
            body: formData,
        }

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        spinner2.classList.add('d-none');

        const { codigo, mensaje, detalle, datos } = data;

        let icon = "info";
        switch (codigo) {
            case 1:
                icon = "success"
                console.log(data);
                const row = document.createElement('div');
                row.classList.add('row');
                if (datos.length > 0) {
                    datos.forEach(accesorio => {
                        row.appendChild(construirCardAccesorio(accesorio));
                    });
                } else {
                    row.innerHTML = `
                        <div class="col-12">
                            <div class="alert alert-primary" role="alert">
                                No se encontraron accesorios. Intenta con otros filtros.
                            </div>
                        </div>
                    `;
                }
                accesoriosDiv.appendChild(row);
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
}

const construirCardAccesorio = (accesorio) => {
    const div = document.createElement('div');
    const card = document.createElement('div');
    const cardBody = document.createElement('div');
    const cardTitle = document.createElement('h5');
    const cardText = document.createElement('p');
    const cardLink = document.createElement('a');
    const carousel = document.createElement('div');
    const badgePrice = document.createElement('span');
    const badgeAvailable = document.createElement('span');
    const badgeCompatible = document.createElement('span');
    const cardFooter = document.createElement('div');
    const cardHeader = document.createElement('div');
    const buttonWhatsapp = document.createElement('a')
    cardHeader.classList.add('card-header', 'd-flex', 'justify-content-between', 'align-items-center');
    cardFooter.classList.add('card-footer', 'd-flex', 'justify-content-between', 'align-items-center');
    badgePrice.classList.add('badge', 'bg-success-subtle', 'text-success', 'fs-5');
    badgePrice.textContent = `Q. ${Number(accesorio.unit_price).toLocaleString('es-GT', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
    badgeAvailable.classList.add('badge', `${accesorio.stock > 0 ? 'bg-success' : 'bg-danger'}`, 'float-end');
    badgeAvailable.textContent = `${accesorio.stock > 0 ? 'Disponible' : 'Agotado'}`;
    badgeCompatible.classList.add('badge', 'bg-secondary');
    badgeCompatible.textContent = `${accesorio.compatible_model ? accesorio.compatible_brand + ' ' + accesorio.compatible_model : 'Universal'}`;
    carousel.classList.add('carousel', 'slide');
    carousel.id = `carousel-${accesorio.id}`;
    carousel.setAttribute('data-bs-ride', 'carousel');
    div.classList.add('col-md-4', 'col-lg-4', 'col-12', 'mb-4', 'mb-lg-4', 'mb-xl-4');
    card.classList.add('card');
    card.style.height = '100%';
    cardBody.classList.add('card-body');
    cardTitle.classList.add('card-title');
    cardText.classList.add('card-text');
    cardLink.classList.add('btn', 'btn-primary');
    cardTitle.textContent = `${accesorio.name} ${accesorio.brand}`;
    cardText.textContent = accesorio.description;
    cardLink.textContent = 'Ver más';
    cardLink.href = `/detalle/accesorios/${accesorio.id}`;
    cardLink.style.marginBottom = '0';
    buttonWhatsapp.classList.add('btn', 'btn-success');
    buttonWhatsapp.innerHTML = '<i class="fa fa-whatsapp me-2"></i> Consultar';
    buttonWhatsapp.href = `https://wa.me/502${process.env.TELEFONO}?text=Hola,%20quiero%20más%20información%20sobre%20el%20producto%20${accesorio.name}%20${accesorio.brand}`;
    buttonWhatsapp.target = '_blank';
    buttonWhatsapp.style.marginBottom = '0';
    carousel.appendChild(construirCarousel(accesorio, accesorio.images));
    cardBody.appendChild(carousel);
    cardBody.appendChild(cardTitle);
    cardBody.appendChild(cardText);
    cardHeader.appendChild(badgePrice);
    cardBody.appendChild(badgeCompatible);
    cardFooter.appendChild(cardLink);
    cardHeader.appendChild(badgeAvailable);
    cardFooter.appendChild(buttonWhatsapp);
    card.appendChild(cardHeader);
    card.appendChild(cardBody);
    card.appendChild(cardFooter);
    div.appendChild(card);
    return div;
}

const construirCarousel = (accesorio, images) => {
    const imagesArray = JSON.parse(images);
    const carousel = document.createElement('div');
    const indicators = document.createElement('div');
    indicators.classList.add('carousel-indicators');
    carousel.classList.add('carousel', 'slide');
    carousel.id = `carousel-${accesorio.id}`;
    carousel.setAttribute('data-bs-ride', 'carousel');
    const carouselInner = document.createElement('div');
    carouselInner.classList.add('carousel-inner');
    if (imagesArray.length > 0) {
        imagesArray.forEach((image, index) => {
            const carouselItem = document.createElement('div');
            carouselItem.classList.add('carousel-item');
            if (index === 0) {
                carouselItem.classList.add('active');
            }
            const carouselImage = document.createElement('img');
            carouselImage.src = `${process.env.IMAGES_URL}${image}`;
            carouselImage.classList.add('d-block', 'w-100');
            carouselItem.appendChild(carouselImage);
            carouselInner.appendChild(carouselItem);
            const indicator = document.createElement('button');
            indicator.type = 'button';
            indicator.setAttribute('data-bs-target', `#carousel-${accesorio.id}`);
            indicator.setAttribute('data-bs-slide-to', index);
            indicator.setAttribute('aria-current', index === 0 ? 'true' : '');
            indicator.setAttribute('aria-label', `Slide ${index + 1}`);
            if (index === 0) {
                indicator.classList.add('active');
            }
            indicators.appendChild(indicator);
        });
    } else {
        const carouselItem = document.createElement('div');
        carouselItem.classList.add('carousel-item', 'active');
        const carouselImage = document.createElement('img');
        carouselImage.src = `${process.env.HOST}/images/no-image.png`;
        carouselImage.classList.add('d-block', 'w-100');
        carouselItem.appendChild(carouselImage);
        carouselInner.appendChild(carouselItem);
    }
    carousel.appendChild(carouselInner);
    carousel.appendChild(indicators);
    return carousel;
}

formFiltros.addEventListener('change', buscarAccesorios);
buscarAccesorios();