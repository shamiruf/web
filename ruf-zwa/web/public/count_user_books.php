<?php
    include('utils/db.php');
    include('utils/auth.php');

    $books = getBooksByUser($loggedInUserEmail);

    echo count($books);
