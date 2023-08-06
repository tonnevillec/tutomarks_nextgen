require('@fortawesome/fontawesome-free/js/all');

const jshtml = document.querySelector('html')
console.log(jshtml.dataset.theme)

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