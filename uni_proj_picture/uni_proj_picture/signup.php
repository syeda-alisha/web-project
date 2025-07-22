<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title>Signup - Student Project Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="stylesheet" href="css/style.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="wrapper-frame">
    <header id="header" class="wrapper-row">
        <div class="container">
            <div class="wrapper">
                <div id="logo">
                    <h1><a href="index.html"><img src="images/logo.png" alt="Student Project"></a></h1>
                </div>
                <nav id="menu">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li class="current_page_item"><a href="signup.php">Signup</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <div class="wrapper-row" style="min-height: 60vh; display: flex; align-items: center; justify-content: center;">
        <section class="container" style="max-width: 400px; width: 100%; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 2em;">
            <h2 style="text-align:center; color:#2BA8BD; margin-bottom: 1em;">Create Your Account</h2>
            <form id="signupForm" enctype="multipart/form-data">
                <div style="margin-bottom: 1.5em;">
                    <label for="name" style="display:block; margin-bottom:0.5em; color:#333;">Name</label>
                    <input type="text" id="name" name="name" required style="width:100%; padding:0.75em; border:1px solid #ccc; border-radius:4px;">
                </div>
                <div style="margin-bottom: 1.5em;">
                    <label for="email" style="display:block; margin-bottom:0.5em; color:#333;">Email</label>
                    <input type="email" id="email" name="email" required style="width:100%; padding:0.75em; border:1px solid #ccc; border-radius:4px;">
                </div>
                <div style="margin-bottom: 2em;">
                    <label for="password" style="display:block; margin-bottom:0.5em; color:#333;">Password</label>
                    <input type="password" id="password" name="password" required style="width:100%; padding:0.75em; border:1px solid #ccc; border-radius:4px;">
                </div>
                <div style="margin-bottom: 2em;">
                    <label for="picture" style="display:block; margin-bottom:0.5em; color:#333;">Profile Picture</label>
                    <input type="file" id="picture" name="picture" accept="image/*" style="width:100%; padding:0.75em; border:1px solid #ccc; border-radius:4px;">
                </div>
                <button type="submit" style="width:100%; background-color:#2BA8BD; color:white; padding:0.75em; border:none; border-radius:5px; font-size:1em; cursor:pointer;">Signup</button>
            </form>
            <p style="text-align:center; margin-top:1.5em;">Already have an account? <a href="login.php" style="color:#2BA8BD; text-decoration:underline;">Login here</a>.</p>
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
    console.log('jQuery loaded and document ready');
    
    $('#signupForm').on('submit', function(e) {
        console.log('Form submitted');
        e.preventDefault();
        
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        
        console.log('Form data:', {name: name, email: email, password: password});
        
        // Basic validation
        if (!name || !email || !password) {
            console.log('Validation failed - empty fields');
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'All fields are required!',
                confirmButtonColor: '#2BA8BD'
            });
            return false;
        }
        
        // Email validation
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            console.log('Validation failed - invalid email');
            Swal.fire({
                icon: 'error',
                title: 'Invalid Email',
                text: 'Please enter a valid email address!',
                confirmButtonColor: '#2BA8BD'
            });
            return false;
        }
        
        console.log('Validation passed, showing loading...');
        
        // Show loading
        Swal.fire({
            title: 'Creating Account...',
            text: 'Please wait while we create your account.',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });
        
        console.log('Sending AJAX request...');
        
        // Submit form via AJAX
        var form = $('#signupForm')[0];
        var formData = new FormData(form);

        $.ajax({
            type: 'POST',
            url: 'signup_process.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log('AJAX response:', response);
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registration Successful!',
                        text: 'Your account has been created successfully. Please login.',
                        confirmButtonColor: '#2BA8BD'
                    }).then((result) => {
                        window.location.href = 'login.php';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Registration Failed',
                        text: response.message || 'Something went wrong. Please try again.',
                        confirmButtonColor: '#2BA8BD'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Connection Error',
                    text: 'Unable to connect to server. Please try again.',
                    confirmButtonColor: '#2BA8BD'
                });
            }
        });
    });
});
</script>
</body>
</html> 