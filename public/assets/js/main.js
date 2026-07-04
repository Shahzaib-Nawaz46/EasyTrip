/**
 * EasyTrip Main JavaScript File
 */

document.addEventListener('DOMContentLoaded', () => {
    console.log('EasyTrip Frontend Initialized.');

    // Mobile Navbar Toggle
    const hamburger = document.querySelector('.hamburger-menu');
    const navMenu = document.querySelector('.navbar-menu');
    
    if (hamburger && navMenu) {
        hamburger.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            // Toggle icon between bars and times (close)
            const icon = hamburger.querySelector('i');
            if (icon) {
                if (navMenu.classList.contains('active')) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-xmark');
                } else {
                    icon.classList.remove('fa-xmark');
                    icon.classList.add('fa-bars');
                }
            }
        });
    }
});
