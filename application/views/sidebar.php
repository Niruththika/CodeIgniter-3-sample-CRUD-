<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
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

        /* Shift the content when the sidebar is shown */
        .shift {
            margin-left: 250px; /* Adjust based on sidebar width */
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <button class="sidebar-toggle" onclick="toggleSidebar()">&#9776;</button>
        <ul>
            <li><a href="<?php echo base_url('user/update_profile'); ?>">Edit Profile</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="account.php">Account</a></li>
            <li><a href="notifications.php">Notifications</a></li>
            <li><a href="contact_us.php">Contact Us</a></li>
            <li><a href="help.php">Help</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <script>
        function toggleSidebar() {
            var sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('show');
            
            var body = document.querySelector('body');
            body.classList.toggle('shift');
        }
    </script>
</body>
</html>
