try {
    window.$ = window.jQuery = require('jquery');
    window.Popper = require('popper.js').default;
} catch (e) {}
require('particles.js');

// import Glide, { Autoplay } from '@glidejs/glide'
import Swiper from 'swiper';


const swiper = new Swiper('.swiper-container',{
    loop: true,
    effect: 'flip',
    speed: 900,
    autoHeight: true,
    autoplay: {
        delay: 2000,
    },
});

setInterval(() => {
    let a =swiper.slideNext()
}, 3000);


try {
    particlesJS.load('particles-js', 'public/images/particles.json', function() {
        // console.log('callback - particles.js config loaded');
    });
} catch (error) {
    console.log(error)
}


