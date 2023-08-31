require('@fortawesome/fontawesome-free/js/all');

import '../js/react/search/Search';

const jshtml = document.querySelector('html')

const themeSwitcherBtn = document.getElementById('js-theme-switcher')
themeSwitcherBtn.addEventListener('click', function(){
    if(jshtml.dataset.theme === 'tutomarks') {
        jshtml.setAttribute('data-theme', 'night')
    } else {
        jshtml.setAttribute('data-theme', 'tutomarks')
    }
})


const ratio = .1
const options = {
    root: null,
    rootMargin: '0px',
    threshold: ratio
}

const handleIntersect = function (entries, observer) {
    entries.forEach(function (entry) {
        if(entry.intersectionRatio > ratio) {
            entry.target.classList.add('reveal-visible')
            observer.unobserve(entry.target)
        }
    })
}

const observer = new IntersectionObserver(handleIntersect, options);
document.querySelectorAll('.reveal').forEach(function (r) {
    observer.observe(r)
})




const navbar = document.querySelector('#navHeader');
if(navbar){
    window.onscroll = () => {
        if (window.scrollY > 400) {
            navbar.classList.add('bg-base-100');
        } else {
            navbar.classList.remove('bg-base-100');
        }
    };
}
