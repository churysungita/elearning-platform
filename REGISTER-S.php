<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: LOGIN.php");
    exit();
}

include("CONN.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    // Hash the password
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $program_id = $_POST['program_id'];
    $year_of_study = $_POST['year_of_study'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $registration_no = $_POST['registration_no'];

    // Use prepared statement to insert data
    $sql = "INSERT INTO students (username, first_name, last_name, password, email, program_id, year_of_study, age, gender, registration_no) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssiisss", $username, $first_name, $last_name, $password, $email, $program_id, $year_of_study, $age, $gender, $registration_no);
    
    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success_message'] = "Student registered successfully!";
    } else {
        $_SESSION['error_message'] = "Error creating student: " . mysqli_error($conn);
    }

    // Redirect to the admin dashboard after creating the student
    header("Location: studentlist.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        /* styles.css */
        @keyframes swing {
  0% {
    transform: rotate(0deg);
  }
  10% {
    transform: rotate(10deg);
  }
  30% {
    transform: rotate(0deg);
  }
  40% {
    transform: rotate(-10deg);
  }
  50% {
    transform: rotate(0deg);
  }
  60% {
    transform: rotate(5deg);
  }
  70% {
    transform: rotate(0deg);
  }
  80% {
    transform: rotate(-5deg);
  }
  100% {
    transform: rotate(0deg);
  }
}

@keyframes sonar {
  0% {
    transform: scale(0.9);
    opacity: 1;
  }
  100% {
    transform: scale(2);
    opacity: 0;
  }
}
body {
  font-size: 0.9rem;
}
.page-wrapper .sidebar-wrapper,
.sidebar-wrapper .sidebar-brand > a,
.sidebar-wrapper .sidebar-dropdown > a:after,
.sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a:before,
.sidebar-wrapper ul li a i,
.page-wrapper .page-content,
.sidebar-wrapper .sidebar-search input.search-menu,
.sidebar-wrapper .sidebar-search .input-group-text,
.sidebar-wrapper .sidebar-menu ul li a,
#show-sidebar,
#close-sidebar {
  -webkit-transition: all 0.3s ease;
  -moz-transition: all 0.3s ease;
  -ms-transition: all 0.3s ease;
  -o-transition: all 0.3s ease;
  transition: all 0.3s ease;
}

/*----------------page-wrapper----------------*/

.page-wrapper {
  height: 100vh;
}

.page-wrapper .theme {
  width: 40px;
  height: 40px;
  display: inline-block;
  border-radius: 4px;
  margin: 2px;
}

.page-wrapper .theme.chiller-theme {
  background: #1e2229;
}

/*----------------toggeled sidebar----------------*/

.page-wrapper.toggled .sidebar-wrapper {
  left: 0px;
}

@media screen and (min-width: 768px) {
  .page-wrapper.toggled .page-content {
    padding-left: 300px;
  }
}
/*----------------show sidebar button----------------*/
#show-sidebar {
  position: fixed;
  left: 0;
  top: 10px;
  border-radius: 0 4px 4px 0px;
  width: 35px;
  transition-delay: 0.3s;
}
.page-wrapper.toggled #show-sidebar {
  left: -40px;
}
/*----------------sidebar-wrapper----------------*/

.sidebar-wrapper {
  width: 260px;
  height: 100%;
  max-height: 100%;
  position: fixed;
  top: 0;
  left: -300px;
  z-index: 999;
}

.sidebar-wrapper ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.sidebar-wrapper a {
  text-decoration: none;
}

/*----------------sidebar-content----------------*/

.sidebar-content {
  max-height: calc(100% - 30px);
  height: calc(100% - 30px);
  overflow-y: auto;
  position: relative;
}

.sidebar-content.desktop {
  overflow-y: hidden;
}

/*--------------------sidebar-brand----------------------*/

.sidebar-wrapper .sidebar-brand {
  padding: 10px 20px;
  display: flex;
  align-items: center;
}

.sidebar-wrapper .sidebar-brand > a {
  text-transform: uppercase;
  font-weight: bold;
  flex-grow: 1;
}

.sidebar-wrapper .sidebar-brand #close-sidebar {
  cursor: pointer;
  font-size: 20px;
}
/*--------------------sidebar-header----------------------*/

.sidebar-wrapper .sidebar-header {
  padding: 20px;
  overflow: hidden;
}

.sidebar-wrapper .sidebar-header .user-pic {
  float: left;
  width: 60px;
  padding: 2px;
  border-radius: 12px;
  margin-right: 15px;
  overflow: hidden;
}

