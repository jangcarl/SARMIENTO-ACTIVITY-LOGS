<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Applicant</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        input[type="number"], input[type="date"], input[type="text"] {
            background-color: #F9FAFB;
            color: #0077B6;
            border: 1px solid #B0BEC5;
            padding: 10px 15px;
            border-radius: 4px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            width: 100%;
            box-sizing: border-box;
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

        .main>*:first-child {
            background-color: red;
            margin-right: 100000000000px;
        }

        .container {
            border: 2px solid #0077B6;
            border-radius: 15px;
            background-color: #CAF0F8;
            margin: 20px;
            padding: 20px;
            text-align: left;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
    </style>
</head>

<body>
    <div class="outerMain">
        <div class="main" style="padding: 30px;">
            <div><a href="index.php" class="button">Cancel</a></div>

            <div class="innerMain">
                <?php $getUserByID = getUserByID($pdo, $_GET['applicant_id']); ?>
                <h1>Edit applicant's information (<?php echo $getUserByID['last_name'] ?>) </h1>
            </div>

            <div class="mainForm">
                <form action="core/handleForms.php?applicant_id=<?php echo $_GET['applicant_id']; ?>" method="POST">
                    <p>
                        <label for="firstName">First Name</label>
                        <input type="text" name="first_name" value="<?php echo $getUserByID['first_name']; ?>" required>
                    </p>
                    <p>
                        <label for="lastName">Last Name</label>
                        <input type="text" name="last_name" value="<?php echo $getUserByID['last_name']; ?>" required>
                    </p>
                    <p>
                        <label for="dateAdded">Date Added</label>
                        <input type="date" name="date_added" value="<?php echo $getUserByID['date_added']; ?>" required>
                    </p>
                    <p>
                        <label for="phoneNumber">Phone Number</label>
                        <input type="text" name="phone_number" value="<?php echo $getUserByID['phone_number']; ?>" required>
                    </p>
                    <p>
                        <label for="yearsExperience">Years Experience</label>
                        <input type="number" name="years_experience" value="<?php echo $getUserByID['years_experience']; ?>" min="1" max="99" required>
                    </p>
                    <p>
                        <label for="medicalLicense">Medical License</label>
                        <input type="text" name="medical_license" value="<?php echo $getUserByID['medical_license']; ?>" required>
                    </p>
                    <p>
                        <label for="certifications">Certifications</label>
                        <input type="text" name="certifications" value="<?php echo $getUserByID['certifications']; ?>" required>
                    </p>
                    <p>
                        <label for="education">Education</label>
                        <input type="text" name="education" value="<?php echo $getUserByID['education']; ?>" required>
                    </p>
                    <p>
                        <label for="desiredSalary">Desired Salary</label>
                        <input type="number" name="desired_salary" value="<?php echo $getUserByID['desired_salary']; ?>" min="10000" max="99999999" required>
                    </p>
                <p>
                    <input type="submit" value="Save" name="editUserBtn" class="submit-button">
                </p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
