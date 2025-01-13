document.addEventListener('DOMContentLoaded', () => {
    // DOM Elements
    const validateTeachersBtn = document.getElementById('validateTeachersBtn');
    const manageUsersBtn = document.getElementById('manageUsersBtn');
    const manageContentBtn = document.getElementById('manageContentBtn');
    const statsBtn = document.getElementById('statsBtn');
    const validateTeachersView = document.getElementById('validateTeachersView');
    const manageUsersView = document.getElementById('manageUsersView');
    const manageContentView = document.getElementById('manageContentView');
    const statsView = document.getElementById('statsView');
    const addTagsForm = document.getElementById('addTagsForm');
    const tagsInput = document.getElementById('tagsInput');
    const categoryStats = document.getElementById('categoryStats');
    const topCourse = document.getElementById('topCourse');
    const topTeachers = document.getElementById('topTeachers');

    let courses = [];
    let teachers = [];
    let users = [];

    // Navigation Functions
    function showView(view) {
        validateTeachersView.classList.add('hidden');
        manageUsersView.classList.add('hidden');
        manageContentView.classList.add('hidden');
        statsView.classList.add('hidden');
        view.classList.remove('hidden');
    }

    validateTeachersBtn.addEventListener('click', () => showView(validateTeachersView));
    manageUsersBtn.addEventListener('click', () => showView(manageUsersView));
    manageContentBtn.addEventListener('click', () => showView(manageContentView));
    statsBtn.addEventListener('click', () => showView(statsView));

    // Add Tags Functionality
    addTagsForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const tags = tagsInput.value.split(',').map(tag => tag.trim()).filter(tag => tag !== '');
        if (tags.length > 0) {
            alert(`Tags ajoutés avec succès: ${tags.join(', ')}`);
            tagsInput.value = '';
        } else {
            alert('Veuillez entrer des tags valides.');
        }
    });

    // Update Statistics
    function updateStats() {
        // Update total courses
        const totalCourses = courses.length;
        document.getElementById('totalCourses').textContent = totalCourses;

        // Update category distribution
        const categoryDistribution = {};
        courses.forEach(course => {
            categoryDistribution[course.category] = (categoryDistribution[course.category] || 0) + 1;
        });
        categoryStats.innerHTML = Object.entries(categoryDistribution).map(([category, count]) => {
            return `<p>${category}: ${count} cours</p>`;
        }).join('');

        // Update top course
        const topCourseEntry = courses.reduce((top, course) => {
            return course.students > (top?.students || 0) ? course : top;
        }, null);
        topCourse.textContent = topCourseEntry ? `${topCourseEntry.title} (${topCourseEntry.students} étudiants)` : 'N/A';

        // Update top teachers
        const teacherStats = teachers.map(teacher => {
            const studentCount = courses.filter(course => course.teacherId === teacher.id).reduce((sum, course) => sum + course.students, 0);
            return { ...teacher, studentCount };
        });
        teacherStats.sort((a, b) => b.studentCount - a.studentCount);
        topTeachers.innerHTML = teacherStats.slice(0, 3).map(teacher => {
            return `<li>${teacher.name} (${teacher.studentCount} étudiants)</li>`;
        }).join('');
    }

    // Initialize Views
    updateStats();
});
