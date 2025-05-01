<?php
require_once("config.php");
require_once("init.php");

define('PUBLIC_PATH', dirname(__DIR__) . '/public');
define('CORE_PATH', __DIR__);

require("featureFlags.php");

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: ", $e->getMessage();
}
?>