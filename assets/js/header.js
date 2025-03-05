/**
 * Header JavaScript functionality for Garden CMS
 */

document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const navLinks = document.querySelector('.nav-links');
    
    if (mobileMenuBtn && navLinks) {
        mobileMenuBtn.addEventListener('click', function() {
            navLinks.classList.toggle('active');
        });
    }
    
    // Add smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Add sticky header functionality
    const header = document.querySelector('header');
    const nav = document.querySelector('nav');
    
    if (header && nav) {
        const headerHeight = header.offsetHeight;
        
        window.addEventListener('scroll', function() {
            if (window.scrollY > headerHeight) {
                nav.classList.add('sticky');
            } else {
                nav.classList.remove('sticky');
            }
        });
    }
});
