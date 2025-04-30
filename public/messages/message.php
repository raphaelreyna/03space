<?php
require("../../core/conn.php");
require_once("../../core/settings.php");

login_check();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['reply'])) {
        $stmt = $conn->prepare("
        SELECT
            u.username as author,
            m.subject
        FROM messages m
        JOIN users u ON m.author = u.id
        WHERE m.id = ? AND m.toid = ?
        ");
        $stmt->execute(array($_GET['id'], $_SESSION['userId']));
        $message = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$message) {
            echo "<small>Message not found.</small>";
            return;
        }

        header("Location: new.php?to=" . $message['author'] . "&subject=Re: " . $message['subject']);
        exit();
    } elseif (isset($_POST['delete'])) {
        $msgID = $_GET['id'];
        $stmt = $conn->prepare("DELETE FROM messages WHERE id = ? AND toid = ?");
        $stmt->execute(array($msgID, $_SESSION['userId']));
        header("Location: /messages.php");
        exit();
    }
}

$msgID = $_GET['id'];
$stmt = $conn->prepare("
SELECT
    u.username as author,
    m.author as authorId,
    m.subject,
    m.body,
    DATE_FORMAT(m.date, '%M %d, %Y at %h:%i %p') as date
FROM messages m
JOIN users u ON m.author = u.id
WHERE m.id = ? AND m.toid = ?
");
$stmt->execute(array($msgID, $_SESSION['userId']));
$message = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$message) {
    echo "<small>Message not found.</small>";
    return;
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
            table {
                width: 100%;
            }

            th {
                background: var(--lighter-blue);
                font-weight: bold;
            }

            td {
                background: var(--lightest-blue);
                color: black;
            }

            td a {
                color: var(--logo-blue);
                text-decoration: underline;
                font-weight: bold;
            }

            .from-container a img {
                width: 100%;
                height: auto;
                border-style: solid;
                border-width: 3px;
                border-color: var(--logo-blue);
            }

            .from-img-link {
                width: 75%;
            }

            .from-container {
                margin: 10px auto;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            .from-username {
                padding-top: 1em;
                margin: 0 auto;
                font-weight: bold ;
                color: var(--logo-blue);
                text-decoration: underline;
            }

            .message-status {
                padding: 0.5em;
            }

            .date {
                padding: 0.5em;
            }

            thead tr th {
                color: white;
                text-decoration: underline;
            }

            .message-checkbox-td {
                text-align: center; /* Centers horizontally */
                vertical-align: middle; /* Centers vertically */
            }
        </style>
        <div class="container">
            <main>
                <div class="row">
                    <form style="display: flex; flex-direction: column; width: 50%;" method="post" action="message.php?id=<?= $msgID ?>">
                        <input type="hidden" name="id" value="<?= $msgID ?>">
                        <label for="from">From:</label>
                        <div class="from-container">
                            <a href="/profile.php?id=<?= $message['authorId'] ?>" class="from-img-link">
                                <img class="pfp-fallback" style="width: 33px; height: auto; aspect-ratio: 1/1;" alt="user pfp" src="http://10.1.0.200:8081/media/pfp/default.jpg">
                            </a>
                            <a href="/profile.php?id=<?= $message['authorId'] ?>" class="from-username"><?= $message['author'] ?></a>
                        </div>
                        <label for="date">Date:</label>
                        <input type="text" id="date" name="date" autocomplete="off" value="<?= htmlspecialchars($message['date']) ?>" readonly>
                        <label for="subject">Subject:</label>
                        <input type="text" id="subject" name="subject" autocomplete="off" value="<?= htmlspecialchars($message['subject']) ?>" readonly>
                        <label for="body">Body:</label>
                        <textarea id="body" name="body" readonly><?= htmlspecialchars($message['body']) ?></textarea>
                        <br>
                        <input type="submit" name="reply" value="Reply">
                        <input type="submit" name="delete" value="Delete">
                    </form>
                </div>
            <?php require("../footer.php"); ?>