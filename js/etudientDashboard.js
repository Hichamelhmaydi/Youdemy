const courses = [
    {
        id: 1,
        title: "JavaScript Moderne",
        description: "Maîtrisez JavaScript ES6+ et les dernières fonctionnalités",
        instructor: "Marie Dupont",
        price: "49.99€",
        rating: 4.8,
        students: 1234,
        image: "/api/placeholder/400/225",
        category: "development",
        level: "intermediate",
        duration: "20h",
        chapters: [
            "Introduction à ES6+",
            "Promises et Async/Await",
            "Modules et Bundlers",
            "Testing et Debugging"
        ]
    },
    // Add more courses here...
];

// User's enrolled courses
let enrolledCourses = [];

document.addEventListener('DOMContentLoaded', () => {
    // DOM Elements
    const catalogueBtn = document.getElementById('catalogueBtn');
    const myCoursesBtn = document.getElementById('myCoursesBtn');
    const catalogueView = document.getElementById('catalogueView');
    const myCoursesView = document.getElementById('myCoursesView');
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const levelFilter = document.getElementById('levelFilter');
    const coursesGrid = document.getElementById('coursesGrid');
    const myCoursesGrid = document.getElementById('myCoursesGrid');
    const courseModal = document.getElementById('courseModal');
    const closeModal = document.getElementById('closeModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalContent = document.getElementById('modalContent');

    // Navigation Functions
    function showCatalogue() {
        catalogueView.classList.remove('hidden');
        myCoursesView.classList.add('hidden');
        loadCourses();
    }

    function showMyCourses() {
        catalogueView.classList.add('hidden');
        myCoursesView.classList.remove('hidden');
        loadEnrolledCourses();
    }

    // Event Listeners
    catalogueBtn.addEventListener('click', showCatalogue);
    myCoursesBtn.addEventListener('click', showMyCourses);
    closeModal.addEventListener('click', () => courseModal.classList.add('hidden'));

    // Search and Filter Functions
    function filterCourses() {
        const searchTerm = searchInput.value.toLowerCase();
        const category = categoryFilter.value;
        const level = levelFilter.value;

        return courses.filter(course => {
            const matchesSearch = course.title.toLowerCase().includes(searchTerm) ||
                                course.description.toLowerCase().includes(searchTerm);
            const matchesCategory = !category || course.category === category;
            const matchesLevel = !level || course.level === level;

            return matchesSearch && matchesCategory && matchesLevel;
        });
    }

    // Course Card Creation
    function createCourseCard(course, isEnrolled = false) {
        return `
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <img src="${course.image}" alt="${course.title}" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="font-semibold text-lg mb-2">${course.title}</h3>
                    <p class="text-gray-600 text-sm mb-4">${course.description}</p>
                    <div class="flex items-center mb-4">
                        <p class="text-sm text-gray-600">Par ${course.instructor}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-lg">${course.price}</span>
                        <button onclick="showCourseDetails(${course.id})" 
                                class="px-4 py-2 bg-gradient-to-r from-red-600 to-orange-500 text-white rounded-lg hover:opacity-90">
                            ${isEnrolled ? 'Continuer' : 'En savoir plus'}
                        </button>
                    </div>
                </div>
            </div>
        `;
    }

    // Course Details Modal
    window.showCourseDetails = (courseId) => {
        const course = courses.find(c => c.id === courseId);
        if (!course) return;

        modalTitle.textContent = course.title;
        modalContent.innerHTML = `
            <div class="space-y-4">
                <img src="${course.image}" alt="${course.title}" class="w-full h-64 object-cover rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600">Par ${course.instructor}</p>
                        <p class="text-sm text-gray-500">${course.duration} • ${course.level}</p>
                    </div>
                    <span class="font-bold text-xl">${course.price}</span>
                </div>
                <p class="text-gray-700">${course.description}</p>
                <div>
                    <h4 class="font-semibold mb-2">Contenu du cours</h4>
                    <ul class="space-y-2">
                        ${course.chapters.map(chapter => `
                            <li class="flex items-center">
                                <i class="fas fa-play-circle mr-2 text-orange-500"></i>
                                ${chapter}
                            </li>
                        `).join('')}
                    </ul>
                </div>
                ${!enrolledCourses.includes(courseId) ? `
                    <button onclick="enrollInCourse(${courseId})" 
                            class="w-full px-6 py-3 bg-gradient-to-r from-red-600 to-orange-500 text-white rounded-lg hover:opacity-90">
                        S'inscrire au cours
                    </button>
                ` : ''}
            </div>
        `;
        courseModal.classList.remove('hidden');
        courseModal.classList.add('flex');
    };

    // Enrollment Function
    window.enrollInCourse = (courseId) => {
        if (!enrolledCourses.includes(courseId)) {
            enrolledCourses.push(courseId);
            alert('Inscription réussie !');
            courseModal.classList.add('hidden');
            loadEnrolledCourses();
        }
    };

    // Load Functions
    function loadCourses() {
        const filteredCourses = filterCourses();
        coursesGrid.innerHTML = filteredCourses.map(course => 
            createCourseCard(course, enrolledCourses.includes(course.id))
        ).join('');
    }

    function loadEnrolledCourses() {
        const enrolled = courses.filter(course => enrolledCourses.includes(course.id));
        myCoursesGrid.innerHTML = enrolled.map(course => 
            createCourseCard(course, true)
        ).join('');
    }

    // Initialize
    loadCourses();

    // Event listeners for search and filters
    searchInput.addEventListener('input', loadCourses);
    categoryFilter.addEventListener('change', loadCourses);
    levelFilter.addEventListener('change', loadCourses);
});