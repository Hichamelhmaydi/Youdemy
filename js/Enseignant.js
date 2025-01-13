document.addEventListener('DOMContentLoaded', () => {
    // DOM Elements
    const addCourseBtn = document.getElementById('addCourseBtn');
    const manageCoursesBtn = document.getElementById('manageCoursesBtn');
    const statsBtn = document.getElementById('statsBtn');
    const addCourseView = document.getElementById('addCourseView');
    const manageCoursesView = document.getElementById('manageCoursesView');
    const statsView = document.getElementById('statsView');
    const addCourseForm = document.getElementById('addCourseForm');
    const coursesList = document.getElementById('coursesList');
    const totalCourses = document.getElementById('totalCourses');
    const totalStudents = document.getElementById('totalStudents');

    let courses = [];

    // Navigation Functions
    function showView(view) {
        addCourseView.classList.add('hidden');
        manageCoursesView.classList.add('hidden');
        statsView.classList.add('hidden');
        view.classList.remove('hidden');
    }

    addCourseBtn.addEventListener('click', () => showView(addCourseView));
    manageCoursesBtn.addEventListener('click', () => showView(manageCoursesView));
    statsBtn.addEventListener('click', () => showView(statsView));

    // Add Course Function
    addCourseForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const title = document.getElementById('courseTitle').value;
        const description = document.getElementById('courseDescription').value;
        const content = document.getElementById('courseContent').value;
        const tags = document.getElementById('courseTags').value;
        const category = document.getElementById('courseCategory').value;

        if (title && description && content && category) {
            const newCourse = {
                id: Date.now(),
                title,
                description,
                content,
                tags,
                category,
                students: 0
            };
            courses.push(newCourse);
            addCourseForm.reset();
            alert('Cours ajouté avec succès !');
            updateCoursesList();
            updateStats();
        } else {
            alert('Veuillez remplir tous les champs obligatoires.');
        }
    });

    // Update Courses List
    function updateCoursesList() {
        coursesList.innerHTML = '';
        courses.forEach(course => {
            const courseItem = document.createElement('div');
            courseItem.classList.add('bg-white', 'rounded-lg', 'p-4', 'shadow-sm');
            courseItem.innerHTML = `
                <h4 class="font-bold text-lg">${course.title}</h4>
                <p class="text-sm text-gray-600">${course.description}</p>
                <p class="text-sm text-gray-500 mt-2">Catégorie: ${course.category}</p>
                <p class="text-sm text-gray-500">Étudiants inscrits: ${course.students}</p>
                <div class="flex space-x-2 mt-4">
                    <button class="px-4 py-2 bg-blue-500 text-white rounded-lg" onclick="editCourse(${course.id})">Modifier</button>
                    <button class="px-4 py-2 bg-red-500 text-white rounded-lg" onclick="deleteCourse(${course.id})">Supprimer</button>
                </div>
            `;
            coursesList.appendChild(courseItem);
        });
    }

    // Update Stats
    function updateStats() {
        totalCourses.textContent = courses.length;
        totalStudents.textContent = courses.reduce((sum, course) => sum + course.students, 0);
    }

    // Edit Course
    window.editCourse = (id) => {
        const course = courses.find(c => c.id === id);
        if (course) {
            document.getElementById('courseTitle').value = course.title;
            document.getElementById('courseDescription').value = course.description;
            document.getElementById('courseContent').value = course.content;
            document.getElementById('courseTags').value = course.tags;
            document.getElementById('courseCategory').value = course.category;
            courses = courses.filter(c => c.id !== id);
            showView(addCourseView);
        }
    };

    // Delete Course
    window.deleteCourse = (id) => {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')) {
            courses = courses.filter(course => course.id !== id);
            updateCoursesList();
            updateStats();
        }
    };

    // Initialize
    updateStats();
});
