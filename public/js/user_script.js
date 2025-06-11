document.addEventListener("DOMContentLoaded", function() {
    console.log("DOM fully loaded and parsed");

    // Initialize Swiper
    initializeSwiper();

    // Loader functions
    setupLoader();

    // Limit number input length
    setupNumberInputs();

    // Load product details for quick view page
    if (document.getElementById('product-container')) {
        loadProductDetails();
    }

    // Search functionality (added for search.html)
    if (document.getElementById('products-container')) {
        loadSearchProducts();
    }
});

/* --- Swiper Initialization --- */
// For initializing the Swiper library used in the hero slider
function initializeSwiper() {
    new Swiper(".hero-slider", {
        loop: true,
        grabCursor: true,
        effect: "flip",
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        autoplay: {
            delay: 30000, // 3000 milliseconds = 3 seconds
            disableOnInteraction: false,
        },
    });
}

/* --- Navbar and Profile Initialization --- */
// For initializing the navbar and profile toggle
document.addEventListener('DOMContentLoaded', function() {
    function initializeNavbarAndProfile() {
        const navbar = document.querySelector('.header .flex .navbar');
        const profile = document.querySelector('.header .flex .profile');
        const menuBtn = document.querySelector('#menu-btn');
        const userBtns = document.querySelectorAll('#user-btn');
        const mobileSearchBtn = document.querySelector('.mobile-search');
        const desktopSearchBtn = document.querySelector('.desktop-search');

        // Function to toggle the navbar
        const toggleNavbar = () => {
            navbar.classList.toggle('active');
            profile.classList.remove('active');
        };

        // Function to toggle the profile
        const toggleProfile = () => {
            profile.classList.toggle('active');
            navbar.classList.remove('active');
        };

        if (menuBtn) {
            menuBtn.addEventListener('click', toggleNavbar);
        }

        if (userBtns.length > 0) {
            userBtns.forEach(userBtn => {
                userBtn.addEventListener('click', toggleProfile);
            });
        }

        if (mobileSearchBtn) {
            mobileSearchBtn.addEventListener('click', () => {
                navbar.classList.remove('active');
                profile.classList.remove('active');
            });
        }

        if (desktopSearchBtn) {
            desktopSearchBtn.addEventListener('click', () => {
                navbar.classList.remove('active');
                profile.classList.remove('active');
            });
        }

        // Close navbar and profile when scrolling
        window.addEventListener('scroll', () => {
            navbar.classList.remove('active');
            profile.classList.remove('active');
        });

        // Close navbar and profile when clicking outside
        document.addEventListener('click', (event) => {
            if (!event.target.closest('.header')) {
                navbar.classList.remove('active');
                profile.classList.remove('active');
            }
        });
    }

    initializeNavbarAndProfile();
});


/* --- Loader Functions --- */
// For setting up the loader animation
function setupLoader() {
    function loader() {
        document.querySelector('.loader').style.display = 'none';
    }

    function showLoader() {
        document.querySelector('.loader').style.display = 'block';
    }

    function hideLoader() {
        showLoader();
        document.querySelector('.loader').style.display = 'none';
        showLoader();
    }

    function fadeOut() {
        setInterval(loader, 1600);
    }

    window.onload = fadeOut;
}

/* --- Input Limit Setup --- */
// For setting up the input fields to limit their length
function setupNumberInputs() {
    document.querySelectorAll('input[type="number"]').forEach(numberInput => {
        numberInput.oninput = () => {
            if (numberInput.value.length > numberInput.maxLength) {
                numberInput.value = numberInput.value.slice(0, numberInput.maxLength);
            }
        };
    });
}


/* --- add-to-cart-form --- */
document.addEventListener('DOMContentLoaded', function () {
    // --- Add to Cart (all forms with cart button) ---
    document.querySelectorAll('form').forEach(form => {
        const hasCartButton =
            form.querySelector('button.fa-shopping-cart') ||
            form.querySelector('button.cart-btn[name="add_to_cart"]');
        if (hasCartButton && !form.dataset.cartListener) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(this);

                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showPopupMessage(data.message || 'Product added to cart successfully!');
                        // Update cart count badge
                        if (typeof data.cartCount !== 'undefined') {
                            const badge = document.getElementById('cart-count-badge');
                            if (badge) {
                                badge.textContent = data.cartCount;
                                badge.style.display = data.cartCount > 0 ? 'inline' : 'none';
                            }
                        }
                    } else if (data.message) {
                        showPopupMessage(data.message);
                    } else {
                        showPopupMessage('Could not add product to cart.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showPopupMessage('An error occurred.');
                });
            });
            form.dataset.cartListener = "true";
        }
    });

    // --- Cart Order Confirm (cart page only) ---
    const cartForm = document.querySelector('form.cart-actions');
    if (cartForm && !cartForm.dataset.orderListener) {
        cartForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showPopupMessage(data.message || 'Order confirmed!');
                    // Clear the cart UI
                    const cartSection = document.querySelector('.products');
                    if (cartSection) {
                        cartSection.innerHTML = '<div class="empty">Your cart is now empty!</div>';
                    }
                    // Update cart count badge
                    if (typeof data.cartCount !== 'undefined') {
                        const badge = document.getElementById('cart-count-badge');
                        if (badge) {
                            badge.textContent = data.cartCount;
                            badge.style.display = data.cartCount > 0 ? 'inline' : 'none';
                        }
                    }
                } else {
                    showPopupMessage(data.message || 'Could not confirm order.');
                }
            })
            .catch(error => {
                showPopupMessage('An error occurred.');
            });
        });
        cartForm.dataset.orderListener = "true";
    }
});

function showPopupMessage(message) {
    const popup = document.createElement('div');
    popup.className = 'popup-message';
    popup.textContent = message;
    document.body.appendChild(popup);

    setTimeout(() => {
        popup.remove();
    }, 3000); // Hide the message after 3 seconds
}
