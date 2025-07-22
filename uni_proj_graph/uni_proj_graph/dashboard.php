<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title>Dashboard - Student Project Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="stylesheet" href="css/style.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="wrapper-frame">
    <header id="header" class="wrapper-row">
        <div class="container">
            <div class="wrapper">
                <div id="logo">
                    <h1><a href="index.php"><img src="images/logo.png" alt="Student Project"></a></h1>
                </div>
                <nav id="menu">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li class="current_page_item"><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="#" id="logoutBtn2" style="background-color: #2BA8BD; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none;">Logout</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <div class="wrapper-row" style="min-height: 60vh; padding: 2em 0;">
        <section class="container">
            <div style="background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 2em; margin-bottom: 2em;">
                <h2 style="color:#2BA8BD; margin-bottom: 1em;">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>
                
                <!-- Role Badge -->
                <div style="margin-bottom: 1em;">
                    <?php if ($_SESSION['user_role'] == 'admin'): ?>
                        <span style="background-color: #dc3545; color: white; padding: 8px 15px; border-radius: 20px; font-size: 0.9em; font-weight: bold;">ADMIN ROLE</span>
                    <?php else: ?>
                        <span style="background-color: #28a745; color: white; padding: 8px 15px; border-radius: 20px; font-size: 0.9em; font-weight: bold;">USER ROLE</span>
                    <?php endif; ?>
                </div>
                
                <p style="color:#666; margin-bottom: 1em;">You are successfully logged in to your account.</p>
                <div style="background: #f8f9fa; padding: 1em; border-radius: 4px; margin-bottom: 1em;">
                    <strong>User Information:</strong><br>
                    <strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['user_name']); ?><br>
                    <strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['user_email']); ?><br>
                    <strong>User ID:</strong> <?php echo htmlspecialchars($_SESSION['user_id']); ?><br>
                    <strong>Role:</strong> <?php echo ucfirst(htmlspecialchars($_SESSION['user_role'])); ?>
                </div>
                <!-- Dummy Graph Section -->
                <div style="background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 2em; margin-bottom: 2em;">
                    <h3 style="color:#2BA8BD; margin-bottom: 1em;">📊 Sample Graph</h3>
                    <canvas id="myDummyChart" width="400" height="200"></canvas>
                </div>
                <!-- <button id="logoutBtn2" style="background-color:#dc3545; color:white; padding:0.75em 1.5em; border:none; border-radius:5px; font-size:1em; cursor:pointer;">Logout</button> -->
            </div>
            
            <!-- Role-based content -->
            <?php if ($_SESSION['user_role'] == 'admin'): ?>
                <!-- Admin Dashboard Content -->
                <div style="background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 2em; margin-bottom: 2em;">
                    <h3 style="color:#dc3545; margin-bottom: 1em;">🛡️ Admin Dashboard</h3>
                    <p style="color:#666; margin-bottom: 1em;">You have administrative privileges. Here's what you can do:</p>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1em;">
                        <div style="background: #f8f9fa; padding: 1em; border-radius: 4px; border-left: 4px solid #dc3545;">
                            <h4 style="color:#dc3545; margin-bottom: 0.5em;">👥 User Management</h4>
                            <p style="color:#666; font-size: 0.9em;">Manage all user accounts, view user details, and modify permissions.</p>
                        </div>
                        <div style="background: #f8f9fa; padding: 1em; border-radius: 4px; border-left: 4px solid #dc3545;">
                            <h4 style="color:#dc3545; margin-bottom: 0.5em;">📊 System Analytics</h4>
                            <p style="color:#666; font-size: 0.9em;">View system statistics, user activity, and performance metrics.</p>
                        </div>
                        <div style="background: #f8f9fa; padding: 1em; border-radius: 4px; border-left: 4px solid #dc3545;">
                            <h4 style="color:#dc3545; margin-bottom: 0.5em;">⚙️ System Settings</h4>
                            <p style="color:#666; font-size: 0.9em;">Configure system settings, manage database, and control access.</p>
                        </div>
                        <div style="background: #f8f9fa; padding: 1em; border-radius: 4px; border-left: 4px solid #dc3545;">
                            <h4 style="color:#dc3545; margin-bottom: 0.5em;">🔒 Security</h4>
                            <p style="color:#666; font-size: 0.9em;">Monitor security logs, manage access controls, and view audit trails.</p>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- User Dashboard Content -->
                <div style="background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 2em; margin-bottom: 2em;">
                    <h3 style="color:#28a745; margin-bottom: 1em;">👤 User Dashboard</h3>
                    <p style="color:#666; margin-bottom: 1em;">Welcome to your personal dashboard. Here's what you can do:</p>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1em;">
                        <div style="background: #f8f9fa; padding: 1em; border-radius: 4px; border-left: 4px solid #28a745;">
                            <h4 style="color:#28a745; margin-bottom: 0.5em;">📝 My Profile</h4>
                            <p style="color:#666; font-size: 0.9em;">View and edit your personal information and account settings.</p>
                        </div>
                        <div style="background: #f8f9fa; padding: 1em; border-radius: 4px; border-left: 4px solid #28a745;">
                            <h4 style="color:#28a745; margin-bottom: 0.5em;">📚 My Projects</h4>
                            <p style="color:#666; font-size: 0.9em;">Access your projects, assignments, and academic materials.</p>
                        </div>
                        <div style="background: #f8f9fa; padding: 1em; border-radius: 4px; border-left: 4px solid #28a745;">
                            <h4 style="color:#28a745; margin-bottom: 0.5em;">📅 Calendar</h4>
                            <p style="color:#666; font-size: 0.9em;">View your schedule, deadlines, and upcoming events.</p>
                        </div>
                        <div style="background: #f8f9fa; padding: 1em; border-radius: 4px; border-left: 4px solid #28a745;">
                            <h4 style="color:#28a745; margin-bottom: 0.5em;">📈 Progress</h4>
                            <p style="color:#666; font-size: 0.9em;">Track your academic progress and view your grades.</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
          
        </section>
    </div>
    <footer id="footer">
        <div class="bottom">
            <div class="container">
                <div class="col grid3">
                    <h3>About the Project</h3>
                    <p>This project was developed as part of the final year curriculum for Computer Science at University XYZ. Our goal is to improve campus life through technology.</p>
                    <a href="#contact" class="button light">Contact Us</a>
                </div>
                <div class="col grid3">
                    <h3>University Info</h3>
                    <p>
                        <strong>University XYZ</strong><br>
                        123 University Ave, City, Country<br>
                        <strong>Email:</strong> <a href="mailto:info@university.edu">info@university.edu</a><br>
                        <strong>Website:</strong> <a href="#">university.edu</a>
                    </p> 
                </div>
                <div class="col grid3">
                    <h3>Quick Links</h3>
                    <p>
                        <strong><a href="#about">About</a></strong> <br>
                        <strong><a href="#project">Project</a></strong> <br>
                        <strong><a href="#team">Team</a></strong> <br>
                        <strong><a href="#contact">Contact</a></strong> <br>
                    </p>
                </div>
            </div>
            <div class="sep"></div>
            <div class="container">
                <div class="col grid6">
                    <p class="copyright">&copy; 2024 Student Project Portal. Made with <span style="color:red;">&hearts;</span> by University XYZ students.</p>
                </div>
                <div class="col grid6">
                    <p class="right-side">
                        <a href="#" class="button light"><em class="icon-twitter"></em></a>
                        <a href="#" class="button light"><em class="icon-facebook"></em></a>
                        <a href="#logo" id="top-link" class="button light"><em class="icon-arrow-up"></em></a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
</div>

<script>
$(document).ready(function() {
    // Handle logout button clicks
    $('#logoutBtn, #logoutBtn2').on('click', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Logout',
            text: 'Are you sure you want to logout?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2BA8BD',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, Logout',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send logout request
                $.ajax({
                    type: 'POST',
                    url: 'logout.php',
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Logged Out!',
                            text: 'You have been successfully logged out.',
                            confirmButtonColor: '#2BA8BD',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = 'login.php';
                        });
                    },
                    error: function() {
                        // If logout.php doesn't exist, just redirect
                        window.location.href = 'login.php';
                    }
                });
            }
        });
    });

    // Dummy Chart.js graph
    var ctx = document.getElementById('myDummyChart').getContext('2d');
    var myDummyChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: 'Dummy Data',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
</body>
</html> 