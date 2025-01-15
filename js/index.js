document.addEventListener('DOMContentLoaded', () => {
    // DOM Elements
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const closeMobileMenuBtn = document.getElementById('closeMobileMenu');
    const mobileMenu = document.getElementById('mobileMenu');
    const loginBtn = document.getElementById('loginBtn');
    const registerBtn = document.getElementById('registerBtn');
    const coursesContainer = document.querySelector('#courses .grid');

    // Data for popular courses
    const popularCourses = [
        {
            title: "JavaScript Moderne",
            description: "Maîtrisez JavaScript ES6+ et les dernières fonctionnalités",
            instructor: "Marie Dupont",
            price: "49.99€",
            rating: 4.8,
            students: 1234,
            image: "/api/placeholder/400/225"
        },
        {
            title: "Python pour débutants",
            description: "Apprenez Python de zéro avec des projets pratiques",
            instructor: "Jean Martin",
            price: "39.99€",
            rating: 4.9,
            students: 2156,
            image: "/api/placeholder/400/225"
        },
        {
            title: "Design Web Responsive",
            description: "Créez des sites web modernes et adaptatifs",
            instructor: "Sophie Bernard",
            price: "59.99€",
            rating: 4.7,
            students: 987,
            image: "/api/placeholder/400/225"
        }
    ];

    // Mobile Menu Toggle
    function toggleMobileMenu() {
        mobileMenu.classList.toggle('hidden');
        document.body.classList.toggle('overflow-hidden');
    }

    mobileMenuBtn.addEventListener('click', toggleMobileMenu);
    closeMobileMenuBtn.addEventListener('click', toggleMobileMenu);

    // Close mobile menu when clicking outside
    mobileMenu.addEventListener('click', (e) => {
        if (e.target === mobileMenu) {
            toggleMobileMenu();
        }
    });

    // Function to create star rating
    function createStarRating(rating) {
        const fullStars = Math.floor(rating);
        const hasHalfStar = rating % 1 !== 0;
        const emptyStars = 5 - Math.ceil(rating);
        
        let starsHTML = '';
        
        // Full stars
        for (let i = 0; i < fullStars; i++) {
            starsHTML += '<svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>';
        }
        
        // Half star
        if (hasHalfStar) {
            starsHTML += '<svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>';
        }
        
        // Empty stars
        for (let i = 0; i < emptyStars; i++) {
            starsHTML += '<svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>';
        }
        
        return starsHTML;
    }

    // Function to create course card
    function createCourseCard(course) {
        return `
            <div class="bg-white rounded-lg shadow-sm overflow-hidden transition-transform duration-300 hover:-translate-y-1">
                <img src="${course.image}" alt="${course.title}" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="font-semibold text-lg mb-2">${course.title}</h3>
                    <p class="text-gray-600 text-sm mb-4">${course.description}</p>
                    <div class="flex items-center mb-4">
                        <p class="text-sm text-gray-600">Par ${course.instructor}</p>
                    </div>
                    <div class="flex items-center mb-4">
                        <div class="flex items-center">
                            ${createStarRating(course.rating)}
                        </div>
                        <span class="text-sm text-gray-600 ml-2">${course.rating} (${course.students} étudiants)</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-lg">${course.price}</span>
                        <button class="px-4 py-2 bg-gradient-to-r from-red-600 to-orange-500 text-white rounded-lg hover:opacity-90 transition-opacity">
                            En savoir plus
                        </button>
                    </div>
                </div>
            </div>
        `;
    }

    // Render course cards
    if (coursesContainer) {
        popularCourses.forEach(course => {
            coursesContainer.innerHTML += createCourseCard(course);
        });
    }

    // Smooth scroll for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                // Close mobile menu if open
                if (!mobileMenu.classList.contains('hidden')) {
                    toggleMobileMenu();
                }
            }
        });
    });

    // Newsletter form submission
    const newsletterForm = document.querySelector('footer form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const emailInput = newsletterForm.querySelector('input[type="email"]');
            if (emailInput.value) {
                alert('Merci de votre inscription à la newsletter !');
                emailInput.value = '';
            }
        });
    }

    // Header scroll effect
    let lastScroll = 0;
    const header = document.querySelector('nav');
    
    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll <= 0) {
            header.classList.remove('shadow-md');
            return;
        }
        
        if (currentScroll > lastScroll && currentScroll > 100) {
            // Scrolling down
            header.classList.add('shadow-md');
        } else {
            // Scrolling up
            header.classList.remove('shadow-md');
        }
        
        lastScroll = currentScroll;
    });
});