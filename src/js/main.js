import WOW from 'wow.js';
import 'jquery';
// import 'owl.carousel';
// import 'waypoints/lib/jquery.waypoints';
import { CountUp } from 'countup.js';

document.addEventListener('DOMContentLoaded', () => {
    "use strict";

    // Spinner
    const spinner = () => {
        setTimeout(() => {
            const spinnerElement = document.getElementById('spinner');
            if (spinnerElement) {
                spinnerElement.classList.remove('show');
            }
        }, 100);
    };
    spinner();

    // Initiate the wowjs
    new WOW().init();

    // Sticky Navbar
    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            document.querySelector('.sticky-top').classList.add('shadow-sm', 'bg-dark');
            document.querySelector('.sticky-top').style.top = '-1px';
        } else {
            // document.querySelector('.sticky-top').classList.remove('bg-white', 'shadow-sm');
            document.querySelector('.sticky-top').style.top = '-100px';
        }
    });

    // Facts counter
    const counterUpElements = document.querySelectorAll('[data-toggle="counter-up"]');
    counterUpElements.forEach(element => {
        console.log(element.textContent);
        var countUp = new CountUp(element, parseInt(element.textContent));
        countUp.start();
    });

    // Experience
    const experienceElement = document.querySelector('.experience');
    if (experienceElement) {
        const waypoint = new Waypoint({
            element: experienceElement,
            handler: function () {
                const progressBarElements = document.querySelectorAll('.progress .progress-bar');
                progressBarElements.forEach(bar => {
                    bar.style.width = bar.getAttribute("aria-valuenow") + '%';
                });
            },
            offset: '80%'
        });
    }

    // Back to top button
    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            document.querySelector('.back-to-top').classList.remove('d-none')
            document.querySelector('.back-to-top').classList.add('d-flex')
        } else {
            document.querySelector('.back-to-top').classList.remove('d-flex')
            document.querySelector('.back-to-top').classList.add('d-none')
        }
    });

    const backToTopButton = document.querySelector('.back-to-top');
    if (backToTopButton) {
        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Modal Video
    let $videoSrc;
    const btnPlayElements = document.querySelectorAll('.btn-play');
    btnPlayElements.forEach(element => {
        element.addEventListener('click', function () {
            $videoSrc = this.getAttribute("data-src");
        });
    });

    const videoModal = document.getElementById('videoModal');
    if (videoModal) {
        videoModal.addEventListener('shown.bs.modal', (e) => {
            const videoElement = document.getElementById('video');
            if (videoElement) {
                videoElement.setAttribute('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
            }
        });

        videoModal.addEventListener('hide.bs.modal', (e) => {
            const videoElement = document.getElementById('video');
            if (videoElement) {
                videoElement.setAttribute('src', $videoSrc);
            }
        });
    }

    // Testimonial carousel
    const testimonialCarousel = $(".testimonial-carousel");
    if (testimonialCarousel.length) {
        testimonialCarousel.owlCarousel({
            autoplay: true,
            smartSpeed: 1000,
            items: 1,
            loop: true,
            dots: false,
            nav: true,
            navText: [
                '<i class="bi bi-arrow-left"></i>',
                '<i class="bi bi-arrow-right"></i>'
            ]
        });
    }
});