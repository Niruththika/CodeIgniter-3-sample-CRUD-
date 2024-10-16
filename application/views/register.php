<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f5f5f5;
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
                        <h1 class="text-center">Register</h1>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?php echo base_url('user/register'); ?>">
                            <p class="text-muted">
                                <div class="alert alert-<?php echo ($message == 'Registered successfully') ? 'success' : ''; ?> alert-dismissible fade show" role="alert">
                                    <?php echo $message; ?>
                                    <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button> -->
                                </div>
                            </p>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" placeholder="Name" name="name" id="name" required>
                                <?php echo form_error('name'); ?>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" placeholder="someone@gmail.com" name="email" id="email" required>
                               <span style="color:red;"> <?php echo form_error('email'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" placeholder="xxxxxxxx" name="password" id="password" required>
                                <span style="color:red;"><?php echo form_error('password'); ?></span>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <p class="text-center">Already have an Account? <a href="<?php echo base_url('user/login'); ?>">Sign-in</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>