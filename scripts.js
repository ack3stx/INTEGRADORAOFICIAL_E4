function showSection(sectionId) {
    // Ocultar todas las secciones de contenido
    const sections = document.querySelectorAll('.content-section');
    sections.forEach(section => section.style.display = 'none');
    
    // Mostrar la sección seleccionada
    const selectedSection = document.getElementById(sectionId);
    if (selectedSection) {
        selectedSection.style.display = 'block';
    }
}

// Mostrar la sección "Reservaciones" por defecto
document.addEventListener('DOMContentLoaded', () => {
    showSection('reservaciones');
});
