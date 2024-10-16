<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px;
            border-bottom: none;
        }
        .card-body {
            padding: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0069d9;
        }
    </style>
</head>
<body>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Login</h1>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?php echo base_url('user/login'); ?>">
                            <p style="color: darkgreen;"><?php echo isset($message) ? $message : ''; ?></p>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" placeholder="someone@gmail.com" name="email" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" placeholder="xxxxxxxx" name="password" id="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                            
                        </form>
                    </div>
                    <div class="card-footer">
                    <a href="<?php echo base_url('user/facebook_login'); ?>" class="btn btn-primary btn-block">Login with Facebook</a>
                    <a href="<?php echo base_url('user/google_login'); ?>" class="btn btn-primary btn-block">Login with google</a>
                        <p class="text-center">Don't have an account? <a href="<?php echo base_url('user/register'); ?>">Sign up here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>                                                                                                                                                                                                                                    