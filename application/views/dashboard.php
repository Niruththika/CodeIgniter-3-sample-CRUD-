<?php include 'header.php'; ?>
<!-- <?php include 'sidebar.php'; ?> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .dashboard {
            margin-left: 250px; /* Adjust to align with sidebar width */
            padding-top: 70px; /* Adjust to align with header height */
        }
        .input-group .input-group-append .input-group-text {
            border: 1px solid #ced4da;
            border-left: none;
            background-color: #ffffff;
        }
        .form-control {
            border-right: 0;
        }
        .input-group .form-control {
            border-radius: 0.25rem 0 0 0.25rem;
        }
        .input-group-append {
            margin-left: -1px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="dashboard">
            <h1 class="text-center mb-4">User Management</h1>
            <h3 class="text-center mb-3">Personal Details</h3>

            <!-- ERROR MESSAGE DISPLAY -->
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $this->session->flashdata('success'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $this->session->flashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <!-- SEARCH FORM -->
            <form action="javascript:void(0);" method="get" class="form-inline justify-content-center mb-3">
                <div class="input-group">
                    <input type="text" name="search_name" id="search_name" class="form-control" placeholder="Search by name">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>

            <!-- BUTTON TO INSERT USER -->
            <div class="text-right mb-3">
                <a href="#" class="btn btn-primary btn-sm" onclick="showInsertModal()">Insert User</a>
            </div>

            <!-- USER TABLE -->
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="user-table-body">
                    <?php if (!empty($user_data)) { ?>
                        <?php foreach ($user_data as $row) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row->name); ?></td>
                                <td><?php echo htmlspecialchars($row->email); ?></td>
                                <td>********</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm" onclick="showUpdateModal('<?php echo htmlspecialchars($row->name); ?>', '<?php echo htmlspecialchars($row->email); ?>')">Update</a>
                                    <a href="<?php echo base_url('user/delete/' . urlencode($row->email)); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="4" class="text-center">No users found</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="text-right mb-3">
    <a href="<?php echo base_url('user/generate_pdf'); ?>" class="btn btn-primary btn-sm">Generate PDF</a>
</div>



        <!-- INSERT MODAL -->
        <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="insertModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="insertModalLabel">Insert New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="<?php echo base_url('user/manage_user'); ?>" method="post">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="insert-name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="insert-email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="insert-password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Insert</button>
                            <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- UPDATE MODAL -->
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update User Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url('user/manage_user'); ?>" method="post">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="update-name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="update-email" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="old_password">Old Password:</label>
                                <input type="password" name="old_password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password:</label>
                                <input type="password" name="new_password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password:</label>
                                <input type="password" name="confirm_password" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                            <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cancel</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVA SCRIPT FUNCTION FOR FORM POP-UP -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        function showInsertModal() {
            $('#insertModal').modal('show');
        }

        function showUpdateModal(name, email) {
            $('#update-name').val(name);
            $('#update-email').val(email);
            $('#updateModal').modal('show');
        }

        $(document).ready(function() {
            $('#search_name').on('input', function() {
                var searchValue = $(this).val();

                $.ajax({
                    url: "<?php echo base_url('user/search_user'); ?>",
                    method: "GET",
                    data: { search_name: searchValue },
                    success: function(response) {
                        $('#user-table-body').html(response);
                    }
                });
            });
        });
    </script>

</body>
</html>

<?php include "footer.php"; ?>
