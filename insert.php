<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Applicant</title>
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
    </style>
</head>

<body>
    <div class="outerMain">
        <div class="main" style="padding: 30px;">
            <div><a href="index.php" class="button">Cancel</a></div>

            <div class="innerMain">
                <h1>Add Applicant</h1>

                <div class="mainForm">
                    <form action="core/handleForms.php" method="POST">
                        <p>
                            <label for="firstName">First Name</label>
                            <input type="text" name="first_name" required>
                        </p>
                        <p>
                            <label for="lastName">Last Name</label>
                            <input type="text" name="last_name" required>
                        </p>
                        <p>
                            <label for="phoneNumber">Phone Number</label>
                            <input type="text" name="phone_number" required>
                        </p>
                        <p>
                            <label for="yearsExperience">Years Experience</label>
                            <input type="number" name="years_experience" min="1" max="99" required>
                        </p>
                        <p>
                            <label for="medicalLicense">Medical License</label>
                            <input type="text" name="medical_license" required>
                        </p>
                        <p>
                            <label for="certifications">Certifications</label>
                            <input type="text" name="certifications" required>
                        </p>
                        <p>
                            <label for="education">Education</label>
                            <input type="text" name="education" required>
                        </p>
                        <p>
                            <label for="desiredSalary">Desired Salary</label>
                            <input type="number" name="desired_salary" min="10000" max="99999999" required>
                        </p>
                </div>
                <p>
                    <input type="submit" name="insertUserBtn" class="submit-button" value="Add">
                </p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