.sidebar-wrapper .sidebar-header .user-pic img {
  object-fit: cover;
  height: 100%;
  width: 100%;
}

.sidebar-wrapper .sidebar-header .user-info {
  float: left;
}

.sidebar-wrapper .sidebar-header .user-info > span {
  display: block;
}

.sidebar-wrapper .sidebar-header .user-info .user-role {
  font-size: 12px;
}

.sidebar-wrapper .sidebar-header .user-info .user-status {
  font-size: 11px;
  margin-top: 4px;
}

.sidebar-wrapper .sidebar-header .user-info .user-status i {
  font-size: 8px;
  margin-right: 4px;
  color: #5cb85c;
}

/*-----------------------sidebar-search------------------------*/

.sidebar-wrapper .sidebar-search > div {
  padding: 10px 20px;
}

/*----------------------sidebar-menu-------------------------*/

.sidebar-wrapper .sidebar-menu {
  padding-bottom: 10px;
}

.sidebar-wrapper .sidebar-menu .header-menu span {
  font-weight: bold;
  font-size: 14px;
  padding: 15px 20px 5px 20px;
  display: inline-block;
}

.sidebar-wrapper .sidebar-menu ul li a {
  display: inline-block;
  width: 100%;
  text-decoration: none;
  position: relative;
  padding: 8px 30px 8px 20px;
}

.sidebar-wrapper .sidebar-menu ul li a i {
  margin-right: 10px;
  font-size: 12px;
  width: 30px;
  height: 30px;
  line-height: 30px;
  text-align: center;
  border-radius: 4px;
}

.sidebar-wrapper .sidebar-menu ul li a:hover > i::before {
  display: inline-block;
  animation: swing ease-in-out 0.5s 1 alternate;
}

.sidebar-wrapper .sidebar-menu .sidebar-dropdown > a:after {
  font-family: "Font Awesome 5 Free";
  font-weight: 900;
  content: "\f105";
  font-style: normal;
  display: inline-block;
  font-style: normal;
  font-variant: normal;
  text-rendering: auto;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  background: 0 0;
  position: absolute;
  right: 15px;
  top: 14px;
}

.sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu ul {
  padding: 5px 0;
}

.sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li {
  padding-left: 25px;
  font-size: 13px;
}

.sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a:before {
  content: "\f111";
  font-family: "Font Awesome 5 Free";
  font-weight: 400;
  font-style: normal;
  display: inline-block;
  text-align: center;
  text-decoration: none;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  margin-right: 10px;
  font-size: 8px;
}

.sidebar-wrapper .sidebar-menu ul li a span.label,
.sidebar-wrapper .sidebar-menu ul li a span.badge {
  float: right;
  margin-top: 8px;
  margin-left: 5px;
}

.sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a .badge,
.sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a .label {
  float: right;
  margin-top: 0px;
}

.sidebar-wrapper .sidebar-menu .sidebar-submenu {
  display: none;
}

.sidebar-wrapper .sidebar-menu .sidebar-dropdown.active > a:after {
  transform: rotate(90deg);
  right: 17px;
}

/*--------------------------side-footer------------------------------*/

.sidebar-footer {
  position: absolute;
  width: 100%;
  bottom: 0;
  display: flex;
}

.sidebar-footer > a {
  flex-grow: 1;
  text-align: center;
  height: 30px;
  line-height: 30px;
  position: relative;
}

.sidebar-footer > a .notification {
  position: absolute;
  top: 0;
}

.badge-sonar {
  display: inline-block;
  background: #980303;
  border-radius: 50%;
  height: 8px;
  width: 8px;
  position: absolute;
  top: 0;
}

.badge-sonar:after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  border: 2px solid #980303;
  opacity: 0;
  border-radius: 50%;
  width: 100%;
  height: 100%;
  animation: sonar 1.5s infinite;
}

/*--------------------------page-content-----------------------------*/

.page-wrapper .page-content {
  display: inline-block;
  width: 100%;
  padding-left: 0px;
  padding-top: 20px;
}

.page-wrapper .page-content > div {
  padding: 20px 40px;
}

.page-wrapper .page-content {
  overflow-x: hidden;
}

/*------scroll bar---------------------*/

