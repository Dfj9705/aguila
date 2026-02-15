const { Toast } = require("../funciones");


const municionesDiv = document.getElementById('municionesDiv');
const formFiltros = document.getElementById('formFiltros');
const spinner2 = document.getElementById('spinner2');
municionesDiv.innerHTML = `

`;

const buscarMuniciones = async (e = null) => {
    if (e) e.preventDefault();

    const formData = new FormData(formFiltros);
    municionesDiv.innerHTML = ``;
    try {
        spinner2.classList.remove('d-none');
        const url = `/API/municiones/buscar`
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
                    datos.forEach(municion => {
                        row.appendChild(construirCardMunicion(municion));
                    });
                } else {
                    row.innerHTML = `
                        <div class="col-12">
                            <div class="alert alert-primary" role="alert">
                                No se encontraron municiones. Intenta con otros filtros.
                            </div>
                        </div>
                    `;
                }
                municionesDiv.appendChild(row);
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

const construirCardMunicion = (municion) => {
    const div = document.createElement('div');
    const card = document.createElement('div');
    const cardBody = document.createElement('div');
    const cardTitle = document.createElement('h5');
    const cardText = document.createElement('p');
    const cardLink = document.createElement('a');
    const carousel = document.createElement('div');
    const badgePrice = document.createElement('span');
    const badgeAvailable = document.createElement('span');
    const badgeRounds = document.createElement('span');
    const cardFooter = document.createElement('div');
    const cardHeader = document.createElement('div');
    cardHeader.classList.add('card-header', 'd-flex', 'justify-content-between', 'align-items-center');
    cardFooter.classList.add('card-footer');
    cardFooter.classList.add('d-flex', 'justify-content-between', 'align-items-center');
    badgePrice.classList.add('badge', 'bg-success', 'fs-5');
    badgePrice.textContent = `Q. ${Number(municion.price_per_box).toLocaleString('es-GT', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
    badgeAvailable.classList.add('badge', `${municion.stock > 0 ? 'bg-success' : 'bg-danger'}`, 'float-end');
    badgeAvailable.textContent = `${municion.stock > 0 ? 'Disponible' : 'Agotado'}`;
    badgeRounds.classList.add('badge', 'bg-secondary');
    badgeRounds.textContent = `${municion.rounds_per_box} cartuchos por caja`;
    carousel.classList.add('carousel', 'slide');
    carousel.id = `carousel-${municion.id}`;
    carousel.setAttribute('data-bs-ride', 'carousel');
    div.classList.add('col-md-4', 'col-lg-4', 'col-12', 'mb-4', 'mb-lg-0', 'mb-xl-0');
    card.classList.add('card');
    card.style.height = '100%';
    cardBody.classList.add('card-body');
    cardTitle.classList.add('card-title');
    cardText.classList.add('card-text');
    cardLink.classList.add('btn', 'btn-primary');
    cardTitle.textContent = `${municion.brand}  ${municion.caliber}`;
    cardText.textContent = municion.description;
    cardLink.textContent = 'Ver más';
    cardLink.href = `/detalle/municiones/${municion.id}`;
    cardLink.style.marginBottom = '0';
    carousel.appendChild(construirCarousel(municion, municion.images));
    cardBody.appendChild(carousel);
    cardBody.appendChild(cardTitle);
    cardBody.appendChild(cardText);
    cardHeader.appendChild(badgePrice);
    cardFooter.appendChild(badgeRounds);
    cardFooter.appendChild(cardLink);
    cardHeader.appendChild(badgeAvailable);
    card.appendChild(cardHeader);
    card.appendChild(cardBody);
    card.appendChild(cardFooter);
    div.appendChild(card);
    return div;
}

const construirCarousel = (municion, images) => {
    const imagesArray = JSON.parse(images);
    const carousel = document.createElement('div');
    const indicators = document.createElement('div');
    indicators.classList.add('carousel-indicators');
    carousel.classList.add('carousel', 'slide');
    carousel.id = `carousel-${municion.id}`;
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
            indicator.setAttribute('data-bs-target', `#carousel-${municion.id}`);
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

formFiltros.addEventListener('change', buscarMuniciones);
buscarMuniciones();