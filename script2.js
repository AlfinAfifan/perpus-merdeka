// const menu = document.getElementById('toggle');
const container = document.querySelector('.container');
const judul = document.getElementById('judul');
const expand = document.querySelector('.expand');
const nav = document.getElementsByTagName('nav');



// Menu navigasi
container.addEventListener('click', function(e) {
    if( e.target.classList.contains('toggle') ) {
        expand.classList.add('slide');
        judul.style.opacity = '0';
    }
});

container.addEventListener('click', function(e) {
    if( e.target.classList.contains('tombol') ) {
        expand.classList.remove('slide');
        judul.style.opacity = '1';
    }
})


// Tombol reset
// const form = document.getElementById('form');
// const reset = document.getElementsByName('reset');

// reset.addEventListener('click', function() {
//     form.reset();
// })





window.onscroll = function() {
    nav.classList.add('scroll');
}
