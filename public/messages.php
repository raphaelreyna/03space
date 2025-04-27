<?php
require("../core/conn.php");
require_once("../core/settings.php");

login_check();

?>
<?php require("header.php"); ?>

<div class="container">
    <main>
        <div class="row">
            <div class="col w-20 left">
                <ul>
                    <li>
                        <a href="#">
                            <img src="/static/icons/email.png"></img>
                            <span>Inbox</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="/static/icons/arrow_right.png"></img>
                            <span>Sent</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="/static/icons/script.png"></img>
                            <span>Drafts</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col right">
                <form action="" method="post" enctype="multipart/form-data">
                    <label for="subject">Subject:</label>
                    <br>
                    <input type="text" name="subject" id="subject" required>
                    <br>
                    <label for="content">Content:</label>
                    <textarea name="content" id="content" required></textarea>

                    <input type="submit" name="submit" value="Post">
                </form>
            </div>
        </div>
    </main>
</div>


<?php require("footer.php"); ?>