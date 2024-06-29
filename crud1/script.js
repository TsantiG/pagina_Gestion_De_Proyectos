
let indiceActual = 0;

document.addEventListener('DOMContentLoaded', function() {
    mostrarImagen(indiceActual);
});

function mover(n) {
    mostrarImagen(indiceActual += n);
}

function mostrarImagen(n) {
    let imagenes = document.querySelectorAll('.imagenes img');
    if (n >= imagenes.length) {
        indiceActual = 0;
    }
    if (n < 0) {
        indiceActual = imagenes.length - 1;
    }
    for (let img of imagenes) {
        img.style.display = "none";
    }
    imagenes[indiceActual].style.display = "block";
}