<?php 
// Database configuration 
$host = $_ENV["DB_HOST"];
if (empty($host)) {
    throw new RuntimeException("The environment variable 'DB_HOST' must not be empty.");
}
$dbname = $_ENV["DB_NAME"];
if (empty($dbname)) {
    throw new RuntimeException("The environment variable 'DB_NAME' must not be empty.");
}
$username = $_ENV["DB_USERNAME"];
if (empty($username)) {
    throw new RuntimeException("The environment variable 'DB_USERNAME' must not be empty.");
}
$password = $_ENV["DB_PASSWORD"];
if (empty($password)) {
    throw new RuntimeException("The environment variable 'DB_PASSWORD' must not be empty.");
}

// Site localization
$siteName = $_ENV["SITE_NAME"];
if (empty($siteName)) {
    throw new RuntimeException("The environment variable 'SITE_NAME' must not be empty.");
}

$domainName = $_ENV["DOMAIN_NAME"];
if (empty($domainName)) {
    throw new RuntimeException("The environment variable 'DOMAIN_NAME' must not be empty.");
}

$adminUser = $_ENV["ADMIN_USER_ID"];
if (empty($adminUser)) {
    throw new RuntimeException("The environment variable 'ADMIN_USER_ID' must not be empty.");
}
?>