<?php

// Connect to the database. Returns a PDO object
function getDb() {
    // Local deployment
    $server = "localhost";
    $username = "adcog_user";
    $password = "secret";
    $db = "adcog";

    return new PDO("mysql:host=$server;dbname=$db;charset=utf8", "$username", "$password",
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

// Check if a user is connected
function isUserConnected() {
    return isset($_SESSION['login']);
}

function isUserAdmin() {
    if (isUserConnected()) {
        return ($_SESSION['role']=='administrateur');
    }
    else  {
        return false;
    }
}

// Redirect to a URL
function redirect($url) {
    header("Location: $url");
}

// Escape a value to prevent XSS attacks
function escape($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
}

// Transform a timestamp into a date 
function timestampToDate($t) {
    return date("d-m-Y",$t);
}