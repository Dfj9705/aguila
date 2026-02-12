const { Toast } = require("../funciones");


const armasDiv = document.getElementById('armasDiv');

armasDiv.innerHTML = `

`;

const buscarArmas = async (e) => {
    try {
        const url = `/API/armas/buscar`
        const headers = new Headers();
        headers.append('X-Requested-With', 'fetch');
        const config = {
            method: 'GET',
            headers,
        }

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data);
        const { codigo, mensaje, detalle, datos } = data;

        let icon = "info";
        switch (codigo) {
            case 1:
                icon = "success"
                console.log(data);
                const row = document.createElement('div');
                row.classList.add('row');
                datos.forEach(arma => {
                    row.appendChild(construirCardArma(arma));
                });
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
    carousel.classList.add('carousel', 'slide');
    carousel.id = `carousel-${arma.id}`;
    carousel.setAttribute('data-bs-ride', 'carousel');
    div.classList.add('col-md-4');
    card.classList.add('card');
    cardBody.classList.add('card-body');
    cardTitle.classList.add('card-title');
    cardText.classList.add('card-text');
    cardLink.classList.add('btn', 'btn-primary');
    cardTitle.textContent = `${arma.brand} ${arma.model} ${arma.caliber} ${arma.weapon_type}`;
    cardText.textContent = arma.descripcion;
    cardLink.textContent = 'Ver más';
    cardLink.href = `/detalle/${arma.id}`;
    carousel.appendChild(construirCarousel(arma, arma.images));
    cardBody.appendChild(carousel);
    cardBody.appendChild(cardTitle);
    cardBody.appendChild(cardText);
    cardBody.appendChild(cardLink);
    card.appendChild(cardBody);
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
    carousel.appendChild(carouselInner);
    carousel.appendChild(indicators);
    return carousel;
}

buscarArmas();