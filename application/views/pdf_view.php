<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data PDF</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f9f9f9;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        /* Header Styles */
        h2 {
            margin-top: 0;
            color: #333;
        }

        /* No Data Styles */
        .text-center {
            text-align: center;
        }

        /* Responsive Design */
        @media print {
            body {
                padding: 0;
            }
            table {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">User  Data Report</h2>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($user_data)) { ?>
                    <?php foreach ($user_data as $row) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row->name); ?></td>
                            <td><?php echo htmlspecialchars($row->email); ?></td>
                            <td>********</td> <!-- Hide password for security -->
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="3" class="text-center">No users found</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>