document.addEventListener('DOMContentLoaded', function() {
    function applyHoverEffect(event) {
        event.currentTarget.style.width = '1250px';
        event.currentTarget.querySelector('h2').style.opacity = '1';
        event.currentTarget.querySelector('h2').style.bottom = '25px';
        event.currentTarget.querySelector('h3').style.opacity = '1';
        event.currentTarget.querySelector('h3').style.bottom = '0';
    }

    function removeHoverEffect(event) {
        event.currentTarget.style.width = '350px';
        event.currentTarget.querySelector('h2').style.opacity = '0';
        event.currentTarget.querySelector('h2').style.bottom = '0';
        event.currentTarget.querySelector('h3').style.opacity = '0';
        event.currentTarget.querySelector('h3').style.bottom = '0';
    }

    function removeEffectsOnSmallScreens() {
        if (window.innerWidth < 769) {
            document.querySelectorAll('.imgBox').forEach(imgBox => {
                imgBox.style.transition = 'none';
                imgBox.querySelector('h2').style.transition = 'none';
                imgBox.querySelector('h3').style.transition = 'none';
                imgBox.removeEventListener('mouseover', applyHoverEffect);
                imgBox.removeEventListener('mouseout', removeHoverEffect);
            });
        } else {
            document.querySelectorAll('.imgBox').forEach(imgBox => {
                imgBox.style.transition = 'all 1s ease';
                imgBox.querySelector('h2').style.transition = 'all 1s ease';
                imgBox.querySelector('h3').style.transition = 'all 1s ease';
                imgBox.addEventListener('mouseover', applyHoverEffect);
                imgBox.addEventListener('mouseout', removeHoverEffect);
            });
        }
    }

    // Actualizar la URL de redirección
    const redirectUrl = 'Views/vistahab.php';

    document.querySelectorAll('.imgBox').forEach(function(imgBox) {
        imgBox.addEventListener('click', function() {
            window.location.href = redirectUrl;
        });
    });

    window.addEventListener('resize', removeEffectsOnSmallScreens);
    removeEffectsOnSmallScreens();
});



