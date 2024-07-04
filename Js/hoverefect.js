document.addEventListener('DOMContentLoaded', function() {
    function removeEffectsOnSmallScreens() {
        if (window.innerWidth < 769) {
            document.querySelectorAll('.imgBox').forEach(imgBox => {
                imgBox.style.transition = 'none';
                imgBox.querySelector('h3').style.transition = 'none';
                imgBox.removeEventListener('mouseover', applyHoverEffect);
                imgBox.removeEventListener('mouseout', removeHoverEffect);
            });
        } else {
            document.querySelectorAll('.imgBox').forEach(imgBox => {
                imgBox.style.transition = 'all 1s ease';
                imgBox.querySelector('h3').style.transition = 'all 1s ease';
                imgBox.addEventListener('mouseover', applyHoverEffect);
                imgBox.addEventListener('mouseout', removeHoverEffect);
            });
        }
    }

    function applyHoverEffect(event) {
        event.currentTarget.style.width = '1250px';
        event.currentTarget.querySelector('h3').style.opacity = '1';
        event.currentTarget.querySelector('h3').style.bottom = '25px';
    }

    function removeHoverEffect(event) {
        event.currentTarget.style.width = '350px';
        event.currentTarget.querySelector('h3').style.opacity = '0';
        event.currentTarget.querySelector('h3').style.bottom = '0';
    }

    document.querySelectorAll('.imgBox').forEach(function(imgBox) {
        imgBox.addEventListener('click', function() {
            const url = imgBox.getAttribute('data-url');
            if (url) {
                window.location.href = url;
            }
        });
    });

    window.addEventListener('resize', removeEffectsOnSmallScreens);
    removeEffectsOnSmallScreens();
});

