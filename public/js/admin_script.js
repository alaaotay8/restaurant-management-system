// Import necessary dependencies
import './bootstrap';

// Function to handle navbar and profile toggle
function initializeNavbarAndProfile() {
    const profile = document.querySelector('.header .flex .profile');
    const navbar = document.querySelector('.header .flex .navbar');
    const menuBtn = document.querySelector('#menu-btn');

    // Toggle navbar visibility when menu button is clicked
    if (menuBtn) {
        menuBtn.onclick = (event) => {
            event.stopPropagation(); // Prevent click from reaching the document
            navbar.classList.toggle('active');
            profile.classList.remove('active'); // Ensure profile is closed
        };
    }

    // Close both navbar and profile on window scroll
    window.onscroll = () => {
        profile.classList.remove('active');
        navbar.classList.remove('active');
    };

    // Close both navbar and profile when clicking outside
    document.addEventListener('click', (event) => {
        // Check if the click is outside the navbar and menu button
        if (navbar.classList.contains('active') && !navbar.contains(event.target) && !menuBtn.contains(event.target)) {
            navbar.classList.remove('active');
        }
    });
}

// Initialize image switching for update product section
function initializeImageSwitching() {
    const subImages = document.querySelectorAll('.update-product .image-container .sub-images img');
    const mainImage = document.querySelector('.update-product .image-container .main-image img');

    // Change main image source to clicked sub image's source
    subImages.forEach((image) => {
        image.onclick = () => {
            const src = image.getAttribute('src');
            mainImage.src = src;
        };
    });
}

// Function to handle add order dropdown behavior
function initializeAddOrderDropdown() {
    const dropdown = document.querySelector('.add-order .anchor');
    const items = document.querySelector('.add-order .anchor .items');

    // Initialize the dropdown items to be hidden
    if (items) {
        items.style.display = 'none';
    }

    // Toggle the visibility of dropdown items when dropdown is clicked
    if (dropdown) {
        dropdown.addEventListener('click', (event) => {
            event.stopPropagation(); // Prevent click from closing the dropdown
            items.style.display = (items.style.display === 'block') ? 'none' : 'block';
        });
    }

    // Close the dropdown when clicking outside of it
    document.addEventListener('click', (event) => {
        if (dropdown && !dropdown.contains(event.target)) {
            items.style.display = 'none';
        }
    });

    // Prevent click inside dropdown items from closing the dropdown
    if (items) {
        items.addEventListener('click', (event) => {
            event.stopPropagation();
        });
    }
}

// Document ready event to initialize all functionality
document.addEventListener('DOMContentLoaded', () => {
    initializeNavbarAndProfile();
    initializeImageSwitching();
    initializeAddOrderDropdown();
});



// show popup message for cart


