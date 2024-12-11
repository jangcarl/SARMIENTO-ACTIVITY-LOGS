<?php

require_once 'dbConfig.php';
require_once 'models.php';

if (isset($_POST['insertUserBtn'])) {
    $insertUser = insertNewUser($pdo, $_POST['first_name'], $_POST['last_name'], $_POST['phone_number'], $_POST['years_experience'], $_POST['medical_license'], $_POST['certifications'], $_POST['education'], $_POST['desired_salary']);

    if ($insertUser) {
        logActivity($pdo, $_SESSION['username'], 'insert', json_encode($_POST));
        $_SESSION['message'] = "Successfully Inserted!";
        $_SESSION['status'] = "200";
        header("Location: ../index.php");
    } else {
        logActivity($pdo, $_SESSION['username'], 'insert', json_encode($_POST));
        $_SESSION['message'] = "Successfully Inserted!";
        $_SESSION['status'] = "400";
        header("Location: ../index.php");
    }
}

if (isset($_POST['editUserBtn'])) {
    $editUser = editUser($pdo, $_POST['first_name'], $_POST['last_name'], $_POST['date_added'], $_POST['phone_number'], $_POST['years_experience'], $_POST['medical_license'], $_POST['certifications'], $_POST['education'], $_POST['desired_salary'], $_GET['applicant_id']);

    if ($editUser) {
        logActivity($pdo, $_SESSION['username'], 'edit', json_encode($_POST));
        $_SESSION['message'] = "Successfully Edited!";
        $_SESSION['status'] = "200";
        header("Location: ../index.php");
    } else {
        $_SESSION['message'] = "An error occurred while processing the query!";
        $_SESSION['status'] = "400";
        header("Location: ../index.php");
    }
}

if (isset($_POST['deleteUserBtn'])) {
    $deleteUser = deleteUser($pdo, $_GET['applicant_id']);

    if ($deleteUser) {
        logActivity($pdo, $_SESSION['username'], 'delete', json_encode($_POST));
        $_SESSION['message'] = "Successfully Deleted!";
        $_SESSION['status'] = "200";
        header("Location: ../index.php");
    } else {
        $_SESSION['message'] = "An error occurred while processing the query!";
        $_SESSION['status'] = "400";
        header("Location: ../index.php");
    }
}

if (isset($_GET['searchBtn'])) {
    $searchInput = $_GET['searchInput'];
    $searchForAUser = searchForAUser($pdo, $_GET['searchInput']);
    if ($searchForAUser) {
        logActivity($pdo, $_SESSION['username'], 'search', $_GET['searchInput']);
    }

    foreach ($searchForAUser as $row) {
        echo "<tr> 
                <td>{$row['applicant_id']}</td>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['date_added']}</td>
                <td>{$row['phone_number']}</td>
                <td>{$row['years_experience']}</td>
                <td>{$row['medical_license']}</td>
                <td>{$row['certifications']}</td>
                <td>{$row['education']}</td>
                <td>{$row['desired_salary']}</td>
              </tr>";
    }
}

if (isset($_POST['insertNewUserAccBtn'])) {
    $username = trim($_POST['username']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (!empty($username) && !empty($first_name) && !empty($last_name) && !empty($password) && !empty($confirm_password)) {

        if ($password == $confirm_password) {

            $insertQuery = insertNewUserAcc($pdo, $username, $first_name, $last_name, password_hash($password, PASSWORD_DEFAULT));

            if ($insertQuery['status'] == '200') {
                logActivity($pdo, $_SESSION['username'], 'insert', json_encode($_POST));
                $_SESSION['status'] = $insertQuery['status'];
                header("Location: ../login.php");
            } else {
                $_SESSION['message'] = $insertQuery['message'];
                $_SESSION['status'] = $insertQuery['status'];
                header("Location: ../register.php");
            }

        } else {
            $_SESSION['message'] = "Please make sure both passwords are the same.";
            $_SESSION['status'] = "400";
            header("Location: ../register.php");
        }

    } else {
        $_SESSION['message'] = "Please make sure there are no empty input fields.";
        $_SESSION['status'] = "400";
        header("Location: ../register.php");
    }
}

if (isset($_POST['loginUserBtn'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {

        $loginQuery = checkIfUserExists($pdo, $username);

        if ($loginQuery['status'] == '200') {
            $usernameFromDB = $loginQuery['userInfoArray']['username'];
            $passwordFromDB = $loginQuery['userInfoArray']['password'];

            if (password_verify($password, $passwordFromDB)) {
                $_SESSION['username'] = $usernameFromDB;
                $_SESSION['user_id'] = $loginQuery['userInfoArray']['user_id']; // Save user_id to session
                logActivity($pdo, $_SESSION['username'], 'insert', json_encode($_POST));
                header("Location: ../index.php");
            } else {
                $_SESSION['message'] = "Invalid login credentials.";
                $_SESSION['status'] = "400";
                header("Location: ../login.php");
            }
        } else {
            $_SESSION['message'] = $loginQuery['message'];
            $_SESSION['status'] = $loginQuery['status'];
            header("Location: ../login.php");
        }
    } else {
        $_SESSION['message'] = "Please make sure there are no empty input fields.";
        $_SESSION['status'] = "400";
        header("Location: ../login.php");
    }
}

if (isset($_POST['logoutUserBtn'])) {
    logActivity($pdo, $_SESSION['username'], 'insert', json_encode($_POST));
    unset($_SESSION['user_id']);
    header("Location: ../login.php");
}

?>