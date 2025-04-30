<?php
require("../core/conn.php");
require_once("../core/settings.php");

login_check();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['delete'])) {
        echo "<small>Please select a message to delete.</small>";
        return;
    }

    $toid = $_SESSION['userId'];
    $msgIdsToDeleteArray = $_POST['delete'];

    $stmt = $conn->prepare("DELETE FROM messages WHERE toid = ? AND id IN (" . implode(',', array_fill(0, count($msgIdsToDeleteArray), '?')) . ")");
    $stmt->execute(array_merge(array($toid), $msgIdsToDeleteArray));
}

$msgsQuery = $conn->prepare("
    SELECT 
       m.id, 
       u.username AS author, 
       m.subject, 
       m.status,
       DATE_FORMAT(m.date, '%M %d, %Y') AS date, 
       DATE_FORMAT(m.date, '%h:%i %p') AS time
    FROM messages m
    JOIN users u ON m.author = u.id
    WHERE toid = ?
");
$msgsQuery->execute(array($_SESSION['userId']));
$msgs = $msgsQuery->fetchAll(PDO::FETCH_ASSOC);
?>
<?php require("header.php"); ?>

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
                    <a href="messages/new.php" class="button">New Message</a>
                    <div class="table-section">
                        <div class="inner">
                            <form method="post">
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 5%;"><input type="checkbox" name="check-all"></th>
                                        <th style="width: 10%">Date:</th>
                                        <th style="width: 22%;">From:</th>
                                        <th style="width: 10%;">Status:</th>
                                        <th style="width: 52%;">Subject:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($msgs as $msg): ?>
                                        <tr>
                                            <td class="message-checkbox-td"><input class="message-checkbox" type="checkbox" name="delete[]" value="<?= htmlspecialchars($msg['id']); ?>"></td>
                                            <td><span class="date"><?= $msg['date']; ?></span><br><span class="date"><?= $msg['time']; ?></span></td>
                                            <td>
                                                <div class="from-container">
                                                    <a class="from-img-link" href="#">
                                                        <!-- TODO(raphaelreyna): Use the correct image path -->
                                                        <img class="pfp-fallback" style="width: 100%; height: auto; aspect-ratio: 1/1;" alt="user pfp" src="http://10.1.0.200:8081/media/pfp/default.jpg">
                                                    </a>
                                                    <br>
                                                    <a class="from-username" href="#"><?= $msg['author']; ?></a>
                                                </div>
                                            </td>
                                            <td><span class="message-status"><?= $msg['status']; ?></span></td>
                                            <td><a href="/messages/message.php?id=<?= $msg['id']?>"><?= htmlspecialchars($msg['subject']); ?></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <input type="submit" value="Delete Selected Messages" class="delete-button">
                            </form>
                        </div>
                    </div>
                </div>
        <?php require("footer.php"); ?>