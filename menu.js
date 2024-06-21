const nav = document.querySelector('.nav');

    window.addEventListener('scroll', function(){
        nav.classList.toggle('active', window.scrollY >0)
    }) 

    document.addEventListener('DOMContentLoaded', function () {
        const nav = document.querySelector('.nav');
    
        window.addEventListener('scroll', function () {
            if (window.scrollY > 0) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });
    });