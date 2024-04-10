import './bootstrap';
import Alpine from 'alpinejs';
import PhotoSwipeLightbox from "photoswipe/lightbox";

const lightbox = new PhotoSwipeLightbox({
    gallery: ".gallery",
    children: "a",
    pswpModule: () => import("photoswipe")
});

lightbox.init();

window.Alpine = Alpine;

Alpine.start();
