<?php

require_once 'core/dbConfig.php';
require_once 'core/models.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application Database</title>
    <link rel="stylesheet" href="index.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #CAF0F8;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            color: #023E8A;
        }

        .main {
            background-color: #F0F4F8;
            padding: 0px 30px 10px 30px;
        }

        .mainQuery {
            text-align: center;
        }

        .innerQuery {
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .accountInfo {
            display: flex;
            align-items: center;
            gap: 30px;
            flex-direction: row-reverse;
        }

        .mainTable {
            background-color: #90E0EF;
            margin-top: 30px;
            text-align: center;
        }

        .mainTable th {
            background-color: #0077B6;
            color: white;
        }

        .mainTable th,
        td,
        tr,
        th {
            padding: 5px;
        }

        .mainTable table {
            border-collapse: collapse;
            border: 3px solid #0077B6;
            border-radius: 15px;
        }

        table tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        table tr:nth-child(even) {
            background-color: #ffffff;
        }

        .outerMainTable {}

        .container {
            background-color: #F0F4F8;
            padding: 0px;
            margin: 30px 10px 10px 10px;
            width: 50%;
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
        }

        .editNdelete {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
            padding: 0px 5px 0px 5px;
        }

        .editNdelete a {
            font-size: 12px;
        }

        a.button {
            display: inline-block;
            padding: 10px 13px;
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

        .container .message {
            background-color: none;
            text-align: center;
            border-style: solid;
            width: 100%;
            font-weight: bold;
            border-radius: 15px;
            padding: 2px 10px 2px 10px;
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="accountInfo">
            <form action="core/handleForms.php" method="POST">
                <input type="submit" name="logoutUserBtn" value="Log out" class="submit-button">
            </form>
            <h2> <?php echo $_SESSION['username'] ?></h2>
        </div>
        <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
            <div class="container">
                <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
                    <div style="text-align: center; padding: 30px; margin: 0px 100px 0px 100px;">
                        <h1>Job Application Database</h1>
                        <p><b>Confidential Information Notice:</b></p>
                        <p style="text-align: justify;">
                            This section includes sensitive and confidential information, accessible only to authorized
                            personnel. Unauthorized access or disclosure is strictly forbidden and could lead to
                            disciplinary measures. Handle this content with care and exercise discretion when viewing or
                            sharing it.
                        </p>
                    </div>
                </div>
                <div style="display: flex; align-items: center; justify-content: center;">
                    <div>
                        <?php
                        if (isset($_SESSION['message']) && isset($_SESSION['status'])) {
                            $class = $_SESSION['status'] == "200" ? "message success" : "message error";
                            echo "<p class='$class'>{$_SESSION['message']}</p>";
                        }
                        unset($_SESSION['message']);
                        unset($_SESSION['status']);
                        ?>
                    </div>
                </div>
                <div class="mainQuery">
                    <div style="display: flex; justify-content: center; align-items: center;">
                        <div>
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">

                                <input type="text" name="searchInput" placeholder="Search a query"
                                    style="border-top-right-radius: 0px;  border-bottom-right-radius: 0px;">
                                <input type="submit" name="searchBtn" class="submit-button" value="Search" style="border-top-left-radius: 0px; border-top-left-radius: 0px;  
                                    border-bottom-left-radius: 0px;">

                            </form>
                        </div>
                    </div>
                    <div class="innerQuery">
                        <p><a href="index.php" class="button" style="width: 75px;">Clear</a></p>
                        <p><a href="insert.php" class="button" style="padding: 10px 16px;">+</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="outerMainTable">
            <div class="mainTable">
                <table style="width:100%; margin-top: 100px;">
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date Added</th>
                        <th>Phone Number</th>
                        <th>Years Experience</th>
                        <th>Medical License</th>
                        <th>Certifications</th>
                        <th>Education</th>
                        <th>Desired Salary</th>
                        <th>Action</th>
                    </tr>

                    <?php if (!isset($_GET['searchBtn'])) { ?>
                        <?php $getAllUsers = getAllUsers($pdo); ?>
                        <?php foreach ($getAllUsers as $row) { ?>
                            <tr>
                                <td><?php echo $row['first_name']; ?></td>
                                <td><?php echo $row['last_name']; ?></td>
                                <td><?php echo $row['date_added']; ?></td>
                                <td><?php echo $row['phone_number']; ?></td>
                                <td><?php echo $row['years_experience']; ?></td>
                                <td><?php echo $row['medical_license']; ?></td>
                                <td><?php echo $row['certifications']; ?></td>
                                <td><?php echo $row['education']; ?></td>
                                <td><?php echo $row['desired_salary']; ?></td>
                                <td>
                                    <div class="editNdelete">
                                        <a href="edit.php?applicant_id=<?php echo $row['applicant_id']; ?>" class="button">✎</a>
                                        <a href="delete.php?applicant_id=<?php echo $row['applicant_id']; ?>"
                                            class="button">⌫</a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <?php $searchForAUser = searchForAUser($pdo, $_GET['searchInput']); ?>
                        <?php logActivity($pdo, $_SESSION['username'], 'search', $_GET['searchInput']); ?>
                        <?php foreach ($searchForAUser as $row) { ?>
                            <tr>
                                <td><?php echo $row['first_name']; ?></td>
                                <td><?php echo $row['last_name']; ?></td>
                                <td><?php echo $row['date_added']; ?></td>
                                <td><?php echo $row['phone_number']; ?></td>
                                <td><?php echo $row['years_experience']; ?></td>
                                <td><?php echo $row['medical_license']; ?></td>
                                <td><?php echo $row['certifications']; ?></td>
                                <td><?php echo $row['education']; ?></td>
                                <td><?php echo $row['desired_salary']; ?></td>
                                <td>
                                    <div class="editNdelete">
                                        <a href="edit.php?applicant_id=<?php echo $row['applicant_id']; ?>" class="button">✎</a>
                                        <a href="delete.php?applicant_id=<?php echo $row['applicant_id']; ?>"
                                            class="button">⌫</a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>