
<script src="script.js"></script>
 <script>
    // Function to handle clicks on navigation links
function handleNavigationClick(event) {
    event.preventDefault();
    const linkId = event.target.id;

    // Define the mapping of link IDs to page URLs
    const pageMappings = {
        registerInstructor: 'REGISTER-I.php',
        registerStudent: 'REGISTER-S.php',
        createCourses: 'create_courses.php',
        assignMaterial: 'ASSIGN-C.php',
        createDepartments: 'create_departments.php',
        createPrograms: 'create_programs.php',
        studentlist: 'studentlist.php',

        logout: 'logout.html'
    };

    // Check if the linkId has a corresponding page URL
    if (pageMappings.hasOwnProperty(linkId)) {
        // Redirect to the corresponding page
        window.location.href = pageMappings[linkId];
    } else {
        console.log(`No mapping found for linkId: ${linkId}`);
    }
}

// Attach click event handlers to navigation links
const navigationLinks = document.querySelectorAll('.sidebar-submenu a');
navigationLinks.forEach(link => {
    link.addEventListener('click', handleNavigationClick);
});

</script>

<script>
    // Function to show the success message
    function showSuccessMessage() {
        const successMessage = document.getElementById("success-message");
        successMessage.style.display = "block"; // Display the message
        setTimeout(function () {
            successMessage.style.display = "none"; // Hide the message after 3 seconds
        }, 3000);
    }

    // Check if a success message should be displayed (e.g., after creating a user)
    <?php if (isset($_SESSION['success_message'])): ?>
        showSuccessMessage();
        <?php unset($_SESSION['success_message']); // Clear the message after displaying ?>
    <?php endif; ?>
</script>
