const { Toast } = require("../funciones");


const armasDiv = document.getElementById('armasDiv');
const formFiltros = document.getElementById('formFiltros');
const spinner2 = document.getElementById('spinner2');
armasDiv.innerHTML = `

`;

const buscarArmas = async (e = null) => {
    if (e) e.preventDefault();

    const formData = new FormData(formFiltros);
    armasDiv.innerHTML = ``;
    try {
        spinner2.classList.remove('d-none');
        const url = `/API/armas/buscar`
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
                    datos.forEach(arma => {
                        row.appendChild(construirCardArma(arma));
                    });
                } else {
                    row.innerHTML = `
                        <div class="col-12">
                            <div class="alert alert-primary" role="alert">
                                No se encontraron armas. Intenta con otros filtros.
                            </div>
                        </div>
                    `;
                }
                armasDiv.appendChild(row);
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

const construirCardArma = (arma) => {
    const div = document.createElement('div');
    const card = document.createElement('div');
    const cardBody = document.createElement('div');
    const cardTitle = document.createElement('h5');
    const cardText = document.createElement('p');
    const cardLink = document.createElement('a');
    const carousel = document.createElement('div');
    const badgePrice = document.createElement('span');
    const badgeAvailable = document.createElement('span');
    const cardFooter = document.createElement('div');
    const cardHeader = document.createElement('div');
    const badgeMagazine = document.createElement('span');
    const badgecanion = document.createElement('span');
    const badgeColor = document.createElement('span');
    const buttonWhatsapp = document.createElement('a')

    cardHeader.classList.add('card-header', 'd-flex', 'justify-content-between', 'align-items-center');
    cardFooter.classList.add('card-footer');
    cardFooter.classList.add('d-flex', 'justify-content-between', 'align-items-center');
    badgePrice.classList.add('badge', 'bg-success', 'float-start', 'fs-5');
    badgePrice.textContent = `Q. ${Number(arma.price).toLocaleString('es-GT', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
    badgeAvailable.classList.add('badge', `${arma.stock > 0 ? 'bg-success' : 'bg-danger'}`, 'float-end');
    badgeAvailable.textContent = `${arma.stock > 0 ? 'Disponible' : 'Agotado'}`;
    badgeMagazine.classList.add('badge', 'bg-primary', 'float-start');
    badgeMagazine.textContent = `Cargador: ${arma.magazine_capacity} rounds`;
    badgecanion.classList.add('badge', 'bg-primary', 'float-start');
    badgecanion.textContent = `Largo del cañon: ${arma.barrel_length_mm}`;
    badgeColor.classList.add('badge', 'float-start');
    badgeColor.style.backgroundColor = `${arma.color}`;
    badgeColor.textContent = `${arma.color_text}`;

    badgeMagazine.style.display = `${arma.magazine_capacity > 0 ? 'block' : 'none'}`;
    badgecanion.style.display = `${arma.barrel_length_mm > 0 ? 'block' : 'none'}`;
    badgeColor.style.display = `${arma.color_text && arma.color ? 'block' : 'none'}`;
    carousel.classList.add('carousel', 'slide');
    carousel.id = `carousel-${arma.id}`;
    carousel.setAttribute('data-bs-ride', 'carousel');
    div.classList.add('col-md-4', 'col-lg-4', 'col-12', 'mb-4', 'mb-lg-4', 'mb-xl-4');
    card.classList.add('card');
    card.style.height = '100%';
    cardBody.classList.add('card-body');
    cardTitle.classList.add('card-title');
    cardText.classList.add('card-text');
    cardLink.classList.add('btn', 'btn-primary');
    cardTitle.textContent = `${arma.brand} ${arma.model} ${arma.caliber} ${arma.weapon_type}`;
    cardText.textContent = arma.description;
    cardLink.textContent = 'Ver más';
    cardLink.href = `/detalle/armas/${arma.id}`;
    cardLink.style.marginBottom = '0';
    buttonWhatsapp.classList.add('btn', 'btn-success');
    buttonWhatsapp.innerHTML = '<i class="fa fa-whatsapp me-2"></i> Consultar';
    buttonWhatsapp.href = `https://wa.me/502${process.env.TELEFONO}?text=Hola,%20quiero%20más%20información%20sobre%20el%20producto%20${arma.brand}%20${arma.model}%20${arma.caliber}%20${arma.weapon_type}`;
    buttonWhatsapp.target = '_blank';
    buttonWhatsapp.style.marginBottom = '0';
    carousel.appendChild(construirCarousel(arma, arma.images));
    cardBody.appendChild(carousel);
    cardBody.appendChild(cardTitle);
    cardBody.appendChild(cardText);
    cardBody.appendChild(badgeMagazine);
    cardBody.appendChild(badgecanion);
    cardBody.appendChild(badgeColor);
    cardHeader.appendChild(badgePrice);
    cardFooter.appendChild(cardLink);
    cardHeader.appendChild(badgeAvailable);
    cardFooter.appendChild(buttonWhatsapp);
    card.appendChild(cardHeader);
    card.appendChild(cardBody);
    card.appendChild(cardFooter);
    div.appendChild(card);
    return div;
}

const construirCarousel = (arma, images) => {
    const imagesArray = JSON.parse(images);
    const carousel = document.createElement('div');
    const indicators = document.createElement('div');
    indicators.classList.add('carousel-indicators');
    carousel.classList.add('carousel', 'slide');
    carousel.id = `carousel-${arma.id}`;
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
            indicator.setAttribute('data-bs-target', `#carousel-${arma.id}`);
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

formFiltros.addEventListener('change', buscarArmas);
buscarArmas();