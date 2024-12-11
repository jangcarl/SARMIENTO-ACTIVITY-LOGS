<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Applicant</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .container {
            border: 2px solid #0077B6;
            border-radius: 15px;
            background-color: #CAF0F8;
            width: 88%;
            margin: 20px;
            padding: 20px;
            text-align: left;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .container .indent {
            font-weight: bold;
            width: 50%;
            display: inline-block;
        }

        .container table {
            width: 100%;
        }

        .container th, td {
            border: none;
            width: 50%;
            font-size: 18px;
            font-weight: bold;
            border-collapse: collapse;
            padding: 10px;
        }

        .container th {
            background-color: #0077B6;
            color: white;
        }

        .container td {
            border-bottom: 1px solid #0077B6;
        }

        a.button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0077B6;
            color: white;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        a.button:hover {
            background-color: #0096C7;
            transform: scale(1.05);
        }

        a.button:active {
            background-color: #005F73;
            transform: scale(0.98);
        }
    </style>
</head>

<body>
    <div class="outerMain">
        <div class="main">
            <div><a href="index.php" class="button">Back</a></div>
            <div class="innerMain">
                <h1>Are you sure you want to delete this applicant?</h1>

                <?php $getUserByID = getUserByID($pdo, $_GET['applicant_id']); ?>
                <div class="container">
                    <table>
                        <tr>
                            <th>First Name</th>
                            <td><?php echo $getUserByID['first_name']; ?></td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td><?php echo $getUserByID['last_name']; ?></td>
                        </tr>
                        <tr>
                            <th>Date Added</th>
                            <td><?php echo $getUserByID['date_added']; ?></td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td><?php echo $getUserByID['phone_number']; ?></td>
                        </tr>
                        <tr>
                            <th>Years Experience</th>
                            <td><?php echo $getUserByID['years_experience']; ?></td>
                        </tr>
                        <tr>
                            <th>Medical License</th>
                            <td><?php echo $getUserByID['medical_license']; ?></td>
                        </tr>
                        <tr>
                            <th>Certifications</th>
                            <td><?php echo $getUserByID['certifications']; ?></td>
                        </tr>
                        <tr>
                            <th>Education</th>
                            <td><?php echo $getUserByID['education']; ?></td>
                        </tr>
                        <tr>
                            <th>Desired Salary</th>
                            <td><?php echo $getUserByID['desired_salary']; ?></td>
                        </tr>
                    </table>
                </div>
                <div>
                    <form action="core/handleForms.php?applicant_id=<?php echo $_GET['applicant_id']; ?>" method="POST">
                        <input type="submit" name="deleteUserBtn" value="Delete" class="submit-button">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
