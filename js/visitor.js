document.addEventListener('DOMContentLoaded', () => {
    // DOM Elements
    const searchInput = document.getElementById('searchInput');
    const coursesGrid = document.getElementById('coursesGrid');
    const pagination = document.getElementById('pagination');
    const createAccountModal = document.getElementById('createAccountModal');
    const closeModal = document.getElementById('closeModal');
    const createAccountForm = document.getElementById('createAccountForm');

    let courses = [];
    let currentPage = 1;
    const itemsPerPage = 6;

    // Sample Courses Data
    function generateSampleCourses() {
        for (let i = 1; i <= 30; i++) {
            courses.push({
                id: i,
                title: `Cours ${i}`,
                description: `Description du cours ${i}`,
                category: i % 2 === 0 ? 'Développement' : 'Design',
                image: 'https://via.placeholder.com/150',
            });
        }
    }

    // Render Courses
    function renderCourses(page = 1) {
        coursesGrid.innerHTML = '';
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = page * itemsPerPage;
        const visibleCourses = courses.slice(startIndex, endIndex);

        visibleCourses.forEach(course => {
            const courseCard = document.createElement('div');
            courseCard.className = 'bg-white rounded-lg shadow-sm overflow-hidden';
            courseCard.innerHTML = `
                <img src="${course.image}" alt="${course.title}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-lg">${course.title}</h3>
                    <p class="text-sm text-gray-600">${course.description}</p>
                    <p class="text-sm text-gray-500 mt-2">Catégorie: ${course.category}</p>
                </div>
            `;
            coursesGrid.appendChild(courseCard);
        });

        renderPagination();
    }

    // Render Pagination
    function renderPagination() {
        pagination.innerHTML = '';
        const totalPages = Math.ceil(courses.length / itemsPerPage);

        for (let i = 1; i <= totalPages; i++) {
            const pageButton = document.createElement('button');
            pageButton.className = `px-4 py-2 border rounded ${i === currentPage ? 'bg-red-600 text-white' : 'bg-white'}`;
            pageButton.textContent = i;
            pageButton.addEventListener('click', () => {
                currentPage = i;
                renderCourses(currentPage);
            });
            pagination.appendChild(pageButton);
        }
    }

    // Search Functionality
    searchInput.addEventListener('input', () => {
        const query = searchInput.value.toLowerCase();
        const filteredCourses = courses.filter(course =>
            course.title.toLowerCase().includes(query) ||
            course.description.toLowerCase().includes(query) ||
            course.category.toLowerCase().includes(query)
        );
        coursesGrid.innerHTML = '';
        filteredCourses.slice(0, itemsPerPage).forEach(course => {
            const courseCard = document.createElement('div');
            courseCard.className = 'bg-white rounded-lg shadow-sm overflow-hidden';
            courseCard.innerHTML = `
                <img src="${course.image}" alt="${course.title}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-lg">${course.title}</h3>
                    <p class="text-sm text-gray-600">${course.description}</p>
                    <p class="text-sm text-gray-500 mt-2">Catégorie: ${course.category}</p>
                </div>
            `;
            coursesGrid.appendChild(courseCard);
        });
    });

    // Show Create Account Modal
    document.querySelector('a[href="#createAccount"]').addEventListener('click', (e) => {
        e.preventDefault();
        createAccountModal.classList.remove('hidden');
        createAccountModal.classList.add('flex');
    });

    // Close Modal
    closeModal.addEventListener('click', () => {
        createAccountModal.classList.add('hidden');
    });

    // Handle Account Creation
    createAccountForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const username = document.getElementById('username').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const role = document.getElementById('role').value;

        if (username && email && password && role) {
            alert(`Compte créé avec succès pour ${username} en tant que ${role === 'student' ? 'Étudiant' : 'Enseignant'}`);
            createAccountModal.classList.add('hidden');
            createAccountForm.reset();
        } else {
            alert('Veuillez remplir tous les champs.');
        }
    });

    // Initialize
    generateSampleCourses();
    renderCourses();
});