::-webkit-scrollbar {
  width: 5px;
  height: 7px;
}
::-webkit-scrollbar-button {
  width: 0px;
  height: 0px;
}
::-webkit-scrollbar-thumb {
  background: #525965;
  border: 0px none #ffffff;
  border-radius: 0px;
}
::-webkit-scrollbar-thumb:hover {
  background: #525965;
}
::-webkit-scrollbar-thumb:active {
  background: #525965;
}
::-webkit-scrollbar-track {
  background: transparent;
  border: 0px none #ffffff;
  border-radius: 50px;
}
::-webkit-scrollbar-track:hover {
  background: transparent;
}
::-webkit-scrollbar-track:active {
  background: transparent;
}
::-webkit-scrollbar-corner {
  background: transparent;
}


/*-----------------------------chiller-theme-------------------------------------------------*/

.chiller-theme .sidebar-wrapper {
    background: #31353D;
}

.chiller-theme .sidebar-wrapper .sidebar-header,
.chiller-theme .sidebar-wrapper .sidebar-search,
.chiller-theme .sidebar-wrapper .sidebar-menu {
    border-top: 1px solid #3a3f48;
}

.chiller-theme .sidebar-wrapper .sidebar-search input.search-menu,
.chiller-theme .sidebar-wrapper .sidebar-search .input-group-text {
    border-color: transparent;
    box-shadow: none;
}

.chiller-theme .sidebar-wrapper .sidebar-header .user-info .user-role,
.chiller-theme .sidebar-wrapper .sidebar-header .user-info .user-status,
.chiller-theme .sidebar-wrapper .sidebar-search input.search-menu,
.chiller-theme .sidebar-wrapper .sidebar-search .input-group-text,
.chiller-theme .sidebar-wrapper .sidebar-brand>a,
.chiller-theme .sidebar-wrapper .sidebar-menu ul li a,
.chiller-theme .sidebar-footer>a {
    color: #818896;
}

.chiller-theme .sidebar-wrapper .sidebar-menu ul li:hover>a,
.chiller-theme .sidebar-wrapper .sidebar-menu .sidebar-dropdown.active>a,
.chiller-theme .sidebar-wrapper .sidebar-header .user-info,
.chiller-theme .sidebar-wrapper .sidebar-brand>a:hover,
.chiller-theme .sidebar-footer>a:hover i {
    color: #b8bfce;
}

.page-wrapper.chiller-theme.toggled #close-sidebar {
    color: #bdbdbd;
}

.page-wrapper.chiller-theme.toggled #close-sidebar:hover {
    color: #ffffff;
}

.chiller-theme .sidebar-wrapper ul li:hover a i,
.chiller-theme .sidebar-wrapper .sidebar-dropdown .sidebar-submenu li a:hover:before,
.chiller-theme .sidebar-wrapper .sidebar-search input.search-menu:focus+span,
.chiller-theme .sidebar-wrapper .sidebar-menu .sidebar-dropdown.active a i {
    color: #16c7ff;
    text-shadow:0px 0px 10px rgba(22, 199, 255, 0.5);
}

.chiller-theme .sidebar-wrapper .sidebar-menu ul li a i,
.chiller-theme .sidebar-wrapper .sidebar-menu .sidebar-dropdown div,
.chiller-theme .sidebar-wrapper .sidebar-search input.search-menu,
.chiller-theme .sidebar-wrapper .sidebar-search .input-group-text {
    background: #3a3f48;
}

.chiller-theme .sidebar-wrapper .sidebar-menu .header-menu span {
    color: #6c7b88;
}

.chiller-theme .sidebar-footer {
    background: #3a3f48;
    box-shadow: 0px -1px 5px #282c33;
    border-top: 1px solid #464a52;
}

.chiller-theme .sidebar-footer>a:first-child {
    border-left: none;
}

.chiller-theme .sidebar-footer>a:last-child {
    border-right: none;
}

/* Additional styling can be applied to content as needed */



/* -------------new dashbaoard----------------------- */
</style>
</head>

