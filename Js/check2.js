// redirect.js
document.addEventListener("DOMContentLoaded", function() {
    // Tiempo de espera en milisegundos
    const waitTime = 3700;

    // URL de redirección local
    const redirectTo = "http://localhost/BORRADORINTEGRADORA/index/"; // Ajusta esto a tu ruta local

    // Función de redirección
    setTimeout(function() {
        window.location.href = redirectTo;
    }, waitTime);
});
