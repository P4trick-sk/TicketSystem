import './bootstrap';
import Alpine from 'alpinejs';
import PhotoSwipeLightbox from "photoswipe/lightbox";
import ApexCharts from 'apexcharts';
import './popper.min.js';
import SimpleBar from 'simplebar';
import './bootstrap.min.js';
import './custom-font.js';
import './pcoded.js';
import './feather.min.js';

const lightbox = new PhotoSwipeLightbox({
    gallery: ".gallery",
    children: "a",
    pswpModule: () => import("photoswipe")
});

lightbox.init();

window.Alpine = Alpine;
window.ApexCharts = ApexCharts;
window.SimpleBar = SimpleBar;

Alpine.start();