<body>
<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="#">pro sidebar</a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <div class="sidebar-header">
        <div class="user-pic">
          <img class="img-responsive img-rounded" src="./images/user.png"
            alt="User picture">
        </div>
        <div class="user-info">
          <span class="user-name">Admin
            <strong>Admin</strong>
          </span>
          <span class="user-role">Administrator</span>
          <span class="user-status">
            <i class="fa fa-circle"></i>
            <span>Online</span>
          </span>
        </div>
      </div>
     
      <!-- sidebar-search  -->
      <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <span>General</span>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
        
              <i class="fa fa-users" aria-hidden="true"></i>
              <span>Departments</span>
             
            </a>
            <div class="sidebar-submenu">
              <ul>
              <li><a href="#" id="createDepartments">CREATE DEPARTMENTS</a></li>
    
              </ul>
            </div>
          </li>



          <li class="sidebar-dropdown">
            <a href="#">
            <i class="fa fa-user" aria-hidden="true"></i>
              <span>Instructors</span>
          
            </a>
            <div class="sidebar-submenu">
              <ul>
              <li><a href="#" id="registerInstructor">REGISTER INSTRUCTOR</a></li>
              
             
              </ul>
            </div>
          
          </li>
        
          <li class="sidebar-dropdown">
            <a href="#">
            <i class="fa fa-book" aria-hidden="true"></i>
              
              <span>Courses</span>
              <span class="badge badge-pill badge-danger">3</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
             
              <li><a href="#" id="createCourses">CREATE COURSES</a></li>
            <li><a href="#" id="assignMaterial">ASSIGN COURSE</a></li>
              
             
              </ul>
            </div>
          
          </li>

          <li class="sidebar-dropdown">
            <a href="#">
            <i class="fa fa-user" aria-hidden="true"></i>
              <span>Students</span>
              <span class="badge badge-pill badge-danger">3</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
              <li><a href="#" id="registerStudent">REGISTER STUDENT</a></li>              
             
              </ul>
            </div>
          
          </li>
          
          
          <li class="sidebar-dropdown">
            <a href="#">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              <span>Programs</span>
              <span class="badge badge-pill badge-danger">3</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
              <li><a href="#" id="createPrograms">CREATE PROGRAMS</a></li>
              
             
              </ul>
            </div>
          
          </li>
        
        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    <div class="sidebar-footer">
      <a href="#">
        <i class="fa fa-bell"></i>
        <span class="badge badge-pill badge-warning notification">3</span>
      </a>
      <a href="#">
        <i class="fa fa-envelope"></i>
        <span class="badge badge-pill badge-success notification">7</span>
      </a>
      <a href="#">
        <i class="fa fa-cog"></i>
        <span class="badge-sonar"></span>
      </a>
      <a href="logout.php">
        <i class="fa fa-power-off"></i>
      </a>
    </div>
  </nav>
  <!-- sidebar-wrapper  -->
  <main class="page-content">
    <div class="container">
      <h2>Students</h2>
      <hr>
      <div class="row">
      <div class="container">
        <form id="register-student-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required>
            </div>

            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
            </div>

            <div class="form-group">
                <label for="program_id">Program:</label>
                <select class="form-control" id="program_id" name="program_id" required>
                    <option value="" disabled selected>Select Program</option>
                    <!-- Add options for programs here -->
                    <?php
                    // Fetch program options from your database and populate the dropdown
                    $program_options = "SELECT program_id, program_name FROM programs";
                    $result = mysqli_query($conn, $program_options);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['program_id'] . "'>" . $row['program_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="year_of_study">Year of Study:</label>
                <input type="text" class="form-control" id="year_of_study" name="year_of_study" placeholder="Enter Year of Study" required>
            </div>

            <div class="form-group">
                <label for="age">Age:</label>
                <input type="text" class="form-control" id="age" name="age" placeholder="Enter Age" required>
            </div>

            <div class="form-group">
                <fieldset>
                    <legend>Select Gender:</legend>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="male" name="gender" value="Male" required>
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="female" name="gender" value="Female" required>
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                </fieldset>
            </div>

            <div class="form-group">
                <label for="registration_no">Registration No:</label>
                <input type="text" class="form-control" id="registration_no" name="registration_no" placeholder="Enter Registration No" required>
            </div>

            <button type="submit" class="btn btn-primary">Register Student</button>
        </form>
    <!-- Add a logout link -->
    <div class="mt-3 text-right">
        <a href="HAD.php" class="btn btn-danger">Back to Dashboard</a>
    </div>
</div>

</div>
      
  
    

     
    </div>

  </main>
  <!-- page-content" -->
</div>

<script>
$(".sidebar-dropdown > a").click(function() {
  $(".sidebar-submenu").slideUp(200);
  if (
    $(this)
      .parent()
      .hasClass("active")
  ) {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .parent()
      .removeClass("active");
  } else {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .next(".sidebar-submenu")
      .slideDown(200);
    $(this)
      .parent()
      .addClass("active");
  }
});

$("#close-sidebar").click(function() {
  $(".page-wrapper").removeClass("toggled");
});
$("#show-sidebar").click(function() {
  $(".page-wrapper").addClass("toggled");
});


</script>








</body>
</html>




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
