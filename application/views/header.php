<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header and Sidebar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        /* Header styles */
        .header {
            background-color: #f0f0f0; 
            padding: 24px; 
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            width: 100%;
            transition: margin-left 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .nav {
            display: flex;
            align-items: center;
        }

        .header .nav-item {
            margin-right: 40px;
        }

        .header .login-image { 
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-left: 10px;
        }

        .header .nav-item:last-child {
            margin-left: 0; /* Remove default margin for last item */
        }

        /* Sidebar styles */
        .sidebar {
            background-color: #f0f0f0;
            padding: 10px;
            border: 1px solid #ddd;
            width: 250px; /* Adjust width as needed */
            height: 100vh; /* Full height of the viewport */
            position: fixed; /* Fix the sidebar on the left */
            top: 0;
            left: 0;
            transform: translateX(-250px); /* Hide the sidebar by default */
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .sidebar-toggle {
            position: absolute;
            top: 10px;
            right: -40px; /* Position the button outside the sidebar */
            background-color: #f0f0f0;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .sidebar-toggle:hover {
            background-color: #e0e0e0;
        }

        .sidebar a {
            text-decoration: none;
            color: #337ab7;
            display: block; /* Make links block-level for better spacing */
            padding: 10px; /* Add padding for a better click area */
        }

        .sidebar a:hover {
            color: #23527c;
            background-color: #e0e0e0; /* Add a background color on hover */
            border-radius: 4px; /* Optional: add rounded corners */
        }

        /* Shift the content and header when the sidebar is shown */
        .shift {
            margin-left: 250px; /* Adjust based on sidebar width */
        }

        .shift-header {
            margin-left: 250px; /* Adjust based on sidebar width */
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="nav">
            <a class="nav-link" href="<?php echo base_url('user/home'); ?>">Home</a>
            <a class="nav-link" href="#">Settings</a>
            <li><a href="<?php echo base_url('contact_us'); ?>">Contact Us</a></li> 
            <a href="<?php echo base_url('review/create'); ?>">Reviews</a>



        </div>
        <div class="nav">
            <img src="/codeigniter3/images/login.jpg" alt="Login Image" class="login-image">
            <a href="#" class="logout-link" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
    </header>

    <div class="sidebar">
        <button class="sidebar-toggle" onclick="toggleSidebar()">&#9776;</button>
        <ul>
            <li><a href="<?php echo base_url('user/update_profile'); ?>">Edit Profile</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="account.php">Account</a></li>
            <li><a href="notifications.php">Notifications</a></li>
            <li><a href="help.php">Help</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Logout Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="<?php echo base_url('user/login'); ?>" class="btn btn-primary">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            var sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('show');
            
            var body = document.querySelector('body');
            body.classList.toggle('shift');
            
            var header = document.querySelector('.header');
            header.classList.toggle('shift-header');
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
