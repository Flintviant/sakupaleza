document.addEventListener('DOMContentLoaded', function() {

    // Select the hamburger and nav-links elements
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.getElementById('navLinks');
    
    // Add event listener for toggle
    hamburger.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    });
});