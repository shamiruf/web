<?php
    include('utils/db.php');
    include('utils/auth.php');

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (!isset($_GET['id'])) {
            echo "No id was provided";
            exit(0);
        }

        if (!$isLoggedIn) {
            header('Location: login.php');
            exit(0);
        }

        deleteUserBook($loggedInUserEmail, $_GET['id']);
        header('Location: my_books.php');
    } else {
        // TODO ERROR
    }
