import Swiper from "swiper";
import { Autoplay, Navigation } from "swiper/modules";


const enlacesSwiper = new Swiper(".enlacesSwiper", {
    modules: [Navigation, Autoplay],
    slidesPerView: 5,
    spaceBetween: 60,
    loop: true,
    autoplay: {
        delay: 2500, // tiempo entre movimientos (ms)
        disableOnInteraction: false, // sigue moviéndose aunque el usuario toque
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        1024: { slidesPerView: 5, spaceBetween: 50 },
        768: { slidesPerView: 4, spaceBetween: 40 },
        480: { slidesPerView: 3, spaceBetween: 30 },
        0: { slidesPerView: 2, spaceBetween: 20 },
    },
});