
// Sticky Header Effect
window.addEventListener('scroll', () => {
    const header = document.querySelector('.sticky-header');
    header.classList.toggle('scrolled', window.scrollY > 50);
});

// Mobile Menu Toggle
const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
const navLinks = document.querySelector('.nav-links');

mobileMenuBtn.addEventListener('click', () => {
    navLinks.classList.toggle('active');
});

// Form Submission Handler
function handleSubmit(e) {
    e.preventDefault();
    const loading = document.getElementById('loading');
    const resultContainer = document.getElementById('resultContainer');
    
    // Show loading animation
    loading.classList.add('active');
    resultContainer.classList.remove('active');

    // Simulate API call (replace with actual API call)
    setTimeout(() => {
        loading.classList.remove('active');
        resultContainer.classList.add('active');
        
        // Update student info (replace with actual data)
        document.getElementById('studentName').textContent = "John Doe";
        document.getElementById('studentRoll').textContent = document.getElementById('rollNumber').value;
        document.getElementById('studentSemester').textContent = `Semester ${document.getElementById('semester').value}`;
        document.getElementById('studentBranch').textContent = "Computer Science";

        // Update result table (replace with actual data)
        updateResultTable(sampleData);
    }, 2000);
}

// Sample data (replace with actual API response)
const sampleData = [
    { code: 'CS101', name: 'Introduction to Programming', credits: 4, marks: 85, grade: 'A' },
    { code: 'CS102', name: 'Data Structures', credits: 4, marks: 78, grade: 'B' },
    { code: 'CS103', name: 'Database Management', credits: 3, marks: 92, grade: 'A+' },
    { code: 'CS104', name: 'Computer Networks', credits: 3, marks: 75, grade: 'B' },
    { code: 'CS105', name: 'Operating Systems', credits: 4, marks: 88, grade: 'A' }
];

// Update result table
function updateResultTable(data) {
    const tbody = document.getElementById('resultTableBody');
    tbody.innerHTML = '';

    let totalCredits = 0;
    let totalGradePoints = 0;

    data.forEach(subject => {
        const row = document.createElement('tr');
        const gradePoint = getGradePoint(subject.grade);
        
        totalCredits += subject.credits;
        totalGradePoints += (gradePoint * subject.credits);

        row.innerHTML = `
            <td>${subject.code}</td>
            <td>${subject.name}</td>
            <td>${subject.credits}</td>
            <td>${subject.marks}</td>
            <td><span class="grade ${getGradeClass(subject.grade)}">${subject.grade}</span></td>
        `;
        tbody.appendChild(row);
    });

    // Update summary
    const sgpa = (totalGradePoints / totalCredits).toFixed(2);
    document.getElementById('totalCredits').textContent = totalCredits;
    document.getElementById('sgpa').textContent = sgpa;
    document.getElementById('result').textContent = sgpa >= 5.0 ? 'PASS' : 'FAIL';
}

// Helper functions
function getGradePoint(grade) {
    const points = { 'A+': 10, 'A': 9, 'B+': 8, 'B': 7, 'C': 6, 'D': 5, 'F': 0 };
    return points[grade] || 0;
}

function getGradeClass(grade) {
    if (grade === 'A+' || grade === 'A') return 'excellent';
    if (grade === 'B+' || grade === 'B') return 'good';
    if (grade === 'C') return 'average';
    return 'poor';
}
