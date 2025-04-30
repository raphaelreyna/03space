<?php
require("../../core/conn.php");
require_once("../../core/settings.php");

login_check();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['to']) || !isset($_POST['subject']) || !isset($_POST['message'])) {
        echo "<small>Please fill in all required fields.</small>";
        return;
    }

    $author = $_SESSION['userId'];
    $to = filter_var($_POST['to'], FILTER_SANITIZE_EMAIL);
    // TODO(raphaelreyna): Make sure the recipient is a friend of the author
    // TODO(raphaelreyna): Make sure the recipient is not the author
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute(array($to));
    $toId = $stmt->fetchColumn();
    if (!$toId) {
        echo "<small>Recipient does not exist.</small>";
        return;
    }
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    $stmt = $conn->prepare("INSERT INTO messages (author, toid, subject, body) VALUES (?, ?, ?, ?)");
    $stmt->execute(array($author, $toId, $subject, $message));
}

// TODO(raphaelreyna): dont make a link to this page and enforce the to field be set.
// this wil solve the issue of searching through the users friends list to suggest a recipient.
if (isset($_GET['to'])) {
    $to = htmlspecialchars($_GET['to']);
} else {
    $to = '';
}
if (isset($_GET['subject'])) {
    $subject = htmlspecialchars($_GET['subject']);
} else {
    $subject = '';
}
?>

<?php require PUBLIC_PATH . "/header.php"; ?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="static/css/normalize.css">
        <link rel="stylesheet" href="static/css/base.css">
        <link rel="stylesheet" href="static/css/my.css">
    </head>
    <body>
        <style>
        </style>
        <main>
            <form method="post" action="">
                <label for="to">To:</label>
                <input type="text" id="to" name="to" value="<?= $to ?>" required>
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" value="<?= $subject ?>" required>
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
                <button type="submit">Send</button>
            </form>
        <?php require("../footer.php"); ?>
