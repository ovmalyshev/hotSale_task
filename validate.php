<?php
require_once("log.php");

define("NAME", $_POST["name"]);
define("SECOND_NAME", $_POST["secondName"]);
define("EMAIL", $_POST["email"]);
define("PASSWORD", $_POST["password"]);
define("CONFIRM_PASSWORD", $_POST["confirmPassword"]);

function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function createUser () {
    $fileName = "users" . ".json";
    usersDataExist($fileName);
    $currentData = file_get_contents("$fileName");
    $arrayData = json_decode($currentData, true);
    file_put_contents("$fileName", getUserData($arrayData));
}

function getUserData($arrayData) {
    $id = end($arrayData)["id"] + 1;
    $data[] = array(
        "id" => $id,
        "name" => NAME,
        "secondName" => SECOND_NAME,
        "email" => EMAIL,
        "password" => PASSWORD,
    );
    array_push($arrayData, $data[0]);
    return json_encode($arrayData);
}

function isValidPassword () {
    return PASSWORD === CONFIRM_PASSWORD;
}

function isValidEmail () {
    if (!empty(EMAIL)) {
        $email = validateInput(EMAIL);
        return strpos($email, "@") !== false || false;
    }
}

function isUser () {
    $fileName = "users" . ".json";
    usersDataExist($fileName);
    $currentData = file_get_contents("$fileName");
    $arrayData = json_decode($currentData, true);
    $getEmails = array_column($arrayData, "email");
    return in_array(EMAIL, $getEmails);
}

function usersDataExist ($fileName) {
    if (!file_exists("$fileName")) {
        file_put_contents($fileName, json_encode([]));
    }
}

function returnData () {
    $errors = [];
    $data = [];

    if (!isValidPassword()) {
        $errors["confirmPassword"] = "Password did not match! Try again.";
    };
    if (!isValidEmail()) {
        $errors["email"] = "Invalid email format.";
    };
    if (isUser()) {
        $errorString = sprintf("User with email \"%s\" already exist", EMAIL);
        $errors["userExist"] = $errorString;
        logContent(EMAIL, false);
    }

    if (!empty($errors)) {
        $data["success"] = false;
        $data["errors"] = $errors;
    } else {
        createUser();
        logContent(EMAIL);
        $data["success"] = true;
    }
    return $data;
}

$data = returnData();

echo json_encode($data);